<?php

namespace App\Http\Requests;

use Dotenv\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
trait FailedValidationResponse
{
    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors()
        ], 422));
    }
}
