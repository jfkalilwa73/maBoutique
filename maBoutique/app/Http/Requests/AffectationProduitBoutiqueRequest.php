<?php

namespace App\Http\Requests;

class AffectationProduitBoutiqueRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id_boutique' => ['required', 'exists:boutiques,id_boutique'],
            'id_produit' => ['required', 'exists:produits,id_produit'],
        ];
    }
}
