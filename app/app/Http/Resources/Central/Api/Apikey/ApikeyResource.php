<?php

namespace App\Http\Resources\Central\Api\Apikey;

use App\Http\Resources\Central\Api\Tenant\ShortTenantResource;
use App\Http\Resources\UserStampResource;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApikeyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $tenant = Tenant::findOrFail($this->tenant_id);
        return [
            'id' => $this->id,
            'api-key' => $this->key,
            'created_at' => $this->created_at,
            'created_by' => new UserStampResource($this->creator),
            'tenant' => new ShortTenantResource($tenant),

        ];
    }
}
