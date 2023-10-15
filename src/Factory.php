<?php declare(strict_types = 1);

namespace PharIo\GnuPG;

use PharIo\FileSystem\Directory;
use PharIo\FileSystem\Filename;
use PharIo\GnuPG\Exception\GpgBinaryNotFound;
use PharIo\GnuPG\Exception\GpgExtensionNotFound;
use PharIo\GnuPG\GnuPG as GPG;
use function extension_loaded;
use function putenv;
use function sys_get_temp_dir;

class Factory {

    /**
     * Factory constructor.
     *
     * @param Filename $gpgBinary
     */
    public function __construct(Filename $gpgBinary = null) {
        $this->gpgBinary = $gpgBinary;
    }

    public function createGnuPG(Directory $homeDirectory): GnuPG
    {
        putenv('GNUPGHOME=' . $homeDirectory->asString());
        try {
            return new GPG\Extension();
        } catch (GpgExtensionNotFound $e) {
            // Do nothing on purpose
        }

        try {
            return GPG\Binary::createwithPaths(
                $this->gpgBinary->asString(),
                sys_get_temp_dir(),
                $homeDirectory->asString()
            );
        } catch (GpgBinaryNotFound $e) {
            // Do nothing on purpose
        }
        return new GPG\NoGpgAvailable;
    }
}
