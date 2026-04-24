<?php

namespace App\Http\Requests;

class UpdateBoutiqueRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id_commercant' => ['sometimes', 'exists:utilisateurs,id_utilisateur'],
            'nom' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }
}
