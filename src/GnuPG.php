<?php

namespace PharIo\GnuPG;

use PharIo\GnuPG\GnuPG\ErrorHandler;
use PharIo\GnuPG\GnuPG\Importer;
use PharIo\GnuPG\GnuPG\Informer;
use PharIo\GnuPG\GnuPG\Verifier;

interface GnuPG extends Verifier, Importer, Informer, ErrorHandler
{
}