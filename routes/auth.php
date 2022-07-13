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

Route::middleware('guest')->group(function () {
    Route::prefix('/login')->name('login.')->group(function () {
        Route::inertia('/', 'Auth/Login')->name('create');
        Route::post('/', [App\Http\Controllers\Auth\LoginController::class, 'store'])->name('store');
    });

    Route::prefix('/register')->name('register.')->group(function () {
        Route::inertia('/', 'Auth/Register')->name('create');
        Route::post('/', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('store');
    });
});
