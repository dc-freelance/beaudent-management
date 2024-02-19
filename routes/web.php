<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorCategoryController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TreatmentBonusController;
use App\Http\Controllers\Admin\TreatmentController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\AddonController;
use App\Http\Controllers\Admin\ItemCategoryController;
use App\Http\Controllers\Admin\ItemUnitController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\DoctorScheduleController;
use App\Http\Controllers\FrontOffice\ReservationsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/', DashboardController::class)->name('admin.dashboard.index');

    // Permission
    Route::group(['prefix' => 'permission', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('admin.permission.index');
        Route::get('get-by-id/{id}', [PermissionController::class, 'getById'])->name('admin.permission.get-by-id');
        Route::get('create', [PermissionController::class, 'create'])->name('admin.permission.create');
        Route::post('store', [PermissionController::class, 'store'])->name('admin.permission.store');
        Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
        Route::put('update/{id}', [PermissionController::class, 'update'])->name('admin.permission.update');
        Route::delete('delete/{id}', [PermissionController::class, 'delete'])->name('admin.permission.delete');
    });

    // Role
    Route::group(['prefix' => 'role', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('get-by-id/{id}', [RoleController::class, 'getById'])->name('admin.role.get-by-id');
        Route::get('create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::post('store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::put('update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::delete('delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
    });

    // User Management
    Route::group(['prefix' => 'user-management', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('admin.user-management.index');
        Route::get('get-by-id/{id}', [UserManagementController::class, 'getById'])->name('admin.user-management.get-by-id');
        Route::get('create', [UserManagementController::class, 'create'])->name('admin.user-management.create');
        Route::post('store', [UserManagementController::class, 'store'])->name('admin.user-management.store');
        Route::get('edit/{id}', [UserManagementController::class, 'edit'])->name('admin.user-management.edit');
        Route::put('update/{id}', [UserManagementController::class, 'update'])->name('admin.user-management.update');
        Route::delete('delete/{id}', [UserManagementController::class, 'delete'])->name('admin.user-management.delete');
        Route::put('update-permission/{id}', [UserManagementController::class, 'updatePermission'])->name('admin.user-management.update-permission');
    });

    // Doctor Category
    Route::group(['prefix' => 'doctor-category'], function () {
        Route::get('/', [DoctorCategoryController::class, 'index'])->name('admin.doctor-category.index');
        Route::get('get-by-id/{id}', [DoctorCategoryController::class, 'getById'])->name('admin.doctor-category.get-by-id');
        Route::get('create', [DoctorCategoryController::class, 'create'])->name('admin.doctor-category.create');
        Route::post('store', [DoctorCategoryController::class, 'store'])->name('admin.doctor-category.store');
        Route::get('edit/{id}', [DoctorCategoryController::class, 'edit'])->name('admin.doctor-category.edit');
        Route::put('update/{id}', [DoctorCategoryController::class, 'update'])->name('admin.doctor-category.update');
        Route::delete('delete/{id}', [DoctorCategoryController::class, 'delete'])->name('admin.doctor-category.delete');
    });

    // Doctor
    Route::group(['prefix' => 'doctor'], function () {
        Route::get('/', [DoctorController::class, 'index'])->name('admin.doctor.index');
        Route::get('get-by-id/{id}', [DoctorController::class, 'getById'])->name('admin.doctor.get-by-id');
        Route::get('create', [DoctorController::class, 'create'])->name('admin.doctor.create');
        Route::post('store', [DoctorController::class, 'store'])->name('admin.doctor.store');
        Route::get('edit/{id}', [DoctorController::class, 'edit'])->name('admin.doctor.edit');
        Route::put('update/{id}', [DoctorController::class, 'update'])->name('admin.doctor.update');
        Route::delete('delete/{id}', [DoctorController::class, 'delete'])->name('admin.doctor.delete');
    });

    // Treatment Bonus
    Route::group(['prefix' => 'treatment-bonus', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [TreatmentBonusController::class, 'index'])->name('admin.treatment-bonus.index');
        Route::get('get-by-id/{id}', [TreatmentBonusController::class, 'getById'])->name('admin.treatment-bonus.get-by-id');
        Route::get('create', [TreatmentBonusController::class, 'create'])->name('admin.treatment-bonus.create');
        Route::post('store', [TreatmentBonusController::class, 'store'])->name('admin.treatment-bonus.store');
        Route::get('edit/{id}', [TreatmentBonusController::class, 'edit'])->name('admin.treatment-bonus.edit');
        Route::put('update/{id}', [TreatmentBonusController::class, 'update'])->name('admin.treatment-bonus.update');
        Route::delete('delete/{id}', [TreatmentBonusController::class, 'delete'])->name('admin.treatment-bonus.delete');
    });

    // Treatment
    Route::group(['prefix' => 'treatment', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [TreatmentController::class, 'index'])->name('admin.treatment.index');
        Route::get('get-by-id/{id}', [TreatmentController::class, 'getById'])->name('admin.treatment.get-by-id');
        Route::get('create', [TreatmentController::class, 'create'])->name('admin.treatment.create');
        Route::post('store', [TreatmentController::class, 'store'])->name('admin.treatment.store');
        Route::get('edit/{id}', [TreatmentController::class, 'edit'])->name('admin.treatment.edit');
        Route::put('update/{id}', [TreatmentController::class, 'update'])->name('admin.treatment.update');
        Route::delete('delete/{id}', [TreatmentController::class, 'delete'])->name('admin.treatment.delete');
    });

    // Branch
    Route::group(['prefix' => 'branch', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [BranchController::class, 'index'])->name('admin.branch.index');
        Route::get('get-by-id/{id}', [BranchController::class, 'getById'])->name('admin.branch.get-by-id');
        Route::get('create', [BranchController::class, 'create'])->name('admin.branch.create');
        Route::post('store', [BranchController::class, 'store'])->name('admin.branch.store');
        Route::get('edit/{id}', [BranchController::class, 'edit'])->name('admin.branch.edit');
        Route::put('update/{id}', [BranchController::class, 'update'])->name('admin.branch.update');
        Route::delete('delete/{id}', [BranchController::class, 'delete'])->name('admin.branch.delete');
    });

    // Customer
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', [CustomerController::class, 'index'])->name('admin.customer.index');
        Route::get('get-by-id/{id}', [CustomerController::class, 'getById'])->name('admin.customer.get-by-id');
        Route::get('create', [CustomerController::class, 'create'])->name('admin.customer.create');
        Route::post('store', [CustomerController::class, 'store'])->name('admin.customer.store');
        Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
        Route::get('detail/{id}', [CustomerController::class, 'detail'])->name('admin.customer.detail');
        Route::put('update/{id}', [CustomerController::class, 'update'])->name('admin.customer.update');
        Route::delete('delete/{id}', [CustomerController::class, 'delete'])->name('admin.customer.delete');
    });

    // Diskon
    Route::group(['prefix' => 'discount', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [DiscountController::class, 'index'])->name('admin.discount.index');
        Route::get('get-by-id/{id}', [DiscountController::class, 'getById'])->name('admin.discount.get-by-id');
        Route::get('create', [DiscountController::class, 'create'])->name('admin.discount.create');
        Route::post('store', [DiscountController::class, 'store'])->name('admin.discount.store');
        Route::get('edit/{id}', [DiscountController::class, 'edit'])->name('admin.discount.edit');
        Route::put('update/{id}', [DiscountController::class, 'update'])->name('admin.discount.update');
        Route::delete('delete/{id}', [DiscountController::class, 'delete'])->name('admin.discount.delete');
    });

    // Addon
    Route::group(['prefix' => 'addon', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [AddonController::class, 'index'])->name('admin.addon.index');
        Route::get('get-by-id/{id}', [AddonController::class, 'getById'])->name('admin.addon.get-by-id');
        Route::get('create', [AddonController::class, 'create'])->name('admin.addon.create');
        Route::post('store', [AddonController::class, 'store'])->name('admin.addon.store');
        Route::get('edit/{id}', [AddonController::class, 'edit'])->name('admin.addon.edit');
        Route::put('update/{id}', [AddonController::class, 'update'])->name('admin.addon.update');
        Route::delete('delete/{id}', [AddonController::class, 'delete'])->name('admin.addon.delete');
    });

    // Item Category
    Route::group(['prefix' => 'item-category', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [ItemCategoryController::class, 'index'])->name('admin.item-category.index');
        Route::get('get-by-id/{id}', [ItemCategoryController::class, 'getById'])->name('admin.item-category.get-by-id');
        Route::get('create', [ItemCategoryController::class, 'create'])->name('admin.item-category.create');
        Route::post('store', [ItemCategoryController::class, 'store'])->name('admin.item-category.store');
        Route::get('edit/{id}', [ItemCategoryController::class, 'edit'])->name('admin.item-category.edit');
        Route::put('update/{id}', [ItemCategoryController::class, 'update'])->name('admin.item-category.update');
        Route::delete('delete/{id}', [ItemCategoryController::class, 'delete'])->name('admin.item-category.delete');
    });

    // Item Unit
    Route::group(['prefix' => 'item-unit', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [ItemUnitController::class, 'index'])->name('admin.item-unit.index');
        Route::get('get-by-id/{id}', [ItemUnitController::class, 'getById'])->name('admin.item-unit.get-by-id');
        Route::get('create', [ItemUnitController::class, 'create'])->name('admin.item-unit.create');
        Route::post('store', [ItemUnitController::class, 'store'])->name('admin.item-unit.store');
        Route::get('edit/{id}', [ItemUnitController::class, 'edit'])->name('admin.item-unit.edit');
        Route::put('update/{id}', [ItemUnitController::class, 'update'])->name('admin.item-unit.update');
        Route::delete('delete/{id}', [ItemUnitController::class, 'delete'])->name('admin.item-unit.delete');
    });

    // Supplier
    Route::group(['prefix' => 'supplier', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [SupplierController::class, 'index'])->name('admin.supplier.index');
        Route::get('get-by-id/{id}', [SupplierController::class, 'getById'])->name('admin.supplier.get-by-id');
        Route::get('create', [SupplierController::class, 'create'])->name('admin.supplier.create');
        Route::post('store', [SupplierController::class, 'store'])->name('admin.supplier.store');
        Route::get('edit/{id}', [SupplierController::class, 'edit'])->name('admin.supplier.edit');
        Route::put('update/{id}', [SupplierController::class, 'update'])->name('admin.supplier.update');
        Route::delete('delete/{id}', [SupplierController::class, 'delete'])->name('admin.supplier.delete');
    });

    // Item
    Route::group(['prefix' => 'item', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [ItemController::class, 'index'])->name('admin.item.index');
        Route::get('get-by-id/{id}', [ItemController::class, 'getById'])->name('admin.item.get-by-id');
        Route::get('create', [ItemController::class, 'create'])->name('admin.item.create');
        Route::post('store', [ItemController::class, 'store'])->name('admin.item.store');
        Route::get('edit/{id}', [ItemController::class, 'edit'])->name('admin.item.edit');
        Route::put('update/{id}', [ItemController::class, 'update'])->name('admin.item.update');
        Route::delete('delete/{id}', [ItemController::class, 'delete'])->name('admin.item.delete');
    });

    // DoctorSchedule
    Route::group(['prefix' => 'doctor-schedule', 'middleware' => ['role:admin_pusat']], function () {
        Route::get('/', [DoctorScheduleController::class, 'index'])->name('admin.doctor-schedule.index');
        Route::get('get-by-id/{id}', [DoctorScheduleController::class, 'getById'])->name('admin.doctor-schedule.get-by-id');
        Route::get('create', [DoctorScheduleController::class, 'create'])->name('admin.doctor-schedule.create');
        Route::post('store', [DoctorScheduleController::class, 'store'])->name('admin.doctor-schedule.store');
        Route::get('edit/{id}', [DoctorScheduleController::class, 'edit'])->name('admin.doctor-schedule.edit');
        Route::put('update/{id}', [DoctorScheduleController::class, 'update'])->name('admin.doctor-schedule.update');
        Route::delete('delete/{id}', [DoctorScheduleController::class, 'delete'])->name('admin.doctor-schedule.delete');
    });

    // Reservations
    Route::group(['prefix' => 'reservations', 'middleware' => ['role:frontoffice']], function () {
        Route::group(['prefix' => 'wait'], function () {
            Route::get('/', [ReservationsController::class, 'reservations'])->name('front-office.reservations.wait.index');
            Route::get('detail/{id}', [ReservationsController::class, 'detail'])->name('front-office.reservations.wait.detail');
        });

        Route::group(['prefix' => 'confirm'], function () {
            Route::get('/', [ReservationsController::class, 'confirm_reservations'])->name('front-office.reservations.confirm.index');
            Route::get('detail/{id}', [ReservationsController::class, 'detail'])->name('front-office.reservations.confirm.detail');
            Route::put('reschedule/update/{id}', [ReservationsController::class, 'update'])->name('front-office.reservations.confirm.reschedule.update');
            Route::get('reschedule/{id}', [ReservationsController::class, 'reschedule'])->name('front-office.reservations.confirm.reschedule');
        });

        Route::group(['prefix' => 'cancel'], function () {
            Route::get('/', [ReservationsController::class, 'cancel_reservations'])->name('front-office.reservations.cancel.index');
            Route::get('detail/{id}', [ReservationsController::class, 'detail'])->name('front-office.reservations.cancel.detail');
        });

        Route::get('/reservations/{id}/confirm', [ReservationsController::class, 'confirm'])->name('front-office.reservations.detail.confirm');
        Route::get('/reservations/{id}/cancel', [ReservationsController::class, 'cancel'])->name('front-office.reservations.detail.cancel');
        Route::delete('delete/{id}', [ReservationsController::class, 'delete'])->name('front-office.reservations.delete');
    });
});

Route::get('/', function () {
    return view('auth.login');
});

require __DIR__ . '/auth.php';