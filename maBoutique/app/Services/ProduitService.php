<?php

namespace App\Services;

use App\Models\Produit;
use App\Models\Utilisateur;
use Illuminate\Auth\Access\AuthorizationException;

class ProduitService
{
    public function creerProduit(Utilisateur $acteur, array $donnees): Produit
    {
        if (! in_array($acteur->role, ['admin', 'commercant'], true)) {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à créer un produit.');
        }

        return Produit::create([
            'id_categorie' => $donnees['id_categorie'] ?? null,
            'nom' => $donnees['nom'],
            'description' => $donnees['description'] ?? null,
            'prix' => $donnees['prix'],
            'quantite' => $donnees['quantite'],
            'photo' => $donnees['photo'] ?? null,
        ]);
    }

    public function modifierProduit(Utilisateur $acteur, Produit $produit, array $donnees): Produit
    {
        if (! in_array($acteur->role, ['admin', 'commercant'], true)) {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à modifier un produit.');
        }

        if ($acteur->role === 'commercant') {
            $estDansSonPerimetre = $produit->boutiques()
                ->where('boutiques.id_commercant', $acteur->id_utilisateur)
                ->exists();

            if (! $estDansSonPerimetre) {
                throw new AuthorizationException('Ce produit est hors de votre périmètre.');
            }
        }

        $produit->update($donnees);

        return $produit->fresh();
    }

    public function supprimerProduit(Utilisateur $acteur, Produit $produit): void
    {
        if (! in_array($acteur->role, ['admin', 'commercant'], true)) {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à supprimer un produit.');
        }

        if ($acteur->role === 'commercant') {
            $estDansSonPerimetre = $produit->boutiques()
                ->where('boutiques.id_commercant', $acteur->id_utilisateur)
                ->exists();

            if (! $estDansSonPerimetre) {
                throw new AuthorizationException('Ce produit est hors de votre périmètre.');
            }
        }

        $produit->delete();
    }
}