<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Exceptions\ValidationFailedResource;
use App\Http\Resources\OkResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login user
     *
     * @param LoginRequest $request
     * @return void
     */
    public function store(LoginRequest $request)
    {
        $user = User::find($request->get('nickname'));

        if (!$user || !$user->checkPassword($request->get('password'))) {
            return ValidationFailedResource::make([
                'nickname' => 'Никнейм или пароль указаны не правильно',
            ]);
        }

        if (Auth::attempt($request->only([
            'nickname',
            'password',
        ]), $request->get('remember_me'))) {
            return OkResource::make();
        }

        return ValidationFailedResource::make([
            'nickname' => 'Попытка входа не удалась'
        ]);
    }

    /**
     * Logout user
     *
     * @return void
     */
    public function destroy()
    {
        Auth::logout();

        return OkResource::make();
    }
}
