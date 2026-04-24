<?php

namespace App\Http\Requests;

class LoginRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'mot_de_passe' => ['required', 'string'],
        ];
    }
}
