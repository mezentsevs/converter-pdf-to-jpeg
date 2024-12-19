<?php

namespace App\Listeners;

use App\Events\DocumentDeletedEvent;

class DocumentDeletedListener
{
    public function handle(DocumentDeletedEvent $event): void
    {
        logger()->info($event::class, [$event]);
    }
}
