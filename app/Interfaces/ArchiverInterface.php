<?php

namespace App\Interfaces;

interface ArchiverInterface
{
    public string $ext {
        get;
    }

    public function makeArchive(string $source, string $destination): bool;
}
