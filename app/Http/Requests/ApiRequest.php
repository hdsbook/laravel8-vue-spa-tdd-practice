<?php

namespace App\Http\Requests;

use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreNews extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        return new HttpResponseException(
            response($validator->errors())
        );
    }
}
