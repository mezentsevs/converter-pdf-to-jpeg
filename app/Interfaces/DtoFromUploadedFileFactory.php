<?php

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

interface DtoFromUploadedFileFactory
{
    public static function fromUploadedFile(UploadedFile $file): Dto;
}
