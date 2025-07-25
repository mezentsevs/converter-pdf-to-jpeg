<?php

namespace App\Factories;

use App\Dtos\ImageCreateDto;
use App\Interfaces\DtoFromArrayFactory;

class ImageCreateDtoFactory implements DtoFromArrayFactory
{
    public static function fromArray(array $data): ImageCreateDto
    {
        $dto = new ImageCreateDto();

        $dto->document = $data['document'];
        $dto->filename = $data['filename'];
        $dto->type = $data['type'];
        $dto->size = $data['size'];

        return $dto;
    }
}
