<?php

namespace App\Providers;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\ServiceProvider;
use Google\Service\Drive as ServiceDrive;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use Masbug\Flysystem\GoogleDriveAdapter;

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
        $this->app->bind(\App\Interfaces\DashboardInterface::class, \App\Repositories\DashboardRepository::class);
        $this->app->bind(\App\Interfaces\DoctorCategoryInterface::class, \App\Repositories\DoctorCategoryRepository::class);
        $this->app->bind(\App\Interfaces\DoctorInterface::class, \App\Repositories\DoctorRepository::class);
        $this->app->bind(\App\Interfaces\TreatmentInterface::class, \App\Repositories\TreatmentRepository::class);
        $this->app->bind(\App\Interfaces\CustomerInterface::class, \App\Repositories\CustomerRepository::class);
        $this->app->bind(\App\Interfaces\TreatmentBonusInterface::class, \App\Repositories\TreatmentBonusRepository::class);
        $this->app->bind(\App\Interfaces\DiscountInterface::class, \App\Repositories\DiscountRepository::class);
        $this->app->bind(\App\Interfaces\AddonInterface::class, \App\Repositories\AddonRepository::class);
        $this->app->bind(\App\Interfaces\ItemCategoryInterface::class, \App\Repositories\ItemCategoryRepository::class);
        $this->app->bind(\App\Interfaces\ItemUnitInterface::class, \App\Repositories\ItemUnitRepository::class);
        $this->app->bind(\App\Interfaces\SupplierInterface::class, \App\Repositories\SupplierRepository::class);
        $this->app->bind(\App\Interfaces\ItemUnitInterface::class, \App\Repositories\ItemUnitRepository::class);
        $this->app->bind(\App\Interfaces\ItemInterface::class, \App\Repositories\ItemRepository::class);
        $this->app->bind(\App\Interfaces\DoctorScheduleInterface::class, \App\Repositories\DoctorScheduleRepository::class);
        $this->app->bind(\App\Interfaces\ConfigShiftInterface::class, \App\Repositories\ConfigShiftRepository::class);
        $this->app->bind(\App\Interfaces\ReservationsInterface::class, \App\Repositories\ReservationsRepository::class);
        $this->app->bind(\App\Interfaces\ShiftLogInterface::class, \App\Repositories\ShiftLogRepository::class);
        $this->app->bind(\App\Interfaces\PaymentMethodsInterface::class, \App\Repositories\PaymentMethodsRepository::class);
        $this->app->bind(\App\Interfaces\TreatmentCategoriesInterface::class, \App\Repositories\TreatmentCategoriesRepository::class);
        $this->app->bind(\App\Interfaces\TransactionInterface::class, \App\Repositories\TransactionRepository::class);
        $this->app->bind(\App\Interfaces\DiscountItemInterface::class, \App\Repositories\DiscountItemRepository::class);
        $this->app->bind(\App\Interfaces\DiscountTreatmentInterface::class, \App\Repositories\DiscountTreatmentRepository::class);
        $this->app->bind(\App\Interfaces\IncomeReportInterface::class, \App\Repositories\IncomeReportRepository::class);
        $this->app->bind(\App\Interfaces\TreatmentReportInterface::class, \App\Repositories\TreatmentReportRepository::class);
        $this->app->bind(\App\Interfaces\PatientVisitReportInterface::class, \App\Repositories\PatientVisitReportRepository::class);
        $this->app->bind(\App\Interfaces\ShiftReportInterface::class, \App\Repositories\ShiftReportRepository::class);
        $this->app->bind(\App\Interfaces\ExaminationInterface::class, \App\Repositories\ExaminationRepository::class);
        $this->app->bind(\App\Interfaces\OdontogramInterface::class, \App\Repositories\OdontogramRepository::class);
        $this->app->bind(\App\Interfaces\OdontogramResultInterface::class, \App\Repositories\OdontogramResultRepository::class);
        $this->app->bind(\App\Interfaces\MedicalRecordInterface::class, \App\Repositories\MedicalRecordRepository::class);


        $this->loadHelpers();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        $this->loadGoogleStorageDriver();
    }

    protected function loadHelpers(): void
    {
        foreach (glob(__DIR__ . '/../Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    // backup gdrive
    private function loadGoogleStorageDriver(string $driverName = 'google') {
        try {
            Storage::extend($driverName, function($app, $config) {
                $options = [];

                if (!empty($config['teamDriveId'] ?? null)) {
                    $options['teamDriveId'] = $config['teamDriveId'];
                }

                $client = new \Google\Client();
                $client->setClientId($config['clientId']);
                $client->setClientSecret($config['clientSecret']);
                $client->refreshToken($config['refreshToken']);

                $service = new ServiceDrive($client);
                $adapter = new GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
                $driver = new Filesystem($adapter);

                return new FilesystemAdapter($driver, $adapter);
            });
        } catch(Exception $e) {
            return $e;
            // your exception handling logic
        }
    }
}
