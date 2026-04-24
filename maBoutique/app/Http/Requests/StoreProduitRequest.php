<?php

namespace App\Http\Requests;

class StoreProduitRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id_categorie' => ['nullable', 'exists:categories,id_categorie'],
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'prix' => ['required', 'numeric', 'min:0'],
            'quantite' => ['required', 'integer', 'min:0'],
            'photo' => ['nullable', 'string', 'max:255'],
        ];
    }
}
