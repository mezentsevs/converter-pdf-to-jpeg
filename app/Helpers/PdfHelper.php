<?php

namespace App\Helpers;

class PdfHelper
{
    public static function countPages(string $path): int
    {
        exec("pdfinfo \"$path\"", $output);

        $count = 0;
        foreach ($output as $line) {
            if (preg_match('/Pages:\s*(\d+)/i', $line, $matches)) {
                $count = (int) $matches[1];
                break;
            }
        }

        return $count;
    }
}
