<?php declare(strict_types=1);

namespace PharIo\GnuPG\GnuPG;

use PharIo\GnuPG\GnuPG;

class NoGpgAvailable implements GnuPG
{

    public function geterror()
    {
        return '';
    }

    public function import(string $key) : array
    {
        return [];
    }

    public function keyInfo(string $search) : array
    {
        return [];
    }

    public function verify(string $content, string $signature) : bool
    {
        return true;
    }
}