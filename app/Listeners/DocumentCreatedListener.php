<?php

namespace App\Listeners;

use App\Events\DocumentCreatedEvent;
use App\Exceptions\DocumentMaxPagesCountException;
use App\Helpers\PdfHelper;
use App\Services\DocumentService;
use App\Services\SliderService;
use Exception;
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

                throw new DocumentMaxPagesCountException(__('documents.conversions.errors.max_pages_count', [
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

            throw new Exception;
        } catch (DocumentMaxPagesCountException $e) {
            return redirect()
                ->route('result')
                ->with('error', $e->getMessage());
        } catch (Exception) {
            return redirect()
                ->route('result')
                ->with('error', __('documents.conversions.errors.common'));
        }
    }
}
