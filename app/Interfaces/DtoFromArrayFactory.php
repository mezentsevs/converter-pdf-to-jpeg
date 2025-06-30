<?php

namespace App\Interfaces;

interface DtoFromArrayFactory
{
    public static function fromArray(array $data): Dto;
}
