<?php

declare(strict_types=1);

namespace PharIo\GnuPG;

use PharIo\FileSystem\Directory;

final class PeclWrapper implements GPG
{
    public function __construct(Directory $home, ?Directory $temp = null)
    {
        $this->gpg = new \Gnupg();
    }

    public function importPublicKey(string $keyData): PublicKey
    {
        // TODO: Implement importPublicKey() method.
    }

    public function importSecretKey(string $keyData): SecretKey
    {
        // TODO: Implement importSecretKey() method.
    }

    public function verify(string $message, Signature $signature): KeyInfo
    {
        // TODO: Implement verify() method.
    }

    public function sign(SecretKey $privateKey, string $message): Signature
    {
        // TODO: Implement sign() method.
    }
}
