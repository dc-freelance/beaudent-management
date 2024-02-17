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
        $this->app->bind(\App\Interfaces\DoctorCategoryInterface::class, \App\Repositories\DoctorCategoryRepository::class);
        $this->app->bind(\App\Interfaces\DoctorInterface::class, \App\Repositories\DoctorRepository::class);
        $this->app->bind(\App\Interfaces\TreatmentInterface::class, \App\Repositories\TreatmentRepository::class);
        $this->app->bind(\App\Interfaces\CustomerInterface::class, \App\Repositories\CustomerRepository::class);
        $this->app->bind(\App\Interfaces\TreatmentBonusInterface::class, \App\Repositories\TreatmentBonusRepository::class);
        $this->app->bind(\App\Interfaces\DiscountInterface::class, \App\Repositories\DiscountRepository::class);
        $this->app->bind(\App\Interfaces\AddonInterface::class, \App\Repositories\AddonRepository::class);

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