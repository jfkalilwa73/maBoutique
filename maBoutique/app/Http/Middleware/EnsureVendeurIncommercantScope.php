<?php

namespace App\Http\Middleware;

use App\Models\Utilisateur;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureVendeurInCommercantScope
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

        if ($user->role !== 'commercant') {
            return response()->json(['message' => 'Accès interdit.'], 403);
        }

        $idVendeur = $request->input('id_vendeur') ?? $request->route('id_vendeur');

        $vendeur = Utilisateur::with('boutiquesVendeur')->find($idVendeur);

        if (! $vendeur || $vendeur->role !== 'vendeur') {
            return response()->json(['message' => 'Vendeur introuvable.'], 404);
        }

        $idsBoutiquesCommercant = $user->boutiques()->pluck('id_boutique');

        $dansPerimetre = $vendeur->boutiquesVendeur
            ->pluck('id_boutique')
            ->intersect($idsBoutiquesCommercant)
            ->isNotEmpty();

        if (! $dansPerimetre) {
            return response()->json(['message' => 'Ce vendeur est hors de votre périmètre.'], 403);
        }

        return $next($request);
    }
}