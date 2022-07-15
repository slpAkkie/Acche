<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\OkResource;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{
    /**
     * Display the page for register new user.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle request to register new user with provided data.
     *
     * @param  RegisterRequest  $request
     * @return OkResource
     */
    public function store(RegisterRequest $request): OkResource
    {
        (new User($request->only([
            'nickname',
            'name',
            'email',
            'password',
        ])))->save();

        return OkResource::make();
    }
}
