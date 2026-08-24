<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'invalidate'])->middleware('auth:sanctum');

Route::get('/tickets', [TicketController::class, 'index'])->middleware('auth:sanctum');
