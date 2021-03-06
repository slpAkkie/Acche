<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes that should be accessed only by authorized user
Route::middleware('auth')->group(function () {
    // Home page
    Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

    // User's pages
    Route::prefix('/user')->name('user.')->group(function () {
        // User's settings pages
        Route::name('settings.')->group(function () {
            Route::get('/settings', [App\Http\Controllers\User\SettingsController::class, 'index'])->name('index');
            Route::post('/settings', [App\Http\Controllers\User\SettingsController::class, 'store'])->name('store');
        });
    });

    // Chat's pages
    Route::prefix('/chats')->name('chats.')->group(function () {
        Route::get('/index', [App\Http\Controllers\ChatController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\ChatController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\ChatController::class, 'store'])->name('store');
        Route::get('/join', [App\Http\Controllers\ChatController::class, 'join'])->name('join');
        Route::post('/join', [App\Http\Controllers\ChatController::class, 'allowAccess'])->name('allowAccess');

        // Concrete chat
        Route::prefix('/{chat}')->group(function () {
            Route::get('/', [App\Http\Controllers\ChatController::class, 'show'])->name('show');

            // Chat's messages
            Route::prefix('/messages')->name('messages.')->group(function () {
                Route::get('/', [App\Http\Controllers\MessageController::class, 'index'])->name('index');
                Route::get('/checkNew', [App\Http\Controllers\MessageController::class, 'checkNew'])->name('checkNew');
                Route::post('/', [App\Http\Controllers\MessageController::class, 'store'])->name('store');
            });
        });
    });
});

require_once __DIR__ . DIRECTORY_SEPARATOR . 'auth.php';
