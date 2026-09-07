<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Notecontroller;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('/user', 'user');
        Route::post('/logout', 'invalidate');
    });

    Route::controller(CategoryController::class)->middleware('admin')->group(function () {
        Route::get('/categories', 'index');
        Route::post('/categories', 'store');
        Route::put('/categories/{id}', 'update');
        Route::delete('/categories/{category}', 'destroy');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::get('/comments', 'index');
        Route::post('/comments', 'store');
    });

    Route::controller(TicketController::class)->group(function () {
        Route::get('/tickets', 'index');
        Route::post('/tickets', 'store');
        Route::put('/tickets/{id}', 'update');
    });

    Route::get('/users', [UserController::class, 'getAdmins']);
    Route::get('/notes', [NoteController::class, 'index'])->middleware('admin');
});
