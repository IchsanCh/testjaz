<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{article:slug}', [ArtikelController::class, 'show'])->name('artikel.show');

Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');
