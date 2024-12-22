<?php

namespace App\Services;

use App\Dtos\ImageCreateDto;
use App\Events\ImageCreatedEvent;
use App\Models\Image;

class ImageService
{
    public function create(ImageCreateDto $dto): Image
    {
        $image = $dto->document->images()->create([
            'filename' => $dto->filename,
            'type' => $dto->type,
            'size' => $dto->size,
        ]);

        event(new ImageCreatedEvent($dto->document->user, $image));

        return $image;
    }
}
