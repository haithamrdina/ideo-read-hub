<?php

use App\Models\ApiKey;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

Route::group([
    'prefix' => '/api/{tenant}',
    'middleware' => [InitializeTenancyByPath::class],
], function () {
    Route::get('/', function () {
        dd(ApiKey::all());
        return 'This is your multi-tenant application  api routes. The id of the current tenant is ' . tenant('id');
    });
});
