<?php

namespace App\Jobs;

use App\Events\DocumentConvertedEvent;
use App\Exceptions\DocumentConvertCommonException;
use App\Exceptions\DocumentMaxPagesCountException;
use App\Helpers\PdfHelper;
use App\Models\Document;
use App\Services\DocumentService;
use App\Services\SliderService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class DocumentConvertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public const string CACHE_PREFIX = 'document_convert_';

    public const int MAX_TRIES = 3;

    public const int TIMEOUT = 300;

    public int $tries = self::MAX_TRIES;

    public int $timeout = self::TIMEOUT;

    public function __construct(public Document $document)
    {
    }

    public function handle(DocumentService $documents, SliderService $sliders): void
    {
        try {
            Cache::put($this->getCacheKey(), 'processing', now()->addMinutes(10));

            if (($currentPagesCount = PdfHelper::countPages($this->document->filepath)) > config('documents.max_pages_count')) {
                $documents->delete($this->document);

                throw new DocumentMaxPagesCountException(__('documents.conversions.exceptions.max_pages_count', [
                    'current' => $currentPagesCount,
                    'max' => config('documents.max_pages_count'),
                ]));
            }

            if (!$documents->convert($this->document)) {
                throw new DocumentConvertCommonException(__('documents.conversions.exceptions.common'));
            }

            Cache::put($this->getCacheKey(), 'success', now()->addMinutes(10));
            Cache::put($this->getSlidesCacheKey(), $sliders->getSlides($this->document), now()->addMinutes(10));
            Cache::put($this->getSuccessMessageKey(), __('documents.conversions.success'), now()->addMinutes(10));
            Cache::put($this->getDocumentKey(), $this->document->id, now()->addMinutes(10));

            event(new DocumentConvertedEvent($this->document));
        } catch (DocumentMaxPagesCountException | DocumentConvertCommonException $e) {
            Cache::put($this->getCacheKey(), 'error', now()->addMinutes(10));
            Cache::put($this->getErrorCacheKey(), $e->getMessage(), now()->addMinutes(10));

            throw $e;
        }
    }

    public function failed(\Throwable $exception): void
    {
        if (!str_contains($exception->getMessage(), 'Max pages count exceeded')) {
            Cache::put($this->getCacheKey(), 'error', now()->addMinutes(10));
            Cache::put($this->getErrorCacheKey(), __('documents.conversions.exceptions.common'), now()->addMinutes(10));
        }
    }

    protected function getCacheKey(): string
    {
        return self::CACHE_PREFIX . $this->document->id;
    }

    protected function getSlidesCacheKey(): string
    {
        return self::CACHE_PREFIX . 'slides_' . $this->document->id;
    }

    protected function getErrorCacheKey(): string
    {
        return self::CACHE_PREFIX . 'error_' . $this->document->id;
    }

    protected function getSuccessMessageKey(): string
    {
        return self::CACHE_PREFIX . 'success_message_' . $this->document->id;
    }

    protected function getDocumentKey(): string
    {
        return self::CACHE_PREFIX . 'document_' . $this->document->id;
    }
}
