<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DownloadSliderDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('download-slider', $this->route()->parameter('document'));
    }
}
