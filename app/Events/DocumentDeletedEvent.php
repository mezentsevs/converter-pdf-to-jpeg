<?php

namespace App\Events;

use App\Models\Document;

class DocumentDeletedEvent extends BaseEvent
{
    public function __construct(public Document $document) {}
}
