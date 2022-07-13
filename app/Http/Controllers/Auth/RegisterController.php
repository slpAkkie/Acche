<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\OkResource;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Register new user with provided data
     *
     * @param RegisterRequest $request
     * @return void
     */
    public function store(RegisterRequest $request)
    {
        $user = new User($request->only([
            'nickname',
            'name',
            'email',
            'password',
        ]));

        $user->save();

        return OkResource::make();
    }
}
