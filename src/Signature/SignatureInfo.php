<?php

declare(strict_types=1);

namespace PharIo\GnuPG;

Final class SignatureInfo
{
    private FingerPrint $fingerPrint;

    private DateTimeImmutable $createdAt;

    private DateTimeImmutable $expireAt;

    private UserId $userId;
}
