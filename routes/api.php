<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegistrationController;
use App\Http\Controllers\API\ReservationsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API REGISTRATION
Route::post('registration', RegistrationController::class);

// API RESERVATION
Route::post('reservation', [ReservationsController::class, 'store']);
Route::get('treatment', [ReservationsController::class, 'treatment']);
Route::get('branch', [ReservationsController::class, 'branch']);
Route::post('customer', [ReservationsController::class, 'customer']);
