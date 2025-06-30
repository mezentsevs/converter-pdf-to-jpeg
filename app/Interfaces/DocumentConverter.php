<?php

namespace App\Interfaces;

use App\Models\Document;

interface DocumentConverter
{
    public string $imageFileExtension {
        get;
    }

    public function convert(Document $document): bool;
}
