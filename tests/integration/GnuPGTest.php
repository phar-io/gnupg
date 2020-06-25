<?php

declare(strict_types=1);

namespace integration;

use PharIo\FileSystem\Directory;
use PharIo\GnuPG\Factory;
use PHPUnit\Framework\TestCase;

class GnuPGTest extends TestCase
{
    public function testInvalidFile(): void
    {
        $factory = new Factory();
        $gpg = $factory->createGnuPG(new Directory('/not-existin-dir'));

       $this->assertFalse($gpg->import('foo'));
    }
}
