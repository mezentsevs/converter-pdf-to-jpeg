<?php

namespace App\Providers;

use App\Converters\ImagickDocumentConverter;
use App\Interfaces\DocumentConverterInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        DocumentConverterInterface::class => ImagickDocumentConverter::class,
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
