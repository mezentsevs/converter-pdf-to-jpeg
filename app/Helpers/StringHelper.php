<?php

namespace App\Helpers;

class StringHelper
{
    public static function prependLessThanTenZero(int $number): string
    {
        return $number < 10 ? "0$number" : "$number";
    }
}
