<?php

namespace App\Interfaces;

interface Archiver
{
    public string $archiveFileExtension {
        get;
    }

    public function makeArchive(string $source, string $destination): bool;
}
