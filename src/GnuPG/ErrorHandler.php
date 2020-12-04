<?php

namespace PharIo\GnuPG\GnuPG;

interface ErrorHandler
{
    /**
     * @return false|string
     */
    public function geterror();
}