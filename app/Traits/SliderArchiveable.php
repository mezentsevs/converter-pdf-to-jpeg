<?php

namespace App\Traits;

use App\Helpers\StringHelper;
use App\Models\Document;

trait SliderArchiveable
{
    protected function makeSliderArchiveFullPath(Document $document, string $archiveExt): string
    {
        return $document->slider_archive_absolute_path
            . DS . StringHelper::trimHashAndExt($document->filename)
            . SD
            . $archiveExt;
    }
}
