<?php

namespace App\Http\Requests;

class StoreUtilisateurRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:100'],
            'prenom' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:191', 'unique:utilisateurs,email'],
            'mot_de_passe' => ['required', 'string', 'min:8'],
            'date_de_naissance' => ['nullable', 'date'],
            'sexe' => ['nullable', 'in:M,F'],
            'role' => ['required', 'in:admin,commercant,vendeur'],
            'photo' => ['nullable', 'string', 'max:255'],
        ];
    }
}
