<?php

namespace App\Http\Requests;

class StoreCategorieRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255', 'unique:categories,nom'],
            'description' => ['nullable', 'string'],
        ];
    }
}
