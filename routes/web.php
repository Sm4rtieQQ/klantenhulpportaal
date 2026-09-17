<?php

use Illuminate\Support\Facades\Route;

Route::get('/email/verify', function () {
    return view('app');
})->middleware('auth')->name('verification.notice');

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
