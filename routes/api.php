<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\GymClassController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group.
|
*/

// Public routes - list available classes
Route::get('/classes', [GymClassController::class, 'index']);

// Protected routes - requires authentication
Route::middleware(['auth:sanctum'])->group(function () {
    // Gym Classes
    Route::post('/classes/book', [GymClassController::class, 'book']);
    Route::get('/classes/my', [GymClassController::class, 'myClasses']);
    
    // Admin Booking Management using apiResource
    Route::apiResource('admin/bookings', BookingController::class);
    
    // Custom route for updating booking status
    Route::patch('/admin/bookings/{booking}/status', [BookingController::class, 'updateStatus']);
});
