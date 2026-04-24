<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateUtilisateurRequest extends ApiFormRequest
{
    public function rules(): array
    {
        $id = $this->route('utilisateur') ?? $this->route('id');

        return [
            'nom' => ['sometimes', 'string', 'max:100'],
            'prenom' => ['sometimes', 'string', 'max:100'],
            'email' => [
                'sometimes',
                'email',
                'max:191',
                Rule::unique('utilisateurs', 'email')->ignore($id, 'id_utilisateur'),
            ],
            'mot_de_passe' => ['sometimes', 'string', 'min:8'],
            'date_de_naissance' => ['nullable', 'date'],
            'sexe' => ['nullable', 'in:M,F'],
            'role' => ['sometimes', 'in:admin,commercant,vendeur'],
            'photo' => ['nullable', 'string', 'max:255'],
        ];
    }
}
