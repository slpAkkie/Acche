<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register auth routes for your application.
| These routes are part of web routes.
|
*/

// Routes that should be accessed only by unauthorized user
Route::middleware('guest')->group(function () {
    Route::prefix('/login')->name('login.')->group(function () {
        Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Auth\LoginController::class, 'store'])->name('store');
    });

    Route::prefix('/register')->name('register.')->group(function () {
        Route::get('/', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('store');
    });
});

// Routes that should be accessed only by authorized user
Route::middleware('auth')->delete('/logout', [App\Http\Controllers\Auth\LoginController::class, 'destroy'])->name('logout');
