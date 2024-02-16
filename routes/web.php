<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorCategoryController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TreatmentBonusController;
use App\Http\Controllers\Admin\TreatmentController;
use App\Http\Controllers\Admin\UserManagementController;
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
});

Route::get('/', function () {
    return view('auth.login');
});

require __DIR__ . '/auth.php';
