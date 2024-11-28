<?php

declare(strict_types=1);

namespace PharIo\GnuPG;

class PublicKey
{
    private function __construct(string $id, string $fingerprint, array $uids, string $key, \DateTimeImmutable $created)
    {
    }

    public function getId(): string {
    }

    public function getInfo(): string {
    }

    public function getKey(): string {

    }

    public function getFingerprint(): string {

    }
}
