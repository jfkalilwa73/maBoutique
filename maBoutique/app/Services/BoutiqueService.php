<?php

namespace App\Services;

use App\Models\Boutique;
use App\Models\Utilisateur;
use Illuminate\Auth\Access\AuthorizationException;

class BoutiqueService
{
    public function creerBoutique(Utilisateur $acteur, array $donnees): Boutique
    {
        if (! in_array($acteur->role, ['admin', 'commercant'], true)) {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à créer une boutique.');
        }

        $idCommercant = (int) ($donnees['id_commercant'] ?? 0);

        if ($acteur->role === 'commercant') {
            // Un commerçant ne peut créer que pour lui-même
            $idCommercant = (int) $acteur->id_utilisateur;
        }

        $commercant = Utilisateur::findOrFail($idCommercant);

        if ($commercant->role !== 'commercant') {
            throw new AuthorizationException('Le propriétaire de la boutique doit être un commerçant.');
        }

        return Boutique::create([
            'id_commercant' => $idCommercant,
            'nom' => $donnees['nom'],
            'description' => $donnees['description'] ?? null,
        ]);
    }

    public function modifierBoutique(Utilisateur $acteur, Boutique $boutique, array $donnees): Boutique
    {
        if (! in_array($acteur->role, ['admin', 'commercant'], true)) {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à modifier cette boutique.');
        }

        if ($acteur->role === 'commercant' && (int) $boutique->id_commercant !== (int) $acteur->id_utilisateur) {
            throw new AuthorizationException('Cette boutique ne vous appartient pas.');
        }

        // Un commerçant ne peut pas changer le propriétaire
        if ($acteur->role === 'commercant') {
            unset($donnees['id_commercant']);
        }

        if (isset($donnees['id_commercant'])) {
            $nouveauCommercant = Utilisateur::findOrFail((int) $donnees['id_commercant']);
            if ($nouveauCommercant->role !== 'commercant') {
                throw new AuthorizationException('Le nouveau propriétaire doit être un commerçant.');
            }
        }

        $boutique->update($donnees);

        return $boutique->fresh();
    }

    public function supprimerBoutique(Utilisateur $acteur, Boutique $boutique): void
    {
        if (! in_array($acteur->role, ['admin', 'commercant'], true)) {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à supprimer cette boutique.');
        }

        if ($acteur->role === 'commercant' && (int) $boutique->id_commercant !== (int) $acteur->id_utilisateur) {
            throw new AuthorizationException('Cette boutique ne vous appartient pas.');
        }

        $boutique->delete();
    }
}