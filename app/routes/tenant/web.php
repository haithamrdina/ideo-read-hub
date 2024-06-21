<?php

use App\Classes\ApiResponseClass;
use App\Http\Integrations\Docebo\DoceboConnector;
use App\Http\Integrations\Docebo\Requests\DoceboGetUserInfos;
use App\Http\Resources\Central\Api\Section\SectionCollection;
use App\Models\Catalogue;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

Route::group([
    'prefix' => '/{tenant}',
    'middleware' => [InitializeTenancyByPath::class],
], function () {
    Route::get('/', function () {
        $paginatedSections = Section::with('products')->paginate(15);
        $sectionCollection = new SectionCollection($paginatedSections);
        $sectionCollection->setPaginator($paginatedSections);
        return ApiResponseClass::sendResponseCollection(
            $sectionCollection->toArray(request())['items'],
            JsonResponse::HTTP_OK,
            "Section list",
            $sectionCollection->toArray(request())['meta'],
            null,
            null,
            $sectionCollection->toArray(request())['_links']
        );
        return 'This is your multi-tenant application  web routes. The id of the current tenant is ' . tenant('id');
    });
});
