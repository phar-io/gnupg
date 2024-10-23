<?php declare(strict_types=1);

namespace PharIo\GnuPG\Exception;

use RuntimeException;

class GpgBinaryNotFound extends RuntimeException
{
    public static function inDefaultPath(): self
    {
        return new self('No gnupg binary found - please specify or install the pecl/gnupg extension.');
    }

    public static function inProvidedPath(string $path): self
    {
        return new self(sprintf(
            'No gnupg binary found in %1$s - please check the location',
            $path
        ));
    }
}