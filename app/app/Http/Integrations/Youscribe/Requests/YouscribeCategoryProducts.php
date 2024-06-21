<?php

namespace App\Http\Integrations\Youscribe\Requests;

use App\Models\Catalogue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class YouscribeCategoryProducts extends Request implements Paginatable
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    protected int $category_id;
    public function __construct(int $category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/v2/products/search';
    }

    protected function defaultQuery(): array
    {
        return [
            'offer_type[0]' => 'Subscription',
            'offer_type[1]' => 'Free',
            'category_id' => $this->category_id,
            'sort' => 'online_date'
        ];
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $items = $response->json('Products');
        $filteredItems = array_map(function ($item) {
            $product = $this->getProductInfos($item);
            return $product;
        }, $items);
        return $filteredItems;
    }

    function startsWith($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }

    function getProductInfos($subArray)
    {
        $keys = array_keys($subArray);

        $tag_id = null;
        $theme_id = null;
        if (isset($subArray['Theme']) && $subArray['Theme'] != null) {
            if ($subArray['Theme']['Parent'] != null) {
                $theme_id = isset($subArray['Theme']['Parent']['Id']) ? $subArray['Theme']['Parent']['Id'] : null;
                $tag_id = isset($subArray['Theme']['Id']) ? $subArray['Theme']['Id'] : null;

            } else {
                $theme_id = isset($subArray['Theme']['Id']) ? $subArray['Theme']['Id'] : null;
                $tag_id = null;
            }
        }

        $thumbnail = $subArray['ThumbnailUrls']['0']['Url'];
        if (Str::startsWith($thumbnail, 'http')) {
            try {
                $response = Http::head($thumbnail);
                if ($response->successful()) {
                    $thumbnailUrl = $thumbnail;
                } else {
                    $thumbnailUrl = 'https://www.youscribe.com/Content/imgv3/default/default-product.png';
                }
            } catch (\Exception $e) {
                $thumbnailUrl = 'https://www.youscribe.com/Content/imgv3/default/default-product.png';
            }
        } else {
            $thumbnailUrl = 'https://www.youscribe.com' . $thumbnail;
        }

        $subArray['productId'] = $subArray['Id'];
        $subArray['ownerId'] = $subArray['OwnerId'];
        $subArray['title'] = $subArray['Title'];
        $subArray['description'] = $subArray['Description'];
        $subArray['thumbnailUrl'] = $thumbnailUrl;
        $subArray['onlineDate'] = (isset($subArray['OnlineDate']) && date("Y-m-d H:i:s", strtotime($subArray['OnlineDate'])) != "0001-01-01 00:00:00") ? date("Y-m-d H:i:s", strtotime($subArray['OnlineDate'])) : null;
        $subArray['publishDate'] = (isset($subArray['PublishDate']) && date("Y-m-d H:i:s", strtotime($subArray['PublishDate'])) != "0001-01-01 00:00:00") ? date("Y-m-d H:i:s", strtotime($subArray['PublishDate'])) : null;
        $subArray['estimatedReadTime'] = (isset($subArray['EstimatedReadTime']) && date("H:i:s", strtotime($subArray['EstimatedReadTime'])) != "00:00:00") ? date("H:i:s", strtotime($subArray['EstimatedReadTime'])) : null;
        $subArray['nbPages'] = $subArray['NbPages'];
        $subArray['authors'] = implode(', ', $subArray['Authors']);
        $subArray['ownerUsername'] = $subArray['OwnerUserName'];
        $subArray['ownerDisplayableUserName'] = $subArray['OwnerDisplayableUserName'];
        $subArray['language'] = $subArray['Language'];
        $subArray['authors'] = implode(',', $subArray['Authors']);
        $subArray['link'] = ($subArray['Category']['Id'] == 69) ? "https://www.youscribe.com/BookReader/AudioReader?productId=" . $subArray['Id'] . "&ysauth=" : "https://www.youscribe.com/BookReader/Index/" . $subArray['Id'] . "?ysauth=";
        $subArray['category_id'] = optional(Catalogue::where('id_youscribe', $subArray['Category']['Id'])->whereNull('parent_id')->first())->id;
        if ($subArray['Category']['Id'] !== 67) {
            $subArray['theme_id'] = optional(Catalogue::where('id_youscribe', $theme_id)->where('parent_id', $subArray['category_id'])->first())->id != null ? Catalogue::where('id_youscribe', $theme_id)->where('parent_id', $subArray['category_id'])->first()->id : Catalogue::where('id_youscribe', 2024)->where('parent_id', $subArray['category_id'])->first()->id;
            $subArray['tag_id'] = $subArray['theme_id'] != Catalogue::where('id_youscribe', 2024)->where('parent_id', $subArray['category_id'])->first()->id ? optional(Catalogue::where('id_youscribe', $tag_id)->where('parent_id', $subArray['theme_id'])->first())->id : null;
        } else {
            $subArray['theme_id'] = optional(Catalogue::where('id_youscribe', $theme_id)->where('parent_id', $subArray['category_id'])->first())->id != null ? Catalogue::where('id_youscribe', $theme_id)->where('parent_id', $subArray['category_id'])->first()->id : null;
            $subArray['tag_id'] = $subArray['theme_id'] != null ? optional(Catalogue::where('id_youscribe', $tag_id)->where('parent_id', $subArray['theme_id'])->first())->id : null;
        }
        $subArray['nbPages'] = $subArray['NbPages'];

        foreach ($keys as $key) {
            unset($subArray[$key]);
        }
        return $subArray;
    }
}
