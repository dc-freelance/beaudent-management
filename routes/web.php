<?php

use App\Events\NotifUpdated;
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
use App\Http\Controllers\Admin\ConfigShiftController;
use App\Http\Controllers\Admin\ItemCategoryController;
use App\Http\Controllers\Admin\ItemUnitController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\DoctorScheduleController;
use App\Http\Controllers\Admin\PaymentMethodsController;
use App\Http\Controllers\Admin\TreatmentCategoriesController;
use App\Http\Controllers\FrontOffice\ReservationsController;
use App\Http\Controllers\FrontOffice\ShiftLogController;
use App\Http\Controllers\FrontOffice\TransactionController;
use App\Http\Controllers\Admin\DiscountItemController;
use App\Http\Controllers\Admin\DiscountTreatmentController;
use App\Http\Controllers\Admin\ExaminationHistoryController;
use App\Http\Controllers\Admin\IncomeReportController;
use App\Http\Controllers\Admin\TreatmentReportController;
use App\Http\Controllers\Admin\PatientVisitReportController;
use App\Http\Controllers\API\GetKategoriController;
use App\Http\Controllers\ShiftReportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::get('get-chart/{branch}/{year}', [DashboardController::class, 'chart'])->name('admin.dashboard.chart');

    // Permission
    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', [PermissionController::class, 'index'])->middleware('permission:read_permission')->name('admin.permission.index');
        Route::get('get-by-id/{id}', [PermissionController::class, 'getById'])->name('admin.permission.get-by-id');
        Route::get('create', [PermissionController::class, 'create'])->middleware('permission:create_permission')->name('admin.permission.create');
        Route::post('store', [PermissionController::class, 'store'])->middleware('permission:create_permission')->name('admin.permission.store');
        Route::get('edit/{id}', [PermissionController::class, 'edit'])->middleware('permission:update_permission')->name('admin.permission.edit');
        Route::put('update/{id}', [PermissionController::class, 'update'])->middleware('permission:update_permission')->name('admin.permission.update');
        Route::delete('delete/{id}', [PermissionController::class, 'delete'])->middleware('permission:delete_permission')->name('admin.permission.delete');
    });

    // Role
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->middleware('permission:read_role')->name('admin.role.index');
        Route::get('get-by-place/{place}', [RoleController::class, 'getWhich'])->middleware('permission:read_role')->name('admin.role.get-by-place');
        Route::get('get-by-id/{id}', [RoleController::class, 'getById'])->name('admin.role.get-by-id');
        Route::get('create', [RoleController::class, 'create'])->middleware('permission:create_role')->name('admin.role.create');
        Route::post('store', [RoleController::class, 'store'])->middleware('permission:create_role')->name('admin.role.store');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->middleware('permission:update_role')->name('admin.role.edit');
        Route::put('update/{id}', [RoleController::class, 'update'])->middleware('permission:update_role')->name('admin.role.update');
        Route::delete('delete/{id}', [RoleController::class, 'delete'])->middleware('permission:delete_role')->name('admin.role.delete');
    });

    // User Management
    Route::group(['prefix' => 'user-management'], function () {
        Route::get('/', [UserManagementController::class, 'index'])->middleware('permission:read_user')->name('admin.user-management.index');
        Route::get('get-by-id/{id}', [UserManagementController::class, 'getById'])->name('admin.user-management.get-by-id');
        Route::get('create', [UserManagementController::class, 'create'])->middleware('permission:create_user')->name('admin.user-management.create');
        Route::post('store', [UserManagementController::class, 'store'])->middleware('permission:create_user')->name('admin.user-management.store');
        Route::get('edit/{id}', [UserManagementController::class, 'edit'])->middleware('permission:update_user')->name('admin.user-management.edit');
        Route::put('update/{id}', [UserManagementController::class, 'update'])->middleware('permission:update_user')->name('admin.user-management.update');
        Route::delete('delete/{id}', [UserManagementController::class, 'delete'])->middleware('permission:delete_user')->name('admin.user-management.delete');
        Route::put('update-permission/{id}', [UserManagementController::class, 'updatePermission'])->name('admin.user-management.update-permission');
    });

    // Doctor Category
    Route::group(['prefix' => 'doctor-category'], function () {
        Route::get('/', [DoctorCategoryController::class, 'index'])->middleware('permission:read_doctor_category')->name('admin.doctor-category.index');
        Route::get('get-by-id/{id}', [DoctorCategoryController::class, 'getById'])->name('admin.doctor-category.get-by-id');
        Route::get('create', [DoctorCategoryController::class, 'create'])->middleware('permission:create_doctor_category')->name('admin.doctor-category.create');
        Route::post('store', [DoctorCategoryController::class, 'store'])->middleware('permission:create_doctor_category')->name('admin.doctor-category.store');
        Route::get('edit/{id}', [DoctorCategoryController::class, 'edit'])->middleware('permission:update_doctor_category')->name('admin.doctor-category.edit');
        Route::put('update/{id}', [DoctorCategoryController::class, 'update'])->middleware('permission:update_doctor_category')->name('admin.doctor-category.update');
        Route::delete('delete/{id}', [DoctorCategoryController::class, 'delete'])->middleware('permission:delete_doctor_category')->name('admin.doctor-category.delete');
    });

    // Doctor
    Route::group(['prefix' => 'doctor'], function () {
        Route::get('/', [DoctorController::class, 'index'])->middleware('permission:read_doctor')->name('admin.doctor.index');
        Route::get('get-by-id/{id}', [DoctorController::class, 'getById'])->name('admin.doctor.get-by-id');
        Route::get('create', [DoctorController::class, 'create'])->middleware('permission:create_doctor')->name('admin.doctor.create');
        Route::post('store', [DoctorController::class, 'store'])->middleware('permission:create_doctor')->name('admin.doctor.store');
        Route::get('edit/{id}', [DoctorController::class, 'edit'])->middleware('permission:update_doctor')->name('admin.doctor.edit');
        Route::put('update/{id}', [DoctorController::class, 'update'])->middleware('permission:update_doctor')->name('admin.doctor.update');
        Route::delete('delete/{id}', [DoctorController::class, 'delete'])->middleware('permission:delete_doctor')->name('admin.doctor.delete');
    });

    // Treatment Bonus
    Route::group(['prefix' => 'treatment-bonus'], function () {
        Route::get('/', [TreatmentBonusController::class, 'index'])->middleware('permission:read_treatment_bonus')->name('admin.treatment-bonus.index');
        Route::get('get-by-id/{id}', [TreatmentBonusController::class, 'getById'])->name('admin.treatment-bonus.get-by-id');
        Route::get('create', [TreatmentBonusController::class, 'create'])->middleware('permission:create_treatment_bonus')->name('admin.treatment-bonus.create');
        Route::post('store', [TreatmentBonusController::class, 'store'])->middleware('permission:create_treatment_bonus')->name('admin.treatment-bonus.store');
        Route::get('edit/{id}', [TreatmentBonusController::class, 'edit'])->middleware('permission:update_treatment_bonus')->name('admin.treatment-bonus.edit');
        Route::put('update/{id}', [TreatmentBonusController::class, 'update'])->middleware('permission:update_treatment_bonus')->name('admin.treatment-bonus.update');
        Route::delete('delete/{id}', [TreatmentBonusController::class, 'delete'])->middleware('permission:delete_treatment_bonus')->name('admin.treatment-bonus.delete');
    });

    // Treatment
    Route::group(['prefix' => 'treatment'], function () {
        Route::get('/', [TreatmentController::class, 'index'])->middleware('permission:read_treatment')->name('admin.treatment.index');
        Route::get('get-by-id/{id}', [TreatmentController::class, 'getById'])->name('admin.treatment.get-by-id');
        Route::get('create', [TreatmentController::class, 'create'])->middleware('permission:create_treatment')->name('admin.treatment.create');
        Route::post('store', [TreatmentController::class, 'store'])->middleware('permission:create_treatment')->name('admin.treatment.store');
        Route::get('edit/{id}', [TreatmentController::class, 'edit'])->middleware('permission:update_treatment')->name('admin.treatment.edit');
        Route::put('update/{id}', [TreatmentController::class, 'update'])->middleware('permission:update_treatment')->name('admin.treatment.update');
        Route::delete('delete/{id}', [TreatmentController::class, 'delete'])->middleware('permission:delete_treatment')->name('admin.treatment.delete');
    });

    // Branch
    Route::group(['prefix' => 'branch'], function () {
        Route::get('/', [BranchController::class, 'index'])->middleware('permission:read_branch')->name('admin.branch.index');
        Route::get('get-by-id/{id}', [BranchController::class, 'getById'])->name('admin.branch.get-by-id');
        Route::get('create', [BranchController::class, 'create'])->middleware('permission:create_branch')->name('admin.branch.create');
        Route::post('store', [BranchController::class, 'store'])->middleware('permission:create_branch')->name('admin.branch.store');
        Route::get('edit/{id}', [BranchController::class, 'edit'])->middleware('permission:update_branch')->name('admin.branch.edit');
        Route::put('update/{id}', [BranchController::class, 'update'])->middleware('permission:update_branch')->name('admin.branch.update');
        Route::delete('delete/{id}', [BranchController::class, 'delete'])->middleware('permission:delete_branch')->name('admin.branch.delete');
    });

    // Customer
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', [CustomerController::class, 'index'])->middleware('permission:read_customer')->name('admin.customer.index');
        Route::get('get-by-id/{id}', [CustomerController::class, 'getById'])->name('admin.customer.get-by-id');
        Route::get('create', [CustomerController::class, 'create'])->middleware('permission:create_customer')->name('admin.customer.create');
        Route::post('store', [CustomerController::class, 'store'])->middleware('permission:create_customer')->name('admin.customer.store');
        Route::get('edit/{id}', [CustomerController::class, 'edit'])->middleware('permission:update_customer')->name('admin.customer.edit');
        Route::get('detail/{id}', [CustomerController::class, 'detail'])->middleware('permission:detail_customer')->name('admin.customer.detail');
        Route::put('update/{id}', [CustomerController::class, 'update'])->middleware('permission:update_customer')->name('admin.customer.update');
        Route::delete('delete/{id}', [CustomerController::class, 'delete'])->middleware('permission:delete_customer')->name('admin.customer.delete');
    });

    // Diskon
    Route::group(['prefix' => 'discount'], function () {
        Route::get('/', [DiscountController::class, 'index'])->middleware('permission:read_discount')->name('admin.discount.index');
        Route::get('get-by-id/{id}', [DiscountController::class, 'getById'])->name('admin.discount.get-by-id');
        Route::get('create', [DiscountController::class, 'create'])->middleware('permission:create_discount')->name('admin.discount.create');
        Route::post('store', [DiscountController::class, 'store'])->middleware('permission:create_discount')->name('admin.discount.store');
        Route::get('edit/{id}', [DiscountController::class, 'edit'])->middleware('permission:update_discount')->name('admin.discount.edit');
        Route::put('update/{id}', [DiscountController::class, 'update'])->middleware('permission:update_discount')->name('admin.discount.update');
        Route::delete('delete/{id}', [DiscountController::class, 'delete'])->middleware('permission:delete_discount')->name('admin.discount.delete');
    });

    // Addon
    Route::group(['prefix' => 'addon'], function () {
        Route::get('/', [AddonController::class, 'index'])->middleware('permission:read_addon')->name('admin.addon.index');
        Route::get('get-by-id/{id}', [AddonController::class, 'getById'])->name('admin.addon.get-by-id');
        Route::get('create', [AddonController::class, 'create'])->middleware('permission:create_addon')->name('admin.addon.create');
        Route::post('store', [AddonController::class, 'store'])->middleware('permission:create_addon')->name('admin.addon.store');
        Route::get('edit/{id}', [AddonController::class, 'edit'])->middleware('permission:update_addon')->name('admin.addon.edit');
        Route::put('update/{id}', [AddonController::class, 'update'])->middleware('permission:update_addon')->name('admin.addon.update');
        Route::delete('delete/{id}', [AddonController::class, 'delete'])->middleware('permission:delete_addon')->name('admin.addon.delete');
    });

    // Item Category
    Route::group(['prefix' => 'item-category'], function () {
        Route::get('/', [ItemCategoryController::class, 'index'])->middleware('permission:read_item_category')->name('admin.item-category.index');
        Route::get('get-by-id/{id}', [ItemCategoryController::class, 'getById'])->name('admin.item-category.get-by-id');
        Route::get('create', [ItemCategoryController::class, 'create'])->middleware('permission:create_item_category')->name('admin.item-category.create');
        Route::post('store', [ItemCategoryController::class, 'store'])->middleware('permission:create_item_category')->name('admin.item-category.store');
        Route::get('edit/{id}', [ItemCategoryController::class, 'edit'])->middleware('permission:update_item_category')->name('admin.item-category.edit');
        Route::put('update/{id}', [ItemCategoryController::class, 'update'])->middleware('permission:update_item_category')->name('admin.item-category.update');
        Route::delete('delete/{id}', [ItemCategoryController::class, 'delete'])->middleware('permission:delete_item_category')->name('admin.item-category.delete');
    });

    // Item Unit
    Route::group(['prefix' => 'item-unit'], function () {
        Route::get('/', [ItemUnitController::class, 'index'])->middleware('permission:read_item_unit')->name('admin.item-unit.index');
        Route::get('get-by-id/{id}', [ItemUnitController::class, 'getById'])->name('admin.item-unit.get-by-id');
        Route::get('create', [ItemUnitController::class, 'create'])->middleware('permission:create_item_unit')->name('admin.item-unit.create');
        Route::post('store', [ItemUnitController::class, 'store'])->middleware('permission:create_item_unit')->name('admin.item-unit.store');
        Route::get('edit/{id}', [ItemUnitController::class, 'edit'])->middleware('permission:update_item_unit')->name('admin.item-unit.edit');
        Route::put('update/{id}', [ItemUnitController::class, 'update'])->middleware('permission:update_item_unit')->name('admin.item-unit.update');
        Route::delete('delete/{id}', [ItemUnitController::class, 'delete'])->middleware('permission:delete_item_unit')->name('admin.item-unit.delete');
    });

    // Supplier
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/', [SupplierController::class, 'index'])->middleware('permission:read_supplier')->name('admin.supplier.index');
        Route::get('get-by-id/{id}', [SupplierController::class, 'getById'])->name('admin.supplier.get-by-id');
        Route::get('create', [SupplierController::class, 'create'])->middleware('permission:create_supplier')->name('admin.supplier.create');
        Route::post('store', [SupplierController::class, 'store'])->middleware('permission:create_supplier')->name('admin.supplier.store');
        Route::get('edit/{id}', [SupplierController::class, 'edit'])->middleware('permission:update_supplier')->name('admin.supplier.edit');
        Route::put('update/{id}', [SupplierController::class, 'update'])->middleware('permission:update_supplier')->name('admin.supplier.update');
        Route::delete('delete/{id}', [SupplierController::class, 'delete'])->middleware('permission:delete_supplier')->name('admin.supplier.delete');
    });

    // Item
    Route::group(['prefix' => 'item'], function () {
        Route::get('/', [ItemController::class, 'index'])->middleware('permission:read_item')->name('admin.item.index');
        Route::get('get-by-id/{id}', [ItemController::class, 'getById'])->name('admin.item.get-by-id');
        Route::get('create', [ItemController::class, 'create'])->middleware('permission:create_item')->name('admin.item.create');
        Route::post('store', [ItemController::class, 'store'])->middleware('permission:create_item')->name('admin.item.store');
        Route::get('edit/{id}', [ItemController::class, 'edit'])->middleware('permission:update_item')->name('admin.item.edit');
        Route::put('update/{id}', [ItemController::class, 'update'])->middleware('permission:update_item')->name('admin.item.update');
        Route::delete('delete/{id}', [ItemController::class, 'delete'])->middleware('permission:delete_item')->name('admin.item.delete');
    });

    // DoctorSchedule
    Route::group(['prefix' => 'doctor-schedule'], function () {
        Route::get('/', [DoctorScheduleController::class, 'index'])->middleware('permission:read_doctor_schedule')->name('admin.doctor-schedule.index');
        Route::get('get-by-id/{id}', [DoctorScheduleController::class, 'getById'])->name('admin.doctor-schedule.get-by-id');
        Route::get('create', [DoctorScheduleController::class, 'create'])->middleware('permission:create_doctor_schedule')->name('admin.doctor-schedule.create');
        Route::post('store', [DoctorScheduleController::class, 'store'])->middleware('permission:create_doctor_schedule')->name('admin.doctor-schedule.store');
        Route::get('edit/{id}', [DoctorScheduleController::class, 'edit'])->middleware('permission:update_doctor_schedule')->name('admin.doctor-schedule.edit');
        Route::put('update/{id}', [DoctorScheduleController::class, 'update'])->middleware('permission:update_doctor_schedule')->name('admin.doctor-schedule.update');
        Route::delete('delete/{id}', [DoctorScheduleController::class, 'delete'])->middleware('permission:delete_doctor_schedule')->name('admin.doctor-schedule.delete');
    });

    // Config Shift
    Route::group(['prefix' => 'config-shift'], function () {
        Route::get('/', [ConfigShiftController::class, 'index'])->middleware('permission:read_config_shift')->name('admin.config-shift.index');
        Route::get('get-by-id/{id}', [ConfigShiftController::class, 'getById'])->name('admin.config-shift.get-by-id');
        Route::get('create', [ConfigShiftController::class, 'create'])->middleware('permission:create_config_shift')->name('admin.config-shift.create');
        Route::post('store', [ConfigShiftController::class, 'store'])->middleware('permission:create_config_shift')->name('admin.config-shift.store');
        Route::get('edit/{id}', [ConfigShiftController::class, 'edit'])->middleware('permission:update_config_shift')->name('admin.config-shift.edit');
        Route::put('update/{id}', [ConfigShiftController::class, 'update'])->middleware('permission:update_config_shift')->name('admin.config-shift.update');
        Route::delete('delete/{id}', [ConfigShiftController::class, 'delete'])->middleware('permission:delete_config_shift')->name('admin.config-shift.delete');
    });

    // Reservations
    Route::group(['prefix' => 'reservations'], function () {
        Route::group(['prefix' => 'wait'], function () {
            Route::get('/', [ReservationsController::class, 'reservations'])->middleware('permission:read_wait_reservation')->name('front-office.reservations.wait.index');
            Route::get('detail/{id}', [ReservationsController::class, 'detail'])->middleware('permission:detail_reservation')->name('front-office.reservations.wait.detail');
        });

        Route::group(['prefix' => 'done'], function () {
            Route::get('/', [ReservationsController::class, 'done'])->middleware('permission:read_done_reservation')->name('front-office.reservations.done.index');
        });

        Route::group(['prefix' => 'confirm'], function () {
            Route::get('/', [ReservationsController::class, 'confirm_reservations'])->middleware('permission:read_confirm_reservation')->name('front-office.reservations.confirm.index');
            Route::get('detail/{id}', [ReservationsController::class, 'detail'])->middleware('permission:detail_reservation')->name('front-office.reservations.confirm.detail');
            Route::put('reschedule/update/{id}', [ReservationsController::class, 'update'])->middleware('permission:reschedule_reservation')->name('front-office.reservations.confirm.reschedule.update');
            Route::get('reschedule/{id}', [ReservationsController::class, 'reschedule'])->middleware('permission:reschedule_reservation')->name('front-office.reservations.confirm.reschedule');
        });

        Route::group(['prefix' => 'cancel'], function () {
            Route::get('/', [ReservationsController::class, 'cancel_reservations'])->middleware('permission:read_cancel_reservation')->name('front-office.reservations.cancel.index');
            Route::get('detail/{id}', [ReservationsController::class, 'detail'])->middleware('permission:detail_reservation')->name('front-office.reservations.cancel.detail');
        });

        Route::get('/reservations/{id}/confirm', [ReservationsController::class, 'confirm'])->name('front-office.reservations.detail.confirm');
        Route::get('/reservations/{id}/cancel', [ReservationsController::class, 'cancel'])->name('front-office.reservations.detail.cancel');
        Route::delete('delete/{id}', [ReservationsController::class, 'delete'])->middleware('permission:delete_reservation')->name('front-office.reservations.delete');
    });

    // ShiftLog
    Route::group(['prefix' => 'shift-log'], function () {
        Route::get('/open-shift', [ShiftLogController::class, 'open_shift'])->middleware('permission:read_open_shift_log')->name('front-office.shift-log.open-shift');
        Route::post('/open-shift/create', [ShiftLogController::class, 'open_shift_create'])->middleware('permission:create_shift_log')->name('front-office.shift-log.open-shift-create');

        Route::get('/close-shift', [ShiftLogController::class, 'close_shift'])->middleware('permission:read_close_shift_log')->name('front-office.shift-log.close-shift');
        Route::put('/close-shift/{id}/update', [ShiftLogController::class, 'close_shift_update'])->middleware('permission:update_shift_log')->name('front-office.shift-log.close-shift-update');

        Route::get('/recap-shit', [ShiftLogController::class, 'recap_shift'])->middleware('permission:read_recap_shift_log')->name('front-office.shift-log.recap-shift');
        Route::get('/recap-shit/{shiftLog}/pdf', [ShiftLogController::class, 'recap_shift_pdf'])->middleware('permission:print_shift_log')->name('front-office.shift-log.recap-shift-pdf');
    });

    // Deposit
    Route::group(['prefix' => 'deposit'], function () {
        Route::group(['prefix' => 'wait'], function () {
            Route::get('/', [ReservationsController::class, 'deposit'])->middleware('permission:read_wait_deposit')->name('front-office.deposit.wait.index');
            Route::get('detail/{id}', [ReservationsController::class, 'deposit_detail'])->middleware('permission:detail_deposit')->name('front-office.deposit.wait.detail');
        });

        Route::group(['prefix' => 'wait_deposit'], function () {
            Route::get('/', [ReservationsController::class, 'wait_deposit'])->middleware('permission:read_wait_deposit')->name('front-office.deposit.wait_depo.index');
        });

        Route::group(['prefix' => 'confirm'], function () {
            Route::get('/', [ReservationsController::class, 'confirm_deposit'])->middleware('permission:read_confirm_deposit')->name('front-office.deposit.confirm.index');
            Route::get('detail/{id}', [ReservationsController::class, 'deposit_detail'])->middleware('permission:detail_deposit')->name('front-office.deposit.confirm.detail');
        });

        Route::group(['prefix' => 'cancel'], function () {
            Route::get('/', [ReservationsController::class, 'cancel_deposit'])->middleware('permission:read_cancel_deposit')->name('front-office.deposit.cancel.index');
            Route::get('detail/{id}', [ReservationsController::class, 'deposit_detail'])->middleware('permission:detail_deposit')->name('front-office.deposit.cancel.detail');
        });

        Route::get('/deposit/{id}/confirm', [ReservationsController::class, 'deposit_confirm'])->name('front-office.deposit.detail.confirm');
        Route::get('/deposit/{id}/cancel', [ReservationsController::class, 'deposit_cancel'])->name('front-office.deposit.detail.cancel');
    });

    // Payment methods
    Route::group(['prefix' => 'payment-methods'], function () {
        Route::get('/', [PaymentMethodsController::class, 'index'])->middleware('permission:read_payment_method')->name('admin.payment-methods.index');
        Route::get('get-by-id/{id}', [PaymentMethodsController::class, 'getById'])->name('admin.payment-methods.get-by-id');
        Route::get('create', [PaymentMethodsController::class, 'create'])->middleware('permission:create_payment_method')->name('admin.payment-methods.create');
        Route::post('store', [PaymentMethodsController::class, 'store'])->middleware('permission:create_payment_method')->name('admin.payment-methods.store');
        Route::get('edit/{id}', [PaymentMethodsController::class, 'edit'])->middleware('permission:update_payment_method')->name('admin.payment-methods.edit');
        Route::put('update/{id}', [PaymentMethodsController::class, 'update'])->middleware('permission:update_payment_method')->name('admin.payment-methods.update');
        Route::delete('delete/{id}', [PaymentMethodsController::class, 'delete'])->middleware('permission:delete_payment_method')->name('admin.payment-methods.delete');
    });

    // Treatment Category
    Route::group(['prefix' => 'treatment-categories'], function () {
        Route::get('/', [TreatmentCategoriesController::class, 'index'])->middleware('permission:read_treatment_category')->name('admin.treatment-categories.index');
        Route::get('get-by-id/{id}', [TreatmentCategoriesController::class, 'getById'])->name('admin.treatment-categories.get-by-id');
        Route::get('create', [TreatmentCategoriesController::class, 'create'])->middleware('permission:create_treatment_category')->name('admin.treatment-categories.create');
        Route::post('store', [TreatmentCategoriesController::class, 'store'])->middleware('permission:create_treatment_category')->name('admin.treatment-categories.store');
        Route::get('edit/{id}', [TreatmentCategoriesController::class, 'edit'])->middleware('permission:update_treatment_category')->name('admin.treatment-categories.edit');
        Route::put('update/{id}', [TreatmentCategoriesController::class, 'update'])->middleware('permission:update_treatment_category')->name('admin.treatment-categories.update');
        Route::delete('delete/{id}', [TreatmentCategoriesController::class, 'delete'])->middleware('permission:delete_treatment_category')->name('admin.treatment-categories.delete');
    });

    // Payments / Transaction
    Route::group(['prefix' => 'transaction', 'middleware' => ['role:frontoffice']], function () {

        // payment transaction
        // list
        Route::get('/list-billing', [TransactionController::class, 'list_billing'])->middleware('permission:read_antrian_pembayaran')->name('front-office.transaction.list-billing');
        // payment
        Route::get('/payment/{transaction}', [TransactionController::class, 'payment'])->middleware('permission:pay_antiran_pembayaran')->name('front-office.transaction.payment');
        // end payment transaction

        Route::put('/payment/{transaction}/confirm', [TransactionController::class, 'payment_confirm'])->name('front-office.transaction.payment.confirm');

        Route::post('/addon-transaction/{transaction}/{examination}', [TransactionController::class, 'addon_transaction'])->name('front-office.transaction.addon-transaction');
        Route::delete('/addon-transaction/{addonExamination}', [TransactionController::class, 'remove_addon_transaction'])->name('front-office.transaction.remove_addon-transaction');

        // list transaction
        // list
        Route::get('/list-transaction', [TransactionController::class, 'list_transaction'])->middleware('permission:read_list_transaction')->name('front-office.transaction.list-transaction');
        // ubah
        Route::get('/detail-transaction/{transaction}', [TransactionController::class, 'detail_transaction'])->middleware('permission:update_transaction')->name('front-office.transaction.detail-transaction');
        // print
        Route::get('/pdf/{transaction}', [TransactionController::class, 'print_transaction'])->middleware('permission:print_transaction')->name('front-office.transaction.print-transaction');
        // end list transaction
    });
    // Diskon Treatment
    Route::group(['prefix' => 'discount_treatment'], function () {
        Route::get('/', [DiscountTreatmentController::class, 'index'])->middleware('permission:read_discount_treatment')->name('admin.discount_treatment.index');
        Route::get('get-by-id/{id}', [DiscountTreatmentController::class, 'getById'])->name('admin.discount_treatment.get-by-id');
        Route::get('create', [DiscountTreatmentController::class, 'create'])->middleware('permission:create_discount_treatment')->name('admin.discount_treatment.create');
        Route::post('store', [DiscountTreatmentController::class, 'store'])->middleware('permission:create_discount_treatment')->name('admin.discount_treatment.store');
        Route::get('edit/{id}', [DiscountTreatmentController::class, 'edit'])->middleware('permission:update_discount_treatment')->name('admin.discount_treatment.edit');
        Route::put('update/{id}', [DiscountTreatmentController::class, 'update'])->middleware('permission:update_discount_treatment')->name('admin.discount_treatment.update');
        Route::delete('delete/{id}', [DiscountTreatmentController::class, 'delete'])->middleware('permission:delete_discount_treatment')->name('admin.discount_treatment.delete');
    });

    // Diskon Item
    Route::group(['prefix' => 'discount_item'], function () {
        Route::get('/', [DiscountItemController::class, 'index'])->middleware('permission:read_discount_item')->name('admin.discount_item.index');
        Route::get('get-by-id/{id}', [DiscountItemController::class, 'getById'])->name('admin.discount_item.get-by-id');
        Route::get('create', [DiscountItemController::class, 'create'])->middleware('permission:create_discount_item')->name('admin.discount_item.create');
        Route::post('store', [DiscountItemController::class, 'store'])->middleware('permission:create_discount_item')->name('admin.discount_item.store');
        Route::get('edit/{id}', [DiscountItemController::class, 'edit'])->middleware('permission:update_discount_item')->name('admin.discount_item.edit');
        Route::put('update/{id}', [DiscountItemController::class, 'update'])->middleware('permission:update_discount_item')->name('admin.discount_item.update');
        Route::delete('delete/{id}', [DiscountItemController::class, 'delete'])->middleware('permission:delete_discount_item')->name('admin.discount_item.delete');
    });

    // patient visit report
    Route::group(['prefix' => 'patient_visit_report'], function () {
        // Admin Cabang
        Route::get('patient_visit_report/general', [PatientVisitReportController::class, 'getGeneral'])->middleware('permission:read_patient_visit_report_general')->name('admin.patient_visit_report.general');
        Route::get('patient_visit_report/general/export', [PatientVisitReportController::class, 'exportGeneral'])->middleware('permission:export_patient_visit_report_general')->name('admin.patient_visit_report.general.export');
    });
    // shift report
    Route::group(['prefix' => 'shift_report'], function () {
        // Admin Cabang
        Route::get('shift_report/general', [ShiftReportController::class, 'getGeneral'])->middleware('permission:read_shift_report_general')->name('admin.shift_report.general');
        Route::get('shift_report/general/export', [ShiftReportController::class, 'exportGeneral'])->middleware('permission:export_shift_report_general')->name('admin.shift_report.general.export');
    });
    // Income Report
    Route::group(['prefix' => 'income_report'], function () {
        // Admin Cabang
        Route::get('income-report/general', [IncomeReportController::class, 'getGeneral'])->middleware('permission:read_income_report_general')->name('admin.income-report.general');
        Route::get('income-report/general/export', [IncomeReportController::class, 'exportGeneral'])->middleware('permission:export_income_report_general')->name('admin.income-report.general.export');

        // Dokter
        Route::get('income-report/doctor', [IncomeReportController::class, 'getDoctor'])->name('admin.income-report.doctor');
        Route::get('income-report/doctor/export', [IncomeReportController::class, 'exportDoctor'])->name('admin.income-report.doctor.export');
    })->middleware('permission:read_income_report_general|export_income_report_general');

    // Treatment Report
    Route::prefix('treatment_report')->group(function () {
        Route::get('treatment-report/general', [TreatmentReportController::class, 'getGeneral'])->middleware('permission:read_treatment_report_general')->name('admin.treatment-report.general');
        Route::get('treatment-report/general/export', [TreatmentReportController::class, 'exportGeneral'])->middleware('permission:export_treatment_report_general')->name('admin.treatment-report.general.export');
    });

    // Examination History
    Route::prefix('examination-history')->group(function () {
        Route::get('/', [ExaminationHistoryController::class, 'index'])->middleware('permission:read_examination_history')->name('admin.examination-history.index');
        Route::get('{id}/show', [ExaminationHistoryController::class, 'show'])->middleware('permission:read_examination_history')->name('admin.examination-history.show');
        Route::get('{id}/examination', [ExaminationHistoryController::class, 'examination'])->middleware('permission:read_examination_history')->name('admin.examination-history.examination');
    });
});

// Get Notifikasi Reservation
Route::get('get-reservation', [DashboardController::class, 'getReservation'])->name('reservation.get');

// API Get Kategori Dokter
Route::post('get-kategori', [GetKategoriController::class, 'getKategori'])->name('kategori.get');

Route::get('/', function () {
    return view('auth.login');
});

require __DIR__ . '/auth.php';
