<?php

declare(strict_types=1);

namespace PharIo\GnuPG;

final class Status
{
    public static Good(): Status;
    public static Expired(): Status;
    public static KeyExpired(): Status;
    public static KeyRevoked(): Status;
    public static Bad(): Status;
    public static Error(): Status;
}
