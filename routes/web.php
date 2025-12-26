<?php

use App\Http\Controllers\EinsatzController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/einsaetze', [EinsatzController::class, 'index'])->name('einsaetze.index');
Route::get('/einsaetze/{slug}', [EinsatzController::class, 'show'])->name('einsaetze.show');

Route::get('/aktuelles', [\App\Http\Controllers\AktuellesController::class, 'index'])->name('aktuelles.index');
Route::get('/aktuelles/{slug}', [\App\Http\Controllers\AktuellesController::class, 'show'])->name('aktuelles.show');
