<?php

namespace App\Http\Requests\Central\Api\Apikey;

use App\Http\Requests\BaseRequest;

class StoreApikeyRequest extends BaseRequest
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
            'tenant_id' => 'required|exists:tenants,id'
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
            'tenant_id' => [
                'description' => 'The id of the tenant',
                'example' => 0,
            ]
        ];
    }
}
