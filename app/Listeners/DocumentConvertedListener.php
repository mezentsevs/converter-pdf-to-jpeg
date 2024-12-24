<?php

namespace App\Listeners;

use App\Events\DocumentConvertedEvent;

class DocumentConvertedListener
{
    public function handle(DocumentConvertedEvent $event): void
    {
        logger()->info($event::class, [$event]);
    }
}
