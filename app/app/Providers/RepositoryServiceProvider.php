<?php

namespace App\Providers;

use App\Interfaces\Central\ApikeyRepositoryInterface;
use App\Interfaces\Central\TenantRepositoryInterface;
use App\Repositories\Central\ApikeyRepository;
use App\Repositories\Central\TenantRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TenantRepositoryInterface::class, TenantRepository::class);
        $this->app->bind(ApikeyRepositoryInterface::class, ApikeyRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
