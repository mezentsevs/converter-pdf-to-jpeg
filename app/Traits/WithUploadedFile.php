<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait WithUploadedFile
{
    protected function makeUploadedFileName(UploadedFile $file): string
    {
        $ext = $file->extension();
        $hash = Str::of($file->hashName())->basename(".{$ext}");
        $slug = Str::of($file->getClientOriginalName())->basename(".{$ext}")->slug('_');

        return "{$hash}_{$slug}.{$ext}";
    }
}
