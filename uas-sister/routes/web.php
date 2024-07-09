<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\StatusController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('/anggota', \App\Http\Controllers\AnggotaController::class);
Route::resource('/buku', \App\Http\Controllers\BukuController::class);
Route::resource('/kategori', \App\Http\Controllers\KategoriController::class);
Route::resource('/peminjaman', \App\Http\Controllers\PeminjamanController::class);
Route::resource('/status', \App\Http\Controllers\StatusController::class);