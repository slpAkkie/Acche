<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Exceptions\ValidationFailedResource;
use App\Http\Resources\OkResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    /**
     * Display the page for login.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Handle request to login user with provided credentials.
     *
     * @param  LoginRequest  $request
     * @return OkResource|ValidationFailedResource
     */
    public function store(LoginRequest $request): OkResource|ValidationFailedResource
    {
        // Find the user by provided nickname.
        $user = User::find($request->get('nickname'));

        // Check if user not found or provided password incorrect.
        // If so returns new validation error resource.
        if (!$user || !$user->checkPassword($request->get('password'))) {
            return ValidationFailedResource::make([
                'nickname' => 'Никнейм или пароль указаны не правильно',
            ]);
        }

        // If previous checks are passed.
        // Try to authorize user with provided credentials.
        // If everything is OK returns an OkResource as response.
        // TODO: Perhaps it is worth specifying the guard.
        if (Auth::attempt($request->only([
            'nickname',
            'password',
        ]), $request->get('remember_me'))) {
            return OkResource::make();
        }

        // If login attempt failed
        // Returns new Validation failed resource
        return ValidationFailedResource::make([
            'nickname' => 'Попытка входа не удалась'
        ]);
    }

    /**
     * Handle request to logout authorized user.
     *
     * @return OkResource
     */
    public function destroy(): OkResource
    {
        // Logout the authorized user.
        // TODO: Perhaps it is worth specifying the guard.
        Auth::logout();

        return OkResource::make();
    }
}
