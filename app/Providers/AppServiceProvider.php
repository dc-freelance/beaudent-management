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
        $this->app->bind(\App\Interfaces\BranchInterface::class, \App\Repositories\BranchRepository::class);

        $this->loadHelpers();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    protected function loadHelpers(): void
    {
        foreach (glob(__DIR__ . '/../Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
