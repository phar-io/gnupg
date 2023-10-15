<?php

namespace PharIo\GnuPG\GnuPG;

interface Verifier
{
    public function verify(string $content, string $signature): bool;
}