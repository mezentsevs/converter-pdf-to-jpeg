<?php

namespace App\Converters;

use App\Interfaces\DocumentConverterInterface;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Imagick;
use ImagickException;

class ImagickDocumentConverter implements DocumentConverterInterface
{
    protected const int X_RESOLUTION = 300;

    protected const int Y_RESOLUTION = 300;

    protected const int COMPRESSION_QUALITY = 80;

    protected const string IMAGE_FORMAT = 'jpeg';

    protected const string ROTATE_BACKGROUND = '#000';

    protected const int ROTATE_DEGREES = -90;

    public function convert(Document $document): bool
    {
        try {
            $imagick = new Imagick();

            $imagick->setResolution(self::X_RESOLUTION, self::Y_RESOLUTION);

            $imagick->readImage($document->filepath);

            foreach ($imagick as $i => $image) {
                $image->setImageColorspace(Imagick::COLORSPACE_RGB);

                $image->setCompression(Imagick::COMPRESSION_JPEG);

                $image->setCompressionQuality(self::COMPRESSION_QUALITY);

                $image->setImageFormat(self::IMAGE_FORMAT);

                if ($image->getImageWidth() > $image->getImageHeight()) {
                    $image->rotateImage(self::ROTATE_BACKGROUND, self::ROTATE_DEGREES);
                }

                Storage::makeDirectory($document->images_relative_path);

                $imageFilename = substr($document->filename, 0, -4)
                    . (++$i < 10 ? "_0$i" : "_$i")
                    . '.'
                    . self::IMAGE_FORMAT;

                $image->writeImage($document->images_absolute_path . DS . $imageFilename);
            }

            return true;
        } catch (ImagickException) {
            return false;
        }
    }
}
