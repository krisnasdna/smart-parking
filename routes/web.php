<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParkingController;

// Route untuk halaman index slot parkir
Route::get('/', [ParkingController::class, 'index'])->name('home');

// Rute untuk halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => \App\Http\Middleware\AdminMiddleware::class], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/register_card', [AdminController::class, 'showRegisterCardForm'])->name('admin.register_cards');
    Route::post('/admin/register-card', [AdminController::class, 'storeCard'])->name('admin.store_card');
    Route::get('/parking', [AdminController::class, 'showParkingSlots'])->name('admin.slot_parking');
});
