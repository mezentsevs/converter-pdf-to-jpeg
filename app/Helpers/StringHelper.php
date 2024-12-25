<?php

namespace App\Helpers;

class StringHelper
{
    public static function prependLessThanTenZero(int $number): string
    {
        return sprintf('%02d', $number);
    }

    public static function trimExt(string $filename): string
    {
        return pathinfo($filename, PATHINFO_FILENAME);
    }

    public static function trimHash(string $filename): string
    {
        return substr($filename, stripos($filename, '_') + 1);
    }
}
