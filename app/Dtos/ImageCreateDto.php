<?php

namespace App\Dtos;

use App\Interfaces\DtoInterface;
use App\Models\Document;

class ImageCreateDto implements DtoInterface
{
    public Document $document;

    public string $filename;

    public string $type;

    public int $size;

    public function toArray(): array
    {
        return [
            'document' => $this->document,
            'filename' => $this->filename,
            'type' => $this->type,
            'size' => $this->size,
        ];
    }
}
