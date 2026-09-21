<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', fn() => view('app'))->name('login');

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::get('/email/verify', fn() => view('app'))
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
