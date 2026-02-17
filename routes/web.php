<?php

use App\Http\Controllers\EinsatzController;
use App\Http\Controllers\KontaktController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get('/', function () {
    return view('welcome', [
        'welcomeIntro' => \App\Models\WelcomeIntro::instance(),
    ]);
});

Route::get('/einsaetze', [EinsatzController::class, 'index'])->name('einsaetze.index');
Route::get('/einsaetze/{slug}', [EinsatzController::class, 'show'])->name('einsaetze.show');

Route::get('/ueber-uns', fn () => view('about_us.ueber_uns'))->name('about_us.ueber_uns');

Route::get('/kontakt', [KontaktController::class, 'index'])->name('kontakt.index');
Route::post('/kontakt', [KontaktController::class, 'store'])->middleware(ProtectAgainstSpam::class)->name('kontakt.store');

Route::get('/aktuelles', [\App\Http\Controllers\AktuellesController::class, 'index'])->name('aktuelles.index');
Route::get('/aktuelles/{slug}', [\App\Http\Controllers\AktuellesController::class, 'show'])->name('aktuelles.show');

Route::get('/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar.index');
Route::get('/calendar/events', [\App\Http\Controllers\CalendarController::class, 'events'])->name('calendar.events');
Route::get('/deploy-migrate', function () {
    \Artisan::call('migrate --force');

    return 'Migrated!';
});
