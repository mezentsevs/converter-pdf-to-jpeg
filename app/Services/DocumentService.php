<?php

namespace App\Services;

use App\Events\DocumentCreatedEvent;
use App\Events\DocumentDeletedEvent;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    public function create(User $user, array $payload): Document
    {
        $document = $user->documents()->create([
            'filename' => $payload['filename'],
            'type' => $payload['type'],
            'size' => $payload['size'],
        ]);

        event(new DocumentCreatedEvent($user, $document));

        return $document;
    }

    public function delete(Document $document): void
    {
        Storage::delete(config('documents.directory') . DS . $document->filename);

        $document->delete();

        event(new DocumentDeletedEvent($document));
    }
}
