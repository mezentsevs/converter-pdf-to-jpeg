<?php

namespace App\Services;

use App\Dtos\DocumentCreateDto;
use App\Events\DocumentConvertedEvent;
use App\Events\DocumentCreatedEvent;
use App\Events\DocumentDeletedEvent;
use App\Interfaces\DocumentConverter;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    public function __construct(protected DocumentConverter $documentConverter)
    {
    }

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
        if (!$this->documentConverter->convert($document)) {
            return false;
        }

        event(new DocumentConvertedEvent($document));

        return true;
    }

    public function delete(Document $document): void
    {
        Storage::delete(config('documents.directory') . DS . $document->filename);

        $document->delete();

        event(new DocumentDeletedEvent($document));
    }
}
