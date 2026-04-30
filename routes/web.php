<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Redirect root to login
Route::get('/', [AdminController::class, 'login'])->name('login');

// Login
Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/login', [AdminController::class, 'loginPost'])->name('login.post');

// Logout (FIXED: must be GET OR match your controller usage)
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');




Route::middleware('auth:admin')->group(function () {

    Route::get('/home', [AdminController::class, 'home'])->name('home');

    Route::get('/customers', [AdminController::class, 'customers'])->name('customers');

    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');

    Route::get('/sales', [AdminController::class, 'sales'])->name('sales');

    Route::get('/data', [AdminController::class, 'data']) ->name('data');

});


use App\Http\Controllers\CustomerController;

Route::get('/customers', [CustomerController::class, 'index'])->name('customers');


    use App\Http\Controllers\OrdersController;

Route::get('/orders', [OrdersController::class, 'index'])->name('orders');


use App\Http\Controllers\SalesController;

Route::get('/sales', [SalesController::class, 'index'])->name('sales');


use App\Http\Controllers\DataController;

Route::get('/data', [DataController::class, 'index'])->name('data');