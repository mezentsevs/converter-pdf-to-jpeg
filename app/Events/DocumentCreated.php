<?php

namespace App\Events;

use App\Models\Document;
use App\Models\User;

class DocumentCreated extends BaseEvent
{
    /**
     * Create a new event instance.
     */
    public function __construct(public User $causer, public Document $document) {}
}
