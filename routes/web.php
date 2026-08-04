<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{article:slug}', [ArtikelController::class, 'show'])->name('artikel.show');

Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{product:slug}', [ProdukController::class, 'show'])->name('produk.show');

Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');
