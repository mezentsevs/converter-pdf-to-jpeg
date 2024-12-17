<?php

namespace App\Services;

use App\Models\Document;
use App\Models\User;

class DocumentService
{
    public function create(User $user, array $payload): Document
    {
        return $user->documents()->create([
            'filename' => $payload['filename'],
            'type' => $payload['type'],
            'size' => $payload['size'],
        ]);
    }
}
