<?php

namespace App\Http\Controllers\Central\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Api\Tenant\StoreTenantRequest;
use App\Http\Requests\Central\Api\Tenant\UpdateTenantRequest;
use App\Http\Resources\Central\Api\Tenant\TenantResource;
use App\Interfaces\Central\TenantRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\UrlParam;


#[Group("3-Tenant Service", "APIs for managing tenants")]
class TenantController extends Controller
{
    private TenantRepositoryInterface $tenantRepositoryInterface;

    public function __construct(TenantRepositoryInterface $tenantRepositoryInterface)
    {
        $this->tenantRepositoryInterface = $tenantRepositoryInterface;
    }

    /**
     * Retrieves the list of tenants
     */
    #[Authenticated]
    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function list_tenant()
    {
        $data = $this->tenantRepositoryInterface->list_tenant();
        return ApiResponseClass::sendResponseCollection(
            $data->toArray(request())['items'],
            JsonResponse::HTTP_OK,
            "Tenant list",
            $data->toArray(request())['meta'],
            null,
            null,
            $data->toArray(request())['_links']
        );
    }

    /**
     * Create new tenant
     */
    #[Authenticated]
    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function store_tenant(StoreTenantRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $tenant = $this->tenantRepositoryInterface->store_tenant($data);
            DB::commit();
            return ApiResponseClass::sendResponse(new TenantResource($tenant), JsonResponse::HTTP_CREATED, 'Tenant created Successfully');

        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }

    }

    /**
     * Get details of a selected tenant
     */
    #[Authenticated]
    #[UrlParam("tenant_id", "string", "Internal tenant ID")]
    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function show_tenant($tenant_id)
    {
        $tenant = $this->tenantRepositoryInterface->get_tenant_by_id($tenant_id);
        return ApiResponseClass::sendResponse(new TenantResource($tenant), JsonResponse::HTTP_OK, 'Tenant detail');
    }

    /**
     * Update selected tenant
     */
    #[Authenticated]
    #[UrlParam("tenant_id", "string", "Internal tenant ID")]
    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function update_tenant(UpdateTenantRequest $request, $tenant_id)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $tenant = $this->tenantRepositoryInterface->update_tenant($data, $tenant_id);
            DB::commit();
            return ApiResponseClass::sendResponse(new TenantResource($tenant), JsonResponse::HTTP_CREATED, 'Tenant updated Successfully');
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Delete selected tenant
     */
    #[Authenticated]
    #[UrlParam("tenant_id", "string", "Internal tenant ID")]
    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function delete_tenant($tenant_id)
    {

    }


}
