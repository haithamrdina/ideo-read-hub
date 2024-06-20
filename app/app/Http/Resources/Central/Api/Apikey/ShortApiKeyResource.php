<?php

namespace App\Http\Resources\Central\Api\Apikey;

use App\Http\Resources\UserStampResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortApiKeyResource extends JsonResource
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
            'api-key' => $this->key,
            'created_at' => $this->created_at,
            'created_by' => new UserStampResource($this->creator)

        ];
    }
}
