<?php

namespace App\Listeners;

use App\Events\ImageCreatedEvent;

class ImageCreatedListener
{
    public function handle(ImageCreatedEvent $event): void
    {
        logger()->info($event::class, [$event]);
    }
}
