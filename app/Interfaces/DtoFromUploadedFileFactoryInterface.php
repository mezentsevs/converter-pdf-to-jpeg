<?php

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

interface DtoFromUploadedFileFactoryInterface
{
    public static function fromUploadedFile(UploadedFile $file): DtoInterface;
}
