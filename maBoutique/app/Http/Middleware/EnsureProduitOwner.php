<?php

namespace App\Http\Middleware;

use App\Models\Produit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProduitOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['message' => 'Non authentifié.'], 401);
        }

        if ($user->role === 'admin') {
            return $next($request);
        }

        $idProduit = $request->route('id')
            ?? $request->route('produit')
            ?? $request->input('id_produit');

        $produit = Produit::with('boutiques')->find($idProduit);

        if (! $produit) {
            return response()->json(['message' => 'Produit introuvable.'], 404);
        }

        if ($user->role !== 'commercant') {
            return response()->json(['message' => 'Accès interdit.'], 403);
        }

        $possedeLeProduit = $produit->boutiques
            ->contains(fn ($b) => (int) $b->id_commercant === (int) $user->id_utilisateur);

        if (! $possedeLeProduit) {
            return response()->json(['message' => 'Vous ne pouvez pas gérer ce produit.'], 403);
        }

        return $next($request);
    }
}