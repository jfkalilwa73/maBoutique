<?php

namespace App\Http\Requests;

class AffectationVendeurProduitRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id_produit' => ['required', 'exists:produits,id_produit'],
            'id_vendeur' => ['required', 'exists:utilisateurs,id_utilisateur'],
        ];
    }
}
