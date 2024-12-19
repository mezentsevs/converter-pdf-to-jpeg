<?php

namespace App\Services;

use App\Events\DocumentCreatedEvent;
use App\Events\DocumentDeletedEvent;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentService
{
    public function create(User $user, UploadedFile $file): Document
    {
        $ext = $file->extension();
        $hash = Str::of($file->hashName())->basename(".{$ext}");
        $slug = Str::of($file->getClientOriginalName())->basename(".{$ext}")->slug('_');

        $document = $user->documents()->create([
            'filename' => basename($file->storeAs(config('documents.directory'), "{$hash}_{$slug}.{$ext}")),
            'type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        event(new DocumentCreatedEvent($user, $document));

        return $document;
    }

    public function delete(Document $document): void
    {
        Storage::delete(config('documents.directory') . DS . $document->filename);

        $document->delete();

        event(new DocumentDeletedEvent($document));
    }
}
