<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = [];
        foreach ($validator->errors()->toArray() as $key => $error) {

            $errorData = [
                'field' => $key,
                'message' => $error
            ];
            array_push($errors, $errorData);
        }
        throw new HttpResponseException(response()->json([
            'name' => "Bad Request",
            'message' => $errors,
            'status' => 400
        ], 400));
    }
}
