<?php

namespace App\Http\Controllers;

use App\Factories\DocumentCreateDtoFactory;
use App\Http\Requests\DownloadSliderDocumentRequest;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Http\UploadedFile;
use App\Interfaces\ArchiverInterface;
use App\Models\Document;
use App\Services\DocumentService;
use App\Traits\DocumentArchiveable;
use App\Traits\UploadedFileable;
use Illuminate\Http\RedirectResponse;

class DocumentController extends Controller
{
    use UploadedFileable, DocumentArchiveable;

    protected DocumentService $documents;

    public function __construct(protected ArchiverInterface $archiver)
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

        /**
         * @var UploadedFile $file
         */
        $file->user = $request->user();
        $file->filename = basename($file->storeAs(config('documents.directory'), $this->makeUploadedFileName($file)));

        $this->documents->create(DocumentCreateDtoFactory::fromUploadedFile($file));

        return redirect()
            ->route('result')
            ->with('uploaded', __('documents.uploads.success'));
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

    public function downloadSlider(DownloadSliderDocumentRequest $request, Document $document): void
    {
        //
    }
}
