<?php


use App\Jobs\YouscribeCategoryProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    YouscribeCategoryProduct::dispatch();
    return view('welcome');
});


Route::view('/docs', 'scribe-docs.index')->name('scribe-docs');
Route::get('/docs/docs.postman', function () {
    return new JsonResponse(Storage::disk('local')->get('scribe-scribe/collection.json'), json: true);
})->name('scribe-docs.postman');
Route::get('/docs/docs.openapi', function () {
    return response()->file(Storage::disk('local')->path('scribe-docs/openapi.yaml'));
})->name('scribe-master.openapi');
