<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nickname'  => 'required|unique:users,nickname',
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed',
        ];
    }
}
