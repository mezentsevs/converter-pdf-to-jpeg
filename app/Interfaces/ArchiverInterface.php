<?php

namespace App\Interfaces;

interface ArchiverInterface
{
    public string $archiveExt {
        get;
    }

    public function makeArchive(string $source, string $destination): bool;
}
