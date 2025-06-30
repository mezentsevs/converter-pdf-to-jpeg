<?php

namespace App\Providers;

use App\Archivers\ZipArchiver;
use App\Converters\ImagickDocumentConverter;
use App\Http\UploadedFile;
use App\Interfaces\Archiver;
use App\Interfaces\DocumentConverter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        Archiver::class => ZipArchiver::class,
        DocumentConverter::class => ImagickDocumentConverter::class,
        \Illuminate\Http\UploadedFile::class => UploadedFile::class,
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //
    }
}
