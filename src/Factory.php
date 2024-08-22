<?php declare(strict_types = 1);
namespace PharIo\GnuPG;

use PharIo\Executor\Executor;
use PharIo\FileSystem\Directory;
use PharIo\FileSystem\Filename;

/** @noinspection PhpComposerExtensionStubsInspection */
class Factory {

    /** @var Filename */
    private $gpgBinary;

    /**
     * Factory constructor.
     *
     * @param Filename $gpgBinary
     */
    public function __construct(?Filename $gpgBinary = null) {
        $this->gpgBinary = $gpgBinary;
    }

    public function createGnuPG(Directory $homeDirectory): \Gnupg {
        if (\extension_loaded('gnupg')) {
            \putenv('GNUPGHOME=' . $homeDirectory->asString());
            $gpg = new \Gnupg();
            $gpg->seterrormode(\Gnupg::ERROR_SILENT);

            return $gpg;
        }

        $gpg = new GnuPG(
            new Executor(),
            $this->getGPGBinaryPath(),
            $this->getTempDirectory(),
            $homeDirectory
        );

        if (!\class_exists('\Gnupg')) {
            \class_alias(GnuPG::class, '\Gnupg');
        }

        /** @var \Gnupg $gpg */
        return $gpg;
    }

    /**
     * @throws Exception
     */
    private function getGPGBinaryPath(): Filename {
        if ($this->gpgBinary === null) {
            $which  = \stripos(\PHP_OS, 'WIN') === 0 ? 'where.exe' : 'which';
            $result = \exec(\sprintf('%s %s', $which, 'gpg'), $output, $exitCode);

            if ($exitCode !== 0) {
                throw new Exception('No gnupg binary found - please specify or install the pecl/gnupg extension.');
            }
            $resultLines     = \explode("\n", $result, 2);
            $this->gpgBinary = new Filename($resultLines[0]);
        }

        return $this->gpgBinary;
    }

    private function getTempDirectory(): Directory {
        return new Directory(\sys_get_temp_dir());
    }
}
