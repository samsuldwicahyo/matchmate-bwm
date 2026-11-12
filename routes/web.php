<?php

// Routing utama aplikasi MatchMate BWM
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\HasilBwmController;
use App\Http\Controllers\RekomendasiController;

Route::get('/', fn () => redirect()->route('penilaian.form'));

Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.form');
Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');

Route::get('/hasil', [HasilBwmController::class, 'index'])->name('hasil.index');
Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi.index');
