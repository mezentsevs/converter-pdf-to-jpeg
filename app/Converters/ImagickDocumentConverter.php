<?php

namespace App\Converters;

use App\Helpers\StringHelper;
use App\Interfaces\DocumentConverterInterface;
use App\Models\Document;
use App\Services\ImageService;
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

    protected ImageService $images;

    protected Imagick $imagick;

    public function __construct()
    {
        $this->images = app(ImageService::class);

        $this->imagick = new Imagick();

        $this->setUp();
    }

    public function convert(Document $document): bool
    {
        try {
            $this->imagick->readImage($document->filepath);

            Storage::makeDirectory($document->images_relative_path);

            foreach ($this->imagick as $i => $image) {
                $image = $this->setUpImage($image);

                $imageFilename = $this->makeImageFilename($document, (int) ++$i);

                $imageFilepath = $document->images_absolute_path . DS . $imageFilename;

                $image->writeImage($imageFilepath);

                $this->images->create($document, [
                    'filename' => $imageFilename,
                    'type' => mime_content_type($imageFilepath),
                    'size' => filesize($imageFilepath),
                ]);
            }

            return true;
        } catch (ImagickException) {
            return false;
        } finally {
            $this->tearDown();
        }
    }

    protected function setUp(): void
    {
        $this->imagick->setResolution(self::X_RESOLUTION, self::Y_RESOLUTION);
    }

    protected function setUpImage(Imagick $image): Imagick
    {
        $image->setImageColorspace(Imagick::COLORSPACE_RGB);

        $image->setCompression(Imagick::COMPRESSION_JPEG);

        $image->setCompressionQuality(self::COMPRESSION_QUALITY);

        $image->setImageFormat(self::IMAGE_FORMAT);

        if ($image->getImageWidth() > $image->getImageHeight()) {
            $image->rotateImage(self::ROTATE_BACKGROUND, self::ROTATE_DEGREES);
        }

        return $image;
    }

    protected function makeImageFilename(Document $document, int $number): string
    {
        return substr($document->filename, 0, -4)
            . '_'
            . StringHelper::prependLessThanTenZero($number)
            . '.'
            . self::IMAGE_FORMAT;
    }

    protected function tearDown(): void
    {
        $this->imagick->clear();
    }

    public function __destruct()
    {
        $this->tearDown();
    }
}
