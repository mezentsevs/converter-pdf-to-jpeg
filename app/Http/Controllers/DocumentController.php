<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    protected DocumentService $documents;

    public function __construct()
    {
        $this->documents = app(DocumentService::class);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreDocumentRequest $request): RedirectResponse
    {
        $file = $request->file('document');

        if (!$file?->isValid()) {
            abort(422, __('documents.uploads.errors.invalid'));
        }

        $ext = $file->extension();
        $hash = Str::of($file->hashName())->basename(".{$ext}");
        $slug = Str::of($file->getClientOriginalName())->basename(".{$ext}")->slug('_');

        $this->documents->create($request->user(), [
            'filename' => basename($file->storeAs(config('documents.directory'), "{$hash}_{$slug}.{$ext}")),
            'type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', __('documents.uploads.success'));
    }

    public function show(Document $document)
    {
        //
    }

    public function edit(Document $document)
    {
        //
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        //
    }

    public function destroy(Document $document)
    {
        //
    }
}
