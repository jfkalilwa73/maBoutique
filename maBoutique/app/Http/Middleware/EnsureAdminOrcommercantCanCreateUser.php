<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminOrCommercantCanCreateUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $acteur = $request->user();

        if (! $acteur) {
            return response()->json(['message' => 'Non authentifié.'], 401);
        }

        $roleCible = $request->input('role');

        if (! $roleCible) {
            return response()->json(['message' => 'Le rôle cible est obligatoire.'], 422);
        }

        if ($acteur->role === 'admin' && in_array($roleCible, ['commercant', 'vendeur'], true)) {
            return $next($request);
        }

        if ($acteur->role === 'commercant' && $roleCible === 'vendeur') {
            return $next($request);
        }

        return response()->json(['message' => 'Vous ne pouvez pas créer ce type de compte.'], 403);
    }
}