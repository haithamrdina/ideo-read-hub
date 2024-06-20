<?php

namespace App\Http\Resources\Central\Api\Tenant;

use App\Http\Resources\UserStampResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TenantResource extends JsonResource
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
            'favicon' => $this->favicon != null ? asset('storage/' . $this->favicon) : null,
            'logo' => $this->logo != null ? asset('storage/' . $this->logo) : null,
            'banner' => $this->banner != null ? asset('storage/' . $this->banner) : null,
            'theme' => $this->theme != null ? [
                'file' => asset('storage/' . $this->theme),
                'content' => Storage::disk('public')->get($this->theme),
            ] : [],
            'creation_date' => $this->created_at,
            'created_by' => new UserStampResource($this->creator),
            'updated_on' => $this->updated_at,
            'updated_by' => new UserStampResource($this->editor),
        ];
    }
}
