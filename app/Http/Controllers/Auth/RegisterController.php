<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        return response()->redirectToRoute('register.create');
    }
}
