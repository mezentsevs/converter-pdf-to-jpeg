<?php

namespace App\Converters;

use App\Exceptions\DocumentConvertException;
use App\Exceptions\DocumentConvertReadDocumentException;
use App\Exceptions\DocumentConvertSetUpException;
use App\Exceptions\DocumentConvertTearDownException;
use App\Factories\ImageCreateDtoFactory;
use App\Helpers\StringHelper;
use App\Models\Document;
use App\Services\ImageService;
use App\Services\SliderService;
use Exception;
use Illuminate\Support\Facades\Storage;
use Imagick;
use ImagickException;

class ImagickDocumentConverter extends AbstractDocumentConverter
{
    public string $imageExt = 'jpeg';

    protected const int X_RESOLUTION = 300;

    protected const int Y_RESOLUTION = 300;

    protected const int COMPRESSION_QUALITY = 80;

    protected const string IMAGE_FORMAT = 'jpeg';

    protected const string ROTATE_BACKGROUND = '#000';

    protected const int ROTATE_DEGREES = -90;

    public function __construct(
        protected Imagick $imagick,
        protected ImageService $images,
        protected SliderService $sliders,
    ) {}

    /**
     * @throws DocumentConvertSetUpException
     */
    protected function setUp(): void
    {
        try {
            $this->imagick = new Imagick;

            $this->imagick->setResolution(self::X_RESOLUTION, self::Y_RESOLUTION);
        } catch (Exception | ImagickException) {
            throw new DocumentConvertSetUpException;
        }
    }

    /**
     * @throws DocumentConvertReadDocumentException
     */
    protected function readDocument(Document $document): void
    {
        try {
            $this->imagick->readImage($document->filepath);
        } catch (Exception | ImagickException) {
            throw new DocumentConvertReadDocumentException;
        }
    }

    /**
     * @throws DocumentConvertException
     */
    protected function convertDocument(Document $document): void
    {
        try {
            Storage::disk('public')->makeDirectory($document->images_relative_path);

            foreach ($this->imagick as $i => $image) {
                $image = $this->setUpImage($image);

                /**
                 * @var int $i
                 */
                $imageFilename = $this->makeImageFilename($document, ++$i);

                $imageFilepath = $document->images_absolute_path . DS . $imageFilename;

                $image->writeImage($imageFilepath);

                $this->images->create(ImageCreateDtoFactory::fromArray([
                    'document' => $document,
                    'filename' => $imageFilename,
                    'type' => mime_content_type($imageFilepath),
                    'size' => filesize($imageFilepath),
                ]));
            }

            $this->sliders->writeIndexHtml($document);
        } catch (Exception | ImagickException) {
            throw new DocumentConvertException;
        }
    }

    /**
     * @throws DocumentConvertTearDownException
     */
    protected function tearDown(): void
    {
        try {
            $this->imagick->clear();
        } catch (Exception | ImagickException) {
            throw new DocumentConvertTearDownException;
        }
    }

    /**
     * @throws ImagickException
     */
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
        return StringHelper::trimHashAndExt($document->filename)
            . '_'
            . StringHelper::prependLessThanTenZero($number)
            . SD
            . $this->imageExt;
    }
}
