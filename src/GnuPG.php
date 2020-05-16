<?php declare(strict_types = 1);
namespace PharIo\GnuPG;

use PharIo\Executor\Executor;
use PharIo\Executor\ExecutorResult;
use PharIo\FileSystem\Directory;
use PharIo\FileSystem\Filename;

/**
 * This is a (thin) wrapper around the gnupg binary, mimicking the pecl/gnupg api
 * Currently, only the methods required by phive (import, info, geterror and verify) are implemented
 *
 * NOTE: The implementation may not be complete enough to be useful for other purposes
 */
class GnuPG {

    /** @var Executor */
    private $executor;

    /** @var Directory */
    private $homeDirectory;

    /** @var Directory */
    private $tmpDirectory;

    /** @var Filename */
    private $gpgBinary;

    /** @var int */
    private $lastExitCode = -1;

    public function __construct(Executor $executor, Filename $gpgBinary, Directory $tmpDirectory, Directory $homeDirectory) {
        $this->executor      = $executor;
        $this->gpgBinary     = $gpgBinary;
        $this->tmpDirectory  = $tmpDirectory;
        $this->homeDirectory = $homeDirectory;
    }

    public function import(string $key): array {
        $tmpFile = $this->createTemporaryFile($key);
        $result  = $this->execute([
            '--import',
            \escapeshellarg($tmpFile->asString())
        ])->getOutput();
        $tmpFile->delete();

        if (\preg_match('=.*IMPORT_OK\s(\d+)\s(.*)=', \implode('', $result), $matches)) {
            return [
                'imported'    => (int)$matches[1],
                'fingerprint' => $matches[2]
            ];
        }

        return ['imported' => 0];
    }

    public function keyinfo(string $search): array {
        $result = $this->execute([
            '--list-keys',
            '--with-fingerprint',
            '--with-fingerprint', // duplication intentional
            '--fixed-list-mode',
            \escapeshellarg($search)
        ])->getOutput();

        return $this->parseInfoOutput($result);
    }

    /**
     * @return array|false
     */
    public function verify(string $message, string $signature) {
        $messageFile   = $this->createTemporaryFile($message);
        $signatureFile = $this->createTemporaryFile($signature);

        $result = $this->execute([
            '--verify',
            \escapeshellarg($signatureFile->asString()),
            \escapeshellarg($messageFile->asString())
        ]);

        $signatureFile->delete();
        $messageFile->delete();

        return $this->parseVerifyOutput($result->getOutput(), $result->getExitCode());
    }

    /**
     * @return false|string
     */
    public function geterror() {
        if ($this->lastExitCode === -1) {
            return false;
        }

        return ErrorStrings::fromCode($this->lastExitCode);
    }

    /**
     * @return array|false
     */
    private function parseVerifyOutput(array $status, int $exitCode) {
        $fingerprint = '';
        $timestamp   = 0;
        $summary     = false;

        foreach ($status as $line) {
            $parts = \explode(' ', $line);

            if (\count($parts) < 3) {
                continue;
            }
            $fingerprint = $parts[2];

            if (\strpos($line, 'VALIDSIG') !== false) {
                // [GNUPG:] VALIDSIG D8406D0D82947747{...}A394072C20A 2014-07-19 1405769272 0 4 0 1 10 00 D8{...}C20A
                /*
                VALIDSIG <args>

                The args are:

                - <fingerprint_in_hex>
                - <sig_creation_date>
                - <sig-timestamp>
                - <expire-timestamp>
                - <sig-version>
                - <reserved>
                - <pubkey-algo>
                - <hash-algo>
                - <sig-class>
                - [ <primary-key-fpr> ]
                */
                $timestamp = $parts[4];
                $summary   = 0;

                break;
            }

            if (\strpos($line, 'BADSIG') !== false) {
                // [GNUPG:] BADSIG 4AA394086372C20A Sebastian Bergmann <sb@sebastian-bergmann.de>
                $summary = 4;

                break;
            }

            if (\strpos($line, 'ERRSIG') !== false) {
                // [GNUPG:] ERRSIG 4AA394086372C20A 1 10 00 1405769272 9
                // ERRSIG  <keyid>  <pkalgo> <hashalgo> <sig_class> <time> <rc>
                $timestamp = $parts[6];
                $summary   = 128;

                break;
            }
        }

        if ($summary === false) {
            return false;
        }

        return [[
            'fingerprint' => $fingerprint,
            'validity'    => 0,
            'timestamp'   => $timestamp,
            'status'      => $exitCode,
            'summary'     => $summary
        ]];
    }

