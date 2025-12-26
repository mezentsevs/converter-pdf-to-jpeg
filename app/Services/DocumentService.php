<?php

namespace App\Services;

use App\Dtos\DocumentCreateDto;
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
        return $this->documentConverter->convert($document);
    }

    public function delete(Document $document): void
    {
        Storage::delete(config('documents.directory') . DS . $document->filename);

        $document->delete();

        event(new DocumentDeletedEvent($document));
    }

    public function deleteDocumentFiles(Document $document): void
    {
        $localDisk = app('filesystem')->disk('local');
        $publicDisk = app('filesystem')->disk('public');

        try {
            if ($localDisk->exists($document->file_relative_path)) {
                $localDisk->delete($document->file_relative_path);
            }
        } catch (\Exception $e) {
            logger()->error('Failed to delete document from local disk.', [
                'path' => $document->file_relative_path,
                'error' => $e->getMessage(),
            ]);
        }

        $folders = [
            $document->slider_relative_path,
            $document->slider_archive_relative_path,
        ];

        foreach ($folders as $folder) {
            try {
                if ($publicDisk->exists($folder)) {
                    $publicDisk->deleteDirectory($folder);
                }
            } catch (\Exception $e) {
                logger()->error('Failed to delete folder from public disk.', [
                    'path' => $folder,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
