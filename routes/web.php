<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\OrderController;

Route::get('/', [OrderController::class, 'index'])->name('orders.index');

Route::get('/people', [PeopleController::class, 'index'])->name('people.index');
Route::post('/people', [PeopleController::class, 'store'])->name('people.store');
