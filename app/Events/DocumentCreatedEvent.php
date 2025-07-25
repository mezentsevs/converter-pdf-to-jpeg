<?php

namespace App\Events;

use App\Models\Document;

class DocumentCreatedEvent extends BaseEvent
{
    public function __construct(public Document $document)
    {
    }
}
