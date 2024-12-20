<?php

namespace App\Converters;

use App\Interfaces\DocumentConverterInterface;
use App\Models\Document;

class ImagickDocumentConverter implements DocumentConverterInterface
{
    public function convert(Document $document): bool
    {
        return true;
    }
}
