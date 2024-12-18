<?php

namespace App\Events;

use App\Models\Document;
use App\Models\User;

class DocumentCreatedEvent extends BaseEvent
{
    public function __construct(public User $causer, public Document $document) {}
}
