<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateCategorieRequest extends ApiFormRequest
{
    public function rules(): array
    {
        $id = $this->route('category');

        return [
            'nom' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('categories', 'nom')->ignore($id, 'id_categorie'),
            ],
            'description' => ['nullable', 'string'],
        ];
    }
}
