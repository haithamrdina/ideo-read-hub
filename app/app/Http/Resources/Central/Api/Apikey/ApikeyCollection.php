<?php

namespace App\Http\Resources\Central\Api\Apikey;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class ApikeyCollection extends ResourceCollection
{
    protected $paginator;

    public function setPaginator(LengthAwarePaginator $paginator)
    {
        $this->paginator = $paginator;
    }
    public function paginator()
    {
        return $this->paginator;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'items' => ApikeyResource::collection($this->collection),
            '_links' => [
                "self" => [
                    "href" => $this->paginator()->url($this->paginator()->currentPage())
                ],
                "goto" => [
                    "href" => $this->paginator()->nextPageUrl()
                ],
                "first" => [
                    "href" => $this->paginator()->url(1)
                ],
                "last" => [
                    "href" => $this->paginator()->url($this->paginator()->lastPage())
                ]
            ],
            "meta" => [
                "count" => $this->paginator()->count(),
                "has_more_data" => $this->paginator()->hasMorePages(),
                'current_page' => $this->paginator()->currentPage(),
                'current_page_size' => $this->paginator()->perPage(),
                'total_page_count' => $this->paginator()->lastPage(),
                'total_count' => $this->paginator()->total()
            ]
        ];
    }
}
