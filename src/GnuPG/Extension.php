<?php declare(strict_types=1);

namespace PharIo\GnuPG\GnuPG;

use PharIo\GnuPG\Exception\GpgExtensionNotFound;
use PharIo\GnuPG\GnuPG;
use Throwable;
use function extension_loaded;

class Extension implements GnuPG
{
    public function __construct()
    {
        if (! extension_loaded('gnupg')) {
            throw GpgExtensionNotFound::inPhp();
        }

        try {
            $this->gnupg = new \Gnupg;
            $this->gnupg->seterrormode(\Gnupg::ERROR_SILENT);
        } catch (Throwable $t) {
            throw GpgExtensionNotFound::orBroken($t);
        }
    }

    public function verify(string $content, string $signature) : bool
    {
        return $this->gnupg->verify($content, $signature);
    }

    public function geterror()
    {
        return $this->gnupg->geterror();
    }

    public function import(string $key) : array
    {
        return $this->gnupg->import($key);
    }

    public function keyInfo(string $search) : array
    {
        return $this->gnupg->keyinfo($search);
    }
}