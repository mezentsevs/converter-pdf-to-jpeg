<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;

class DocumentPolicy
{
    public function create(): bool
    {
        return auth()->check();
    }

    public function downloadSlider(User $user, Document $document): bool
    {
        return $user->id === $document->user_id;
    }
}
