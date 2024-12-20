<?php

namespace App\Interfaces;

use App\Models\Document;

interface DocumentConverterInterface
{
    public function convert(Document $document): bool;
}
