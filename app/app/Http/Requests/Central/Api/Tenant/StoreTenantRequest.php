<?php

namespace App\Http\Requests\Central\Api\Tenant;

use App\Http\Requests\BaseRequest;

class StoreTenantRequest extends BaseRequest
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
            'company' => 'required|string',
            'provider' => 'required|string|in:docebo,forma,moodle',
            'subfolder' => 'required|unique:tenants,id',
            'favicon' => 'nullable|mimes:jpeg,png,jpg,ico|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'theme' => 'nullable|string'
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
            'company' => [
                'description' => 'The company name.',
                'example' => 'Ideo Factory',
            ],
            'provider' => [
                'description' => 'The learning management system provider.',
                'enum' => ['docebo', 'forma', 'moodle'],
                'example' => 'docebo',
            ],
            'subfolder' => [
                'description' => 'The path identification',
                'example' => 'ideo',
            ],
            'favicon' => [
                'description' => 'The favicon of the company.',
            ],
            'logo' => [
                'description' => 'The logo of the company.',
            ],
            'banner' => [
                'description' => 'The banner of the company.',
            ],
            'theme' => [
                'description' => 'The stylesheet  of the company.',
            ],
        ];
    }
}
