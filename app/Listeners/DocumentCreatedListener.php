<?php

namespace App\Listeners;

use App\Events\DocumentCreated;

class DocumentCreatedListener
{
    public function handle(DocumentCreated $event): void
    {
        logger()->info('Document created', [$event]);
    }
}
