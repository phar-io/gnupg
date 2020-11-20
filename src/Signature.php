<?php

declare(strict_types=1);

namespace PharIo\GnuPG;

/**
 * This class could be prevent sigatures form being serialized.
 *
 * @see https://github.com/paragonie/hidden-string/blob/master/src/HiddenString.php inspired by.
 */
class Signature
{
    /**
     * Will return internal sigature data
     *
     * This can be stored to a file for example.
     */
    public function getData(): string {
    }
}
