<?php

namespace App\Http\Requests;

class StoreBoutiqueRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id_commercant' => ['nullable', 'exists:utilisateurs,id_utilisateur'],
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }
}
