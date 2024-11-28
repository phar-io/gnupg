<?php

declare(strict_types=1);

namespace PharIo\GnuPG;

final class FingerPrint
{
    private string $fingerPrint;

    public function getFingerPrint(): string
    {
        return $this->fingerPrint;
    }
}
