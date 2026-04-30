<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use App\Models\Admin;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
*/

/* Dashboard data */
Route::get('/menu', fn() => response()->json(Menu::all()));

Route::get('/orders', fn() => response()->json(Order::all()));

Route::get('/users', fn() => response()->json(User::all()));

Route::get('/admins', fn() => response()->json(Admin::all()));




