<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\UserManagementInterface::class, \App\Repositories\UserManagementRepository::class);
        $this->app->bind(\App\Interfaces\PermissionInterface::class, \App\Repositories\PermissionRepository::class);
        $this->app->bind(\App\Interfaces\RoleInterface::class, \App\Repositories\RoleRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
