<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'success' => false,
            'errors' => $errors->messages(),
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
