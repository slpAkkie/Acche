<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function store(LoginRequest $request)
    {
        return response()->redirectToRoute('login.create');
    }
}