    /**
     * @return string[]
     */
    private function getDefaultGpgParams(): array {
        return [
            '--homedir ' . \escapeshellarg($this->homeDirectory->asString()),
            '--quiet',
            '--status-fd 1',
            '--lock-multiple',
            '--no-permission-warning',
            '--no-greeting',
            '--exit-on-status-write-error',
            '--batch',
            '--no-tty',
            '--with-colons'
        ];
    }

    /**
     * @param string[] $params
     */
    private function execute(array $params): ExecutorResult {
        $devNull = \stripos(\PHP_OS, 'win') === 0 ? 'nul' : '/dev/null';

        $argLine = \sprintf(
            '%s %s 2>%s',
            \implode(' ', $this->getDefaultGpgParams()),
            \implode(' ', $params),
            $devNull
        );

        $result             = $this->executor->execute($this->gpgBinary, $argLine);
        $this->lastExitCode = $result->getExitCode();

        return $result;
    }

    private function createTemporaryFile($content): Filename {
        $tmpFile = $this->tmpDirectory->file(\uniqid('phive_gpg_', true));
        $tmpFile->putContent($content);

        return $tmpFile;
    }

    private function parseInfoOutput(array $result): array {
        //
        // Fragment docs @  https://git.gnupg.org/cgi-bin/gitweb.cgi?p=gnupg.git;a=blob_plain;f=doc/DETAILS
        //

        $key     = [];
        $uids    = [];
        $subkeys = [];

        foreach ($result as $line) {
            $fragments = \explode(':', $line);

            switch ($fragments[0]) {
                case 'sub':
                case 'pub':
                {
                    $subkeys[] = \array_merge(
                        [
                            'keyid'     => $fragments[4],
                            'timestamp' => (int)$fragments[5],
                            'expires'   => (int)$fragments[6]
                        ],
                        $this->parseCapabilities($fragments[11]),
                        $this->parseValidity($fragments[1])
                    );

                    if (empty($key)) {
                        $key = \array_merge(
                            $this->parseValidity($fragments[1]),
                            $this->parseCapabilities($fragments[11])
                        );
                    }

                    break;
                }

                case 'fpr':
                {
                    $subkeys[] = \array_merge(
                        ['fingerprint' => $fragments[9]],
                        \array_pop($subkeys)
                    );

                    break;
                }

                case 'uid':
                {
                    \preg_match('/(.*)\s<(.*)>/', $fragments[9], $matches);

                    $uids[] = \array_merge(
                        [
                            'name'    => $matches[1],
                            'comment' => '',
                            'email'   => $matches[2],
                            'uid'     => $fragments[9],
                        ],
                        $this->parseValidity($fragments[1])
                    );

                    break;
                }
            }
        }

        $key['uids']    = $uids;
        $key['subkeys'] = $subkeys;

        return [$key];
    }

    private function parseValidity(string $flag): array {
        static $map = [
            'i' => 'invalid',
            'd' => 'disabled',
            'r' => 'revoked',
            'e' => 'expired',
            'n' => 'invalid'
        ];

        $parsed = [
            'disabled' => false,
            'expired'  => false,
            'revoked'  => false,
            'invalid'  => false
        ];

        if (isset($map[$flag])) {
            $parsed[$map[$flag]] = true;
        }

        return $parsed;
    }

    private function parseCapabilities(string $flags): array {
        /*
         * - e :: Encrypt
         * - s :: Sign
         * - c :: Certify
         * - a :: Authentication
         * - ? :: Unknown capability
         */

        $result = [
            'can_encrypt' => false,
            'can_sign'    => false
        ];

        static $map = [
            's' => 'can_sign',
            'e' => 'can_encrypt'
        ];

        foreach (\str_split(\strtolower($flags), 1) as $char) {
            if (isset($map[$char])) {
                $result[$map[$char]] = true;
            }
        }

        return $result;
    }
}
