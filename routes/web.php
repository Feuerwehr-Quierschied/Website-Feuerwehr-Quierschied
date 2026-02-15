<?php

use App\Http\Controllers\EinsatzController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'welcomeIntro' => \App\Models\WelcomeIntro::instance(),
    ]);
});

Route::get('/einsaetze', [EinsatzController::class, 'index'])->name('einsaetze.index');
Route::get('/einsaetze/{slug}', [EinsatzController::class, 'show'])->name('einsaetze.show');

Route::get('/ueber-uns', fn () => view('about_us.ueber_uns'))->name('about_us.ueber_uns');

Route::get('/aktuelles', [\App\Http\Controllers\AktuellesController::class, 'index'])->name('aktuelles.index');
Route::get('/aktuelles/{slug}', [\App\Http\Controllers\AktuellesController::class, 'show'])->name('aktuelles.show');
Route::get('/deploy-migrate', function () {
    \Artisan::call('migrate --force');

    return 'Migrated!';
});
