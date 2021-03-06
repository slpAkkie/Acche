<?php

namespace App\Http\Requests\Chat;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'      => 'required',
            'password'  => 'nullable',
        ];
    }
}
