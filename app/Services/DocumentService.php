<?php

namespace App\Services;

use App\Dtos\DocumentCreateDto;
use App\Events\DocumentCreatedEvent;
use App\Events\DocumentDeletedEvent;
use App\Interfaces\DocumentConverterInterface;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    public function __construct(protected DocumentConverterInterface $documentConverter) {}

    public function create(DocumentCreateDto $dto): Document
    {
        $document = $dto->user->documents()->create([
            'filename' => $dto->filename,
            'type' => $dto->type,
            'size' => $dto->size,
        ]);

        event(new DocumentCreatedEvent($document));

        return $document;
    }

    public function convert(Document $document): bool
    {
        return $this->documentConverter->convert($document);
    }

    public function delete(Document $document): void
    {
        Storage::delete(config('documents.directory') . DS . $document->filename);

        $document->delete();

        event(new DocumentDeletedEvent($document));
    }
}
