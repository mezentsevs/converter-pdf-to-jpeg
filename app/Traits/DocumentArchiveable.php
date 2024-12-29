<?php

namespace App\Traits;

use App\Helpers\StringHelper;
use App\Models\Document;

trait DocumentArchiveable
{
    protected function makeDocumentArchiveFullPath(Document $document, string $archiveExt): string
    {
        return $document->archive_absolute_path
            . DS . StringHelper::trimHashAndExt($document->filename)
            . SD
            . $archiveExt;
    }
}
