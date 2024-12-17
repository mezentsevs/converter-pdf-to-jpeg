<?php

namespace App\Listeners;

use App\Events\DocumentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class DocumentCreatedListener implements ShouldQueue
{
    public function handle(DocumentCreated $event): void
    {
        logger()->info('Document created', [$event]);
    }
}
