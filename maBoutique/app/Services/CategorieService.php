<?php

namespace App\Services;

use App\Models\Categorie;
use App\Models\Utilisateur;
use Illuminate\Auth\Access\AuthorizationException;

class CategorieService
{
    public function creerCategorie(Utilisateur $acteur, array $donnees): Categorie
    {
        if (! in_array($acteur->role, ['admin', 'commercant'], true)) {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à créer une catégorie.');
        }

        return Categorie::create([
            'nom' => $donnees['nom'],
            'description' => $donnees['description'] ?? null,
        ]);
    }

    public function modifierCategorie(Utilisateur $acteur, Categorie $categorie, array $donnees): Categorie
    {
        if (! in_array($acteur->role, ['admin', 'commercant'], true)) {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à modifier une catégorie.');
        }

        $categorie->update($donnees);

        return $categorie->fresh();
    }

    public function supprimerCategorie(Utilisateur $acteur, Categorie $categorie): void
    {
        if (! in_array($acteur->role, ['admin', 'commercant'], true)) {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à supprimer une catégorie.');
        }

        $categorie->delete();
    }
}