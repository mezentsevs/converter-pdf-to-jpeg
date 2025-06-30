<?php

namespace App\Factories;

use App\Dtos\DocumentCreateDto;
use App\Interfaces\DtoFromUploadedFileFactory;
use Illuminate\Http\UploadedFile;

class DocumentCreateDtoFactory implements DtoFromUploadedFileFactory
{
    public static function fromUploadedFile(UploadedFile $file): DocumentCreateDto
    {
        $dto = new DocumentCreateDto;

        /**
         * @var \App\Http\UploadedFile $file
         */
        $dto->user = $file->user;
        $dto->filename = $file->filename;
        $dto->type = $file->getMimeType();
        $dto->size = $file->getSize();

        return $dto;
    }
}
