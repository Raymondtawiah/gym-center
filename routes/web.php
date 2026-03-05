<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientRegisterController;
use App\Http\Controllers\GymClassController;

Route::view('/', 'welcome')->name('home');

Route::view('/terms', 'pages.terms')->name('terms');

Route::view('/privacy', 'pages.privacy')->name('privacy');

Route::view('/client-register', 'pages.client-register')->name('client.register');
Route::post('/client-register', [ClientRegisterController::class, 'store'])->name('client.register.store');

Route::get('/classes', [GymClassController::class, 'index'])->name('classes');
Route::post('/classes/book', [GymClassController::class, 'book'])->name('classes.book');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
