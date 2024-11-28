<?php

declare(strict_types=1);

namespace PharIo\GnuPG;

final class KeyId
{
    private string $id;

    public function getId(): string
    {
        return $this->id;
    }
}
