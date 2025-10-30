<?php

use App\Http\Controllers\CarBrandController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('car-brands', CarBrandController::class);
