<?php

namespace App\Listeners;

use App\Events\DocumentCreatedEvent;
use App\Exceptions\DocumentMaxPagesCountException;
use App\Helpers\PdfHelper;
use Illuminate\Http\RedirectResponse;

class DocumentCreatedListener
{
    public function handle(DocumentCreatedEvent $event): RedirectResponse
    {
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

            return redirect()->route('dashboard')->with('converted', __('documents.conversions.success'));
        } catch (DocumentMaxPagesCountException $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        } catch (\Exception) {
            return redirect()->route('dashboard')->with('error', __('documents.conversions.errors.common'));
        }
    }
}
