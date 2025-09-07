<?php

namespace App\Http\Controllers;

use App\Factories\DocumentCreateDtoFactory;
use App\Http\Requests\DownloadSliderDocumentRequest;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\UploadedFile;
use App\Interfaces\Archiver;
use App\Models\Document;
use App\Services\DocumentService;
use App\Services\SliderService;
use App\Traits\WithUploadedFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentController extends Controller
{
    use WithUploadedFile;

    public function __construct(
        protected Archiver $archiver,
        protected DocumentService $documents,
        protected SliderService $sliders,
    ) {
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

    public function downloadSlider(DownloadSliderDocumentRequest $request, Document $document): BinaryFileResponse
    {
        Storage::disk('public')->makeDirectory($document->slider_archive_relative_path);

        $path = $this->sliders->makeSliderArchiveFullPath($document, $this->archiver->archiveFileExtension);

        if (!$this->archiver->makeArchive($document->slider_absolute_path, $path)) {
            abort(520);
        }

        return response()->download($path);
    }
}
