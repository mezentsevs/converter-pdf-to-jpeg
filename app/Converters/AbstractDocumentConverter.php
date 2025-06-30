<?php

namespace App\Converters;

use App\Exceptions\DocumentConvertException;
use App\Exceptions\DocumentConvertReadDocumentException;
use App\Exceptions\DocumentConvertSetUpException;
use App\Exceptions\DocumentConvertTearDownException;
use App\Interfaces\DocumentConverter;
use App\Models\Document;

abstract class AbstractDocumentConverter implements DocumentConverter
{
    final public function convert(Document $document): bool
    {
        try {
            $this->setUp();

            $this->readDocument($document);

            $this->convertDocument($document);

            $this->tearDown();

            return true;
        } catch (DocumentConvertSetUpException
            | DocumentConvertReadDocumentException
            | DocumentConvertException
            | DocumentConvertTearDownException
        ) {
            return false;
        }
    }

    /**
     * @throws DocumentConvertSetUpException
     */
    protected function setUp(): void {}

    /**
     * @throws DocumentConvertReadDocumentException
     */
    abstract protected function readDocument(Document $document): void;

    /**
     * @throws DocumentConvertException
     */
    abstract protected function convertDocument(Document $document): void;

    /**
     * @throws DocumentConvertTearDownException
     */
    protected function tearDown(): void {}
}
