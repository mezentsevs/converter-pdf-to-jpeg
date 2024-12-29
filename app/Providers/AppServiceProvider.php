<?php

namespace App\Providers;

use App\Archivers\ZipArchiver;
use App\Converters\ImagickDocumentConverter;
use App\Http\UploadedFile;
use App\Interfaces\ArchiverInterface;
use App\Interfaces\DocumentConverterInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ArchiverInterface::class => ZipArchiver::class,
        DocumentConverterInterface::class => ImagickDocumentConverter::class,
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
