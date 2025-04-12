<?php

namespace App\Listeners;

use App\Events\DocumentCreatedEvent;
use App\Exceptions\DocumentConvertCommonException;
use App\Exceptions\DocumentMaxPagesCountException;
use App\Helpers\PdfHelper;
use App\Services\DocumentService;
use App\Services\SliderService;
use Illuminate\Http\RedirectResponse;

class DocumentCreatedListener
{
    public function __construct(
        protected DocumentService $documents,
        protected SliderService $sliders,
    ) {}

    public function handle(DocumentCreatedEvent $event): RedirectResponse
    {
        logger()->info($event::class, [$event]);

        try {
            if (($currentPagesCount = PdfHelper::countPages($event->document->filepath)) > config('documents.max_pages_count')) {
                $this->documents->delete($event->document);

                throw new DocumentMaxPagesCountException(__('documents.conversions.exceptions.max_pages_count', [
                    'current' => $currentPagesCount,
                    'max' => config('documents.max_pages_count'),
                ]));
            }

            if ($this->documents->convert($event->document)) {
                session()->put('slides', $this->sliders->getSlides($event->document));

                return redirect()
                    ->route('result')
                    ->with([
                        'document' => $event->document,
                        'converted' => __('documents.conversions.success'),
                    ]);
            }

            throw new DocumentConvertCommonException(__('documents.conversions.exceptions.common'));
        } catch (DocumentMaxPagesCountException | DocumentConvertCommonException $e) {
            return redirect()
                ->route('result')
                ->with('error', $e->getMessage());
        }
    }
}
