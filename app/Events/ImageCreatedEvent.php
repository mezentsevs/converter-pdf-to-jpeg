<?php

namespace App\Events;

use App\Models\Image;

class ImageCreatedEvent extends BaseEvent
{
    public function __construct(public Image $image)
    {
    }
}
