<?php

use App\Http\Controllers\Central\Api\ApikeyController;
use App\Http\Controllers\Central\Api\Auth\LoginController;
use App\Http\Controllers\Central\Api\Auth\RegisterController;
use App\Http\Controllers\Central\Api\PingController;
use App\Http\Controllers\Central\Api\ProfileController;
use App\Http\Controllers\Central\Api\SectionController;
use App\Http\Controllers\Central\Api\TenantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/** Authentication Routes @s*/
Route::prefix("/auth/v1/")->group(function () {
    Route::post("register", [RegisterController::class, "register"]);
    Route::post("login", [LoginController::class, "login"])->name('login')->middleware(['throttle:3,1']);
    Route::group([
        "middleware" => ["auth:api"]
    ], function () {
        Route::post("refresh", [LoginController::class, "refresh"]);
        Route::post("logout", [LoginController::class, "logout"]);

        Route::get("profile", [ProfileController::class, "show"]);
        Route::patch("profile", [ProfileController::class, "update"]);
    });
});
/** Authentication Routes @e*/


Route::group([
    'middleware' => ['auth:api'],
], function () {
    Route::get('/ping', [PingController::class, 'pingApi']);

    Route::prefix("/manage/v1/")->group(function () {
        Route::prefix('tenant')->group(function () {
            Route::get('/', [TenantController::class, 'list_tenant']);
            Route::post('/', [TenantController::class, 'store_tenant']);
            Route::get('/{tenant_id}', [TenantController::class, 'show_tenant']);
            Route::put('/{tenant_id}', [TenantController::class, 'update_tenant']);
            Route::delete('/{tenant_id}', [TenantController::class, 'delete_tenant']);

        });
        Route::prefix('apikey')->group(function () {
            Route::get('/', [ApikeyController::class, 'list_apikey']);
            Route::post('/', [ApikeyController::class, 'store_apikey']);
            Route::get('/{apikey_id}', [ApikeyController::class, 'show_apikey']);
            Route::delete('/{apikey_id}', [ApikeyController::class, 'delete_apikey']);
        });
        Route::prefix('section')->group(function () {
            Route::get('/', [SectionController::class, 'list_section']);
            Route::post('/', [SectionController::class, 'store_section']);
            Route::get('/{section_id}', [SectionController::class, 'show_section']);
            Route::put('/{section_id}', [SectionController::class, 'update_section']);
            Route::delete('/{section_id}', [SectionController::class, 'delete_section']);
        });
    });

});
