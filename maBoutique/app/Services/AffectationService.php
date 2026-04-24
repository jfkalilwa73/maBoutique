<?php

namespace App\Services;

use App\Models\Boutique;
use App\Models\Produit;
use App\Models\Utilisateur;
use Illuminate\Auth\Access\AuthorizationException;

class AffectationService
{
    public function affecterVendeurABoutique(Utilisateur $acteur, int $idBoutique, int $idVendeur): void
    {
        if ($acteur->role !== 'commercant' && $acteur->role !== 'admin') {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à affecter un vendeur à une boutique.');
        }

        $boutique = Boutique::findOrFail($idBoutique);
        $vendeur = Utilisateur::findOrFail($idVendeur);

        if ($vendeur->role !== 'vendeur') {
            throw new AuthorizationException('L\'utilisateur ciblé n\'est pas un vendeur.');
        }

        if ($acteur->role === 'commercant' && (int) $boutique->id_commercant !== (int) $acteur->id_utilisateur) {
            throw new AuthorizationException('Cette boutique ne vous appartient pas.');
        }

        $boutique->vendeurs()->syncWithoutDetaching([$vendeur->id_utilisateur]);
    }

    public function affecterProduitABoutique(Utilisateur $acteur, int $idBoutique, int $idProduit): void
    {
        if ($acteur->role !== 'commercant' && $acteur->role !== 'admin') {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à affecter un produit à une boutique.');
        }

        $boutique = Boutique::findOrFail($idBoutique);
        $produit = Produit::findOrFail($idProduit);

        if ($acteur->role === 'commercant' && (int) $boutique->id_commercant !== (int) $acteur->id_utilisateur) {
            throw new AuthorizationException('Cette boutique ne vous appartient pas.');
        }

        $boutique->produits()->syncWithoutDetaching([$produit->id_produit]);
    }

    public function affecterVendeurAProduit(Utilisateur $acteur, int $idProduit, int $idVendeur): void
    {
        if ($acteur->role !== 'commercant' && $acteur->role !== 'admin') {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à affecter un vendeur à un produit.');
        }

        $produit = Produit::with('boutiques')->findOrFail($idProduit);
        $vendeur = Utilisateur::findOrFail($idVendeur);

        if ($vendeur->role !== 'vendeur') {
            throw new AuthorizationException('L\'utilisateur ciblé n\'est pas un vendeur.');
        }

        if ($acteur->role === 'commercant') {
            $commercantPossedeProduit = $produit->boutiques->contains(
                fn ($b) => (int) $b->id_commercant === (int) $acteur->id_utilisateur
            );

            if (! $commercantPossedeProduit) {
                throw new AuthorizationException('Ce produit n\'est pas dans votre périmètre.');
            }
        }

        $produit->vendeurs()->syncWithoutDetaching([$vendeur->id_utilisateur]);
    }
}