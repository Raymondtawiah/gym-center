<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientRegisterController;
use App\Http\Controllers\GymClassController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\Admin\UserApprovalController;
use App\Http\Controllers\Admin\GymController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Auth\LoginVerificationController;

Route::view('/', 'welcome')->name('home');

Route::view('/terms', 'pages.terms')->name('terms');

Route::view('/privacy', 'pages.privacy')->name('privacy');

// Login verification routes (before auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/login/verify', [LoginVerificationController::class, 'show'])->name('login.verify');
    Route::post('/login/verify/resend', [LoginVerificationController::class, 'resend'])->name('login.verify.resend');
    Route::post('/login/verify/code', [LoginVerificationController::class, 'verify'])->name('login.verify.code');
});

// Login verification with signed URL
Route::get('/login/verify/{id}/{hash}', [LoginVerificationController::class, 'verify'])->name('login.verify.link')->middleware(['auth', 'signed']);

// Custom registration route to redirect to login after registration
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    
    // Client bookings route - for clients to view their memberships
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('client.bookings');
    Route::get('/my-bookings/{booking}', [BookingController::class, 'showBooking'])->name('client.bookings.show');
    
    // Admin and Staff routes (both can access these)
    Route::middleware(['admin'])->group(function () {
        // Client registration - admin only
        Route::view('/client-register', 'pages.client-register')->name('client.register');
        Route::post('/client-register', [ClientRegisterController::class, 'store'])->name('client.register.store');
        
        // Booking management routes - both admin and staff can access (except delete)
        Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
        Route::get('/admin/bookings/create', [BookingController::class, 'create'])->name('admin.bookings.create');
        Route::post('/admin/bookings', [BookingController::class, 'store'])->name('admin.bookings.store');
        
        // Print booking form - both admin and staff can access (must be before wildcard route)
        Route::get('/admin/bookings/print-form', [BookingController::class, 'printForm'])->name('admin.bookings.print-form');
        
        Route::get('/admin/bookings/{booking}', [BookingController::class, 'show'])->name('admin.bookings.show');
        Route::patch('/admin/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.update-status');
        
        // Gym management routes - both admin and staff can access
        Route::get('/admin/gym/settings', [GymController::class, 'settings'])->name('admin.gym.settings');
        Route::patch('/admin/gym/{gym}', [GymController::class, 'update'])->name('admin.gym.update');
    });
    
    // Admin only routes (user management and booking delete)
    Route::middleware(['admin'])->group(function () {
        // User management routes - admin only
        Route::get('/admin/users', [UserApprovalController::class, 'index'])->name('admin.users.index');
        Route::patch('/admin/users/{user}/approve', [UserApprovalController::class, 'approve'])->name('admin.users.approve');
        Route::patch('/admin/users/{user}/disapprove', [UserApprovalController::class, 'disapprove'])->name('admin.users.disapprove');
        Route::delete('/admin/users/{user}', [UserApprovalController::class, 'destroy'])->name('admin.users.destroy');
        
        // Staff management routes - admin only
        Route::get('/admin/gym/staff', [GymController::class, 'staff'])->name('admin.gym.staff');
        Route::post('/admin/gym/staff/add', [GymController::class, 'addStaff'])->name('admin.gym.staff.add');
        Route::delete('/admin/gym/staff/{user}', [GymController::class, 'removeStaff'])->name('admin.gym.staff.remove');
        
        // Delete booking - admin only
        Route::delete('/admin/bookings/{booking}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
    });
});

require __DIR__.'/settings.php';
