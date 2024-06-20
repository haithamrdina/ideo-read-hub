<?php

namespace App\Http\Controllers\Central\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Api\Apikey\StoreApikeyRequest;
use App\Http\Resources\Central\Api\Apikey\ApikeyResource;
use App\Http\Resources\Central\Api\Tenant\ShortTenantResource;
use App\Http\Resources\Central\Api\Tenant\TenantResource;
use App\Interfaces\Central\ApikeyRepositoryInterface;
use App\Models\Tenant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Subgroup;
use Knuckles\Scribe\Attributes\UrlParam;

#[Group("4-API Tokens Service", "APIs for managing tenants apikeys")]
class ApikeyController extends Controller
{
    private ApikeyRepositoryInterface $apikeyRepositoryInterface;

    public function __construct(ApikeyRepositoryInterface $apikeyRepositoryInterface)
    {
        $this->apikeyRepositoryInterface = $apikeyRepositoryInterface;
    }

    /**
     * Return list of Api-keys
     */
    #[Authenticated]

    #[QueryParam("tenant_id", "integer", "the id of tenant from which start listing api-keys", required: false, example: "No-example")]
    #[QueryParam("page", "integer", "Page to return, default 1", required: false, example: "No-example")]
    #[QueryParam("page_size", "integer", "Maximum number of results per page, default 50", required: false, example: "No-example")]

    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function list_apikey(Request $request)
    {
        $page = request('page', 1);
        $pageSize = request('page_size');
        $pageSize = (request('page_size', 15) != "0") ? request('page_size', 15) : 15;
        $pageSize = min($pageSize, 200);
        $params = [
            'tenant_id' => request('tenant_id'),
            'page' => $page,
            'page_size' => $pageSize
        ];
        $data = $this->apikeyRepositoryInterface->list_apikey($params);
        return ApiResponseClass::sendResponseCollection(
            $data->toArray(request())['items'],
            JsonResponse::HTTP_OK,
            "Apikey list",
            $data->toArray(request())['meta'],
            null,
            $params['tenant_id'] != null ? new ShortTenantResource(Tenant::findOrFail($params['tenant_id'])) : null,
            $data->toArray(request())['_links']
        );
    }

    /**
     * Get details of a selected api-key
     */
    #[Authenticated]
    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function show_apikey($apikey_id)
    {
        $apikey = $this->apikeyRepositoryInterface->get_apikey_by_id($apikey_id);
        return ApiResponseClass::sendResponse(new ApikeyResource($apikey), JsonResponse::HTTP_OK, 'ApiKey detail');
    }

    /**
     * Create new api-key for the specified tenant
     */
    #[Authenticated]
    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function store_apikey(StoreApikeyRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $apikey = $this->apikeyRepositoryInterface->store_apikey($data);
            DB::commit();
            return ApiResponseClass::sendResponse(new ApikeyResource($apikey), JsonResponse::HTTP_CREATED, 'Apikey created Successfully');

        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Deletes Api-key
     */
    #[Authenticated]
    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function delete_apikey($apikey_id)
    {
        $this->apikeyRepositoryInterface->delete_apikey($apikey_id);
        return ApiResponseClass::sendResponse(['deleted_apikey_id' => $apikey_id], JsonResponse::HTTP_OK, 'Apikey deleted successfully');
    }
}
