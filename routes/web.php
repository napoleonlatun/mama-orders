<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminAuthController;

// Redirect root to admin login
Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Admin Authentication Routes (PUBLIC - no auth needed)
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

// ALL PROTECTED ROUTES - Require admin login
Route::middleware('admin')->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    // Admin Logout
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
    // Orders Management
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    
    // People Management
    Route::get('/people', [PeopleController::class, 'index'])->name('people.index');
    Route::post('/people', [PeopleController::class, 'store'])->name('people.store');
    
    // Add ALL your other routes here - they're ALL protected!
});
