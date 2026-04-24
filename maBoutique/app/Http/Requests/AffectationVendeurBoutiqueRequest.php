<?php

namespace App\Http\Requests;

class AffectationVendeurBoutiqueRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id_boutique' => ['required', 'exists:boutiques,id_boutique'],
            'id_vendeur' => ['required', 'exists:utilisateurs,id_utilisateur'],
        ];
    }
}
