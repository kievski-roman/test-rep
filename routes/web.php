<?php

use App\Http\Controllers\BusController;
use App\Http\Controllers\CarBrandController;
use App\Http\Controllers\DriverController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('car-brands', CarBrandController::class);
Route::resource('drivers', DriverController::class);
Route::resource('buses', BusController::class);
