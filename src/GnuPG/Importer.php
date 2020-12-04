<?php
/**
 * Copyright Andreas Heigl <andreas@heigl.org>
 *
 * Licensed under the MIT-license. For details see the included file LICENSE.md
 */

namespace PharIo\GnuPG\GnuPG;

interface Importer
{
    /**
     * @return int[]
     */
    public function import(string $key): array;
}