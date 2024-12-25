<?php

namespace App\Listeners;

use App\Events\DocumentCreatedEvent;
use App\Exceptions\DocumentMaxPagesCountException;
use App\Helpers\PdfHelper;
use App\Services\DocumentService;
use App\Services\SliderService;
use Illuminate\Http\RedirectResponse;

class DocumentCreatedListener
{
    protected DocumentService $documents;

    protected SliderService $sliders;

    public function __construct()
    {
        $this->documents = app(DocumentService::class);

        $this->sliders = app(SliderService::class);
    }

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
                return redirect()
                    ->route('result')
                    ->with('converted', __('documents.conversions.success'))
                    ->with('slides', $this->sliders->getSlidesForDocument($event->document));
            }

            throw new \Exception;
        } catch (DocumentMaxPagesCountException $e) {
            return redirect()
                ->route('result')
                ->with('error', $e->getMessage());
        } catch (\Exception) {
            return redirect()
                ->route('result')
                ->with('error', __('documents.conversions.errors.common'));
        }
    }
}
