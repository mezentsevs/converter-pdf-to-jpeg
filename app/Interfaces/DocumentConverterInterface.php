<?php

namespace App\Interfaces;

use App\Models\Document;

interface DocumentConverterInterface
{
    public string $imageExt {
        get;
    }

    public function convert(Document $document): bool;
}
