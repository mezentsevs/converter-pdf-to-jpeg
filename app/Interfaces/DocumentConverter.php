<?php

namespace App\Interfaces;

use App\Models\Document;

interface DocumentConverter
{
    public string $imageExt {
        get;
    }

    public function convert(Document $document): bool;
}
