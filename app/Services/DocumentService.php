<?php

namespace App\Services;

use App\Events\DocumentCreatedEvent;
use App\Models\Document;
use App\Models\User;

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
}
