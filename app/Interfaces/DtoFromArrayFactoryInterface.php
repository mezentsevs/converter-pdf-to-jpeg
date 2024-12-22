<?php

namespace App\Interfaces;

interface DtoFromArrayFactoryInterface
{
    public static function fromArray(array $data): DtoInterface;
}
