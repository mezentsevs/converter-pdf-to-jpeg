<?php

namespace App\Services;

use App\Events\ImageCreatedEvent;
use App\Models\Document;
use App\Models\Image;

class ImageService
{
    public function create(Document $document, array $data): Image
    {
        $image = $document->images()->create([
            'filename' => $data['filename'],
            'type' => $data['type'],
            'size' => $data['size'],
        ]);

        event(new ImageCreatedEvent($document->user, $image));

        return $image;
    }
}
