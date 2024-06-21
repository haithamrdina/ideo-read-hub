<?php

namespace App\Http\Requests\Central\Api\Section;

use App\Http\Requests\BaseRequest;

class StoreSectionRequest extends BaseRequest
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
            'tenant_id' => 'required|exists:tenants,id',
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'products' => 'nullable|string'
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
            ],
            'name' => [
                'description' => 'The name of the section',
                'example' => 'section 0',
            ],
            'description' => [
                'description' => 'The description of the section',
                'example' => 'description of section 0',
            ],
            'products' => [
                'description' => 'The productIDs which assign to section (You can separate products with commas, spaces or tabs.)',
                'example' => '11111 22222',
            ],

        ];
    }
}
