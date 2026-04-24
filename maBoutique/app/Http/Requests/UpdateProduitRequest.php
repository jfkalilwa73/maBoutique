<?php

namespace App\Http\Requests;

class UpdateProduitRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id_categorie' => ['nullable', 'exists:categories,id_categorie'],
            'nom' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'prix' => ['sometimes', 'numeric', 'min:0'],
            'quantite' => ['sometimes', 'integer', 'min:0'],
            'photo' => ['nullable', 'string', 'max:255'],
        ];
    }
}
