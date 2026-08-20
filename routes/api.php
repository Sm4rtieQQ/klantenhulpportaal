<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'authenticate'])->middleware('web');

Route::get('/user', function (Request $request) {
    $request->user();
})->middleware('auth:sanctum');

Route::get('/tickets', [TicketController::class, 'index'])->middleware('auth:sanctum');
