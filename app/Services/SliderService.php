<?php

namespace App\Services;

use App\Models\Document;

class SliderService
{
    public function getSlides(Document $document): array
    {
        $slides = [];

        foreach ($document->images as $image) {
            $slides[] = asset('storage'
                . DS . $document->imagesRelativePath
                . DS . $image->filename
            );
        }

        return $slides;
    }
}
