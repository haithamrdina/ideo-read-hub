<?php

namespace App\Http\Requests\Central\Api\Auth;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ];
    }

    /**
     * Get the body parameters for the request.
     *
     * @return array
     */
    public function bodyParameters()
    {
        return [
            'username' => [
                'description' => 'The email address of the user.',
                'example' => 'example@example.com',
            ],
            'password' => [
                'description' => 'The password of the user.',
                'example' => 'password123',
            ],
        ];
    }
}
