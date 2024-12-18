<?php

namespace App\Listeners;

use App\Events\DocumentCreatedEvent;
use Illuminate\Http\RedirectResponse;

class DocumentCreatedListener
{
    public function handle(DocumentCreatedEvent $event): RedirectResponse
    {
        try {
            return redirect()->route('dashboard')->with('converted', __('documents.conversions.success'));
        } catch (\Exception) {
            return redirect()->route('dashboard')->with('error', __('documents.conversions.errors.common'));
        }
    }
}
