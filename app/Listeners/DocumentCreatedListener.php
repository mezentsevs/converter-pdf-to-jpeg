<?php

namespace App\Listeners;

use App\Events\DocumentCreatedEvent;
use App\Exceptions\DocumentMaxPagesCountException;
use App\Helpers\PdfHelper;
use App\Services\DocumentService;
use Illuminate\Http\RedirectResponse;

class DocumentCreatedListener
{
    protected DocumentService $documents;

    public function __construct()
    {
        $this->documents = app(DocumentService::class);
    }

    public function handle(DocumentCreatedEvent $event): RedirectResponse
    {
        logger()->info($event::class, [$event]);

        try {
            $path = storage_path('app'
                . DS . 'private'
                . DS . config('documents.directory')
                . DS . $event->document->filename
            );

            if (($currentPagesCount = PdfHelper::countPages($path)) > config('documents.max_pages_count')) {
                throw new DocumentMaxPagesCountException(__('documents.conversions.errors.max_pages_count', [
                    'current' => $currentPagesCount,
                    'max' => config('documents.max_pages_count'),
                ]));
            }

            if ($this->documents->convert($event->document)) {
                return redirect()
                    ->route('dashboard')
                    ->with('converted', __('documents.conversions.success'));
            }

            throw new \Exception;
        } catch (DocumentMaxPagesCountException $e) {
            return redirect()
                ->route('dashboard')
                ->with('error', $e->getMessage());
        } catch (\Exception) {
            return redirect()
                ->route('dashboard')
                ->with('error', __('documents.conversions.errors.common'));
        } finally {
            $this->documents->delete($event->document);
        }
    }
}
