<?php

namespace App\Interfaces;

interface Archiver
{
    public string $archiveExt {
        get;
    }

    public function makeArchive(string $source, string $destination): bool;
}
