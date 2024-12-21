<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Http\RedirectResponse;

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
            return redirect()
                ->route('result')
                ->with('error', __('documents.uploads.errors.invalid'));
        }

        $this->documents->create($request->user(), $file);

        return redirect()
            ->route('result')
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
