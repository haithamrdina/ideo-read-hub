<?php

namespace App\Http\Controllers\Central\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Api\Section\StoreSectionRequest;
use App\Http\Requests\Central\Api\Section\UpdateSectionRequest;
use App\Http\Resources\Central\Api\Section\SectionResource;
use App\Http\Resources\Central\Api\Tenant\ShortTenantResource;
use App\Interfaces\Central\SectionRepositoryInterface;
use App\Models\Tenant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Subgroup;
use Knuckles\Scribe\Attributes\UrlParam;

#[Group("5-Section Service", "APIs for managing sections")]
class SectionController extends Controller
{
    private SectionRepositoryInterface $sectionRepositoryInterface;

    public function __construct(SectionRepositoryInterface $sectionRepositoryInterface)
    {
        $this->sectionRepositoryInterface = $sectionRepositoryInterface;
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
    public function list_section(Request $request)
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
        $data = $this->sectionRepositoryInterface->list_section($params);
        return ApiResponseClass::sendResponseCollection(
            $data->toArray(request())['items'],
            JsonResponse::HTTP_OK,
            "Section list",
            $data->toArray(request())['meta'],
            null,
            $params['tenant_id'] != null ? new ShortTenantResource(Tenant::findOrFail($params['tenant_id'])) : null,
            $data->toArray(request())['_links']
        );
    }

    /**
     * Get details of a selected section
     */
    #[Authenticated]
    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function show_section($section_id)
    {
        $section = $this->sectionRepositoryInterface->get_section_by_id($section_id);
        return ApiResponseClass::sendResponse(new SectionResource($section), JsonResponse::HTTP_OK, 'Section detail');
    }

    /**
     * Create new section for the specified tenant
     */
    #[Authenticated]
    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function store_section(StoreSectionRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $section = $this->sectionRepositoryInterface->store_section($data);
            DB::commit();
            return ApiResponseClass::sendResponse(new SectionResource($section), JsonResponse::HTTP_CREATED, 'Section created Successfully');

        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Updated selected Section
     */
    #[Authenticated]
    #[UrlParam("section_id", "string", "The Id of section")]
    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function update_section(UpdateSectionRequest $request, $section_id)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $section = $this->sectionRepositoryInterface->update_section($data, $section_id);
            DB::commit();
            return ApiResponseClass::sendResponse(new SectionResource($section), JsonResponse::HTTP_CREATED, 'Section updated Successfully');

        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Deletes section
     */
    #[Authenticated]
    //#[ResponseFromFile(description: "Operation successful", status: 200, file: "")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Your request was made with invalid credentials.", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function delete_section($section_id)
    {
        $this->sectionRepositoryInterface->delete_section($section_id);
        return ApiResponseClass::sendResponse(['deleted_section_id' => $section_id], JsonResponse::HTTP_OK, 'Section deleted successfully');
    }
}
