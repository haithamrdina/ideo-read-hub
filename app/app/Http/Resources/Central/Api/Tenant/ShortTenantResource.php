<?php

namespace App\Http\Resources\Central\Api\Tenant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortTenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company' => $this->company,
            'provider' => $this->provider,
            'endpoints' => [
                'web' => config('app.url') . '/' . $this->id,
                'api' => config('app.url') . '/api/' . $this->id,
            ],
        ];
    }
}
