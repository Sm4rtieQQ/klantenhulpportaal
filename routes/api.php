<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Notecontroller;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/login', 'login');
    Route::post('/auth/register', 'register');
    Route::get('/auth/status', 'status');
    Route::get('/auth/user', 'user')->middleware('auth:sanctum');
    Route::post('/auth/logout', 'logout')->middleware('auth:sanctum');

    Route::post('/email/verification-notification', 'resendEmailNotice')
        ->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');

    Route::post('/forgot-password', 'sendPasswordResetLink')
        ->middleware('guest')->name('password.email');
    Route::get('/reset-password/{token}', 'receivePasswordResetToken')
        ->middleware('guest')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')
        ->middleware('guest')->name('password.update');
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::controller(CategoryController::class)->middleware('admin')
        ->group(function () {
            Route::get('/categories', 'index')->withoutMiddleware('admin');
            Route::post('/categories', 'store');
            Route::put('/categories/{category}', 'update');
            Route::delete('/categories/{category}', 'destroy');
        });

    Route::controller(CommentController::class)->group(function () {
        Route::get('/comments', 'index');
        Route::post('/comments', 'store');
        Route::put('/comments/{comment}', 'update');
        Route::delete('/comments/{comment}', 'destroy');
    });

    Route::controller(NoteController::class)->middleware('admin')
        ->group(function () {
            Route::get('/notes', 'index');
            Route::post('/notes', 'store');
            Route::put('/notes/{note}', 'update');
            Route::delete('/notes/{note}', 'destroy');
        });

    Route::controller(TicketController::class)->group(function () {
        Route::get('/tickets', 'index');
        Route::post('/tickets', 'store');
        Route::put('/tickets/{ticket}', 'update');
    });

    Route::controller(UserController::class)->middleware('admin')
        ->group(function () {
            Route::get('/users', 'index');
            Route::put('/users/{user}', 'update');
            Route::delete('/users/{user}', 'destroy');
            Route::get('/users/admins', 'getAdmins');
        });
});
