<?php declare(strict_types=1);

namespace PharIo\GnuPG\Exception;

use RuntimeException;
use Throwable;

class GpgExtensionNotFound extends RuntimeException
{
    public static function inPhp(): self
    {
        return new self('The pecl/GnuPG extension for PHP was not found. You might want to install it.');
    }

    public static function orBroken(Throwable $t): self
    {
        return new self('The pexl/GnuPG extension for PHP was found but an Exception was thrown when using it. You might want to check the installation.', null, $t);
    }
}