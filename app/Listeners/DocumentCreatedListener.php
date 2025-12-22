<?php

namespace App\Listeners;

use App\Events\DocumentCreatedEvent;
use App\Jobs\DocumentConvertJob;
use Illuminate\Support\Facades\Cache;

class DocumentCreatedListener
{
    public function handle(DocumentCreatedEvent $event): void
    {
        logger()->info($event::class, [$event]);

        Cache::put(DocumentConvertJob::CACHE_PREFIX . $event->document->id, 'queued', now()->addMinutes(10));

        DocumentConvertJob::dispatch($event->document);
    }
}
