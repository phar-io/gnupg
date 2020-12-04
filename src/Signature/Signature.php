<?php

declare(strict_types=1);

namespace PharIo\GnuPG;


Class Signature
{
    public function getKeyId(): KeyId
    {}

    public function getUserId(): UserId
    {}

    public function getSignatureInformation(): ?SignatureInfo
    {}

    public function getStatus(): Status
    {
    }

    /**
     * Will return internal sigature data
     *
     * This can be stored to a file for example.
     */
    public function getData(): SignatureData {
    }
}
