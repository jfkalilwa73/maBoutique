<?php

namespace App\Services;

use App\Models\Utilisateur;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Hash;

class UtilisateurService
{
    /**
     * Règles:
     * - admin peut créer commercant et vendeur
     * - commercant peut créer seulement vendeur
     */
    public function creerUtilisateur(Utilisateur $acteur, array $donnees): Utilisateur
    {
        $roleCible = $donnees['role'] ?? null;

        if (! $roleCible) {
            throw new AuthorizationException('Le rôle cible est obligatoire.');
        }

        if ($acteur->role === 'admin') {
            if (! in_array($roleCible, ['commercant', 'vendeur'], true)) {
                throw new AuthorizationException('Un admin peut créer uniquement un commerçant ou un vendeur.');
            }
        } elseif ($acteur->role === 'commercant') {
            if ($roleCible !== 'vendeur') {
                throw new AuthorizationException('Un commerçant peut créer uniquement un vendeur.');
            }
        } else {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à créer des comptes.');
        }

        $donnees['mot_de_passe'] = Hash::make($donnees['mot_de_passe']);

        return Utilisateur::create($donnees);
    }
}