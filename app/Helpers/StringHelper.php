<?php

namespace App\Helpers;

class StringHelper
{
    public static function prependLessThanTenZero(int $number): string
    {
        return sprintf("%02d", $number);
    }
}
