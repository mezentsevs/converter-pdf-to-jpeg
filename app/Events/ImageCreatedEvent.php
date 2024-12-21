<?php

namespace App\Events;

use App\Models\Image;
use App\Models\User;

class ImageCreatedEvent extends BaseEvent
{
    public function __construct(public User $causer, public Image $image) {}
}
