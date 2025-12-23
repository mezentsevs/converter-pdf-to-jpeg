<?php

namespace App\Http\Requests;

use App\Models\Document;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Document::class);
    }

    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'document' => [
                'required',
                'file',
                'mimetypes:application/pdf',
                'max:' . (int) round(config('uploads.post.max_file_size') / 1024),
            ],
        ];
    }

    public function messages(): array
    {
        $maxFileSizeMB = config('uploads.post.max_file_size_mb');

        return [
            'document.max' => "The document field must not be greater than {$maxFileSizeMB} MB.",
        ];
    }
}
