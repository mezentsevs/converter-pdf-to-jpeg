<?php

namespace App\Events;

use App\Models\Document;

class DocumentConvertedEvent extends BaseEvent
{
    public function __construct(public Document $document) {}
}
