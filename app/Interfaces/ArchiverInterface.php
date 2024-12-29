<?php

namespace App\Interfaces;

interface ArchiverInterface
{
    public function makeArchive(string $source, string $destination): bool;
}
