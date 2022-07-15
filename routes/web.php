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

Route::middleware('auth')->group(function () {
    Route::inertia('/', 'Home')->name('home');

    // Routes for User
    Route::prefix('/user')->name('user.')->group(function () {
        // Routes for User Settings
        Route::name('settings.')->group(function () {
            Route::inertia('/settings', 'User/Settings')->name('create');
            Route::post('/settings', [App\Http\Controllers\User\SettingsController::class, 'store'])->name('store');
        });
    });

    // Routes for Chats
    Route::prefix('/chats')->name('chats.')->group(function () {
        Route::get('/index', [App\Http\Controllers\ChatController::class, 'index'])->name('index');
        Route::inertia('/create', 'Chat/Create')->name('create');
        Route::post('/store', [App\Http\Controllers\ChatController::class, 'store'])->name('store');
        Route::get('/show/{chat}', fn (App\Http\Requests\Request $request, App\Models\Chat $chat) => Inertia\Inertia::render('Chat/Show', [
            'chat' => App\Http\Resources\Chat\ChatResource::make($chat)->toArray($request),
        ]))->name('show');
    });
});

require_once __DIR__ . DIRECTORY_SEPARATOR . 'auth.php';
