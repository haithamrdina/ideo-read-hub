<?php

namespace App\Repositories\Central;

use App\Http\Resources\Central\Api\Apikey\ApikeyCollection;
use App\Http\Resources\Central\Api\Apikey\ShortApiKeyCollection;
use App\Interfaces\Central\ApikeyRepositoryInterface;
use App\Models\ApiKey;
use App\Models\Tenant;
use Illuminate\Support\Str;

class ApikeyRepository implements ApikeyRepositoryInterface
{
    public function list_apikey($params)
    {
        if (!isset($params['tenant_id'])) {
            $paginatedApikeys = ApiKey::paginate($params['page_size']);
            $apikeyCollection = new ApikeyCollection($paginatedApikeys);
        } else {
            $paginatedApikeys = ApiKey::where('tenant_id', $params['tenant_id'])->paginate(15);
            $apikeyCollection = new ShortApiKeyCollection($paginatedApikeys);
        }

        $apikeyCollection->setPaginator($paginatedApikeys);
        return $apikeyCollection;
    }
    public function get_apikey_by_id($id)
    {
        return ApiKey::findOrFail($id);
    }
    public function store_apikey($data)
    {
        return ApiKey::create([
            'tenant_id' => $data['tenant_id'],
            'key' => Str::random(64),
        ]);


    }
    public function delete_apikey($id)
    {
        $apikey = ApiKey::findOrFail($id);
        if ($apikey) {
            ApiKey::destroy($id);
        }
    }
}
