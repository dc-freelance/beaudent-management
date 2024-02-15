<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/', DashboardController::class)->name('admin.dashboard.index');

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
});

Route::get('/', function () {
    return view('auth.login');
});

require __DIR__ . '/auth.php';
