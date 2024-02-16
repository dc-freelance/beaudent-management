<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorCategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/', DashboardController::class)->name('admin.dashboard.index');

    // Permission
    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('admin.permission.index');
        Route::get('get-by-id/{id}', [PermissionController::class, 'getById'])->name('admin.permission.get-by-id');
        Route::get('create', [PermissionController::class, 'create'])->name('admin.permission.create');
        Route::post('store', [PermissionController::class, 'store'])->name('admin.permission.store');
        Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
        Route::put('update/{id}', [PermissionController::class, 'update'])->name('admin.permission.update');
        Route::delete('delete/{id}', [PermissionController::class, 'delete'])->name('admin.permission.delete');
    });

    // Role
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('get-by-id/{id}', [RoleController::class, 'getById'])->name('admin.role.get-by-id');
        Route::get('create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::post('store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::put('update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::delete('delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
    });

    // User Management
    Route::group(['prefix' => 'user-management'], function () {
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
});

Route::get('/', function () {
    return view('auth.login');
});

require __DIR__ . '/auth.php';
