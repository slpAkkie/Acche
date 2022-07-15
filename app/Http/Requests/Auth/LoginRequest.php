<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class LoginRequest extends Request
{
    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nickname.exists' => 'Аккаунта с этим никнеймом не существует',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nickname'  => 'required|exists:users,nickname',
            'password'  => 'required',
        ];
    }
}
