<?php

namespace App\Http\Requests\Api;

class IndexSlideRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }
}
