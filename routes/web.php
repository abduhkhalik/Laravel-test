<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenjualanController;

// Rute utama untuk halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk penjualan, menggunakan resource route
Route::resource('penjualan', PenjualanController::class);
