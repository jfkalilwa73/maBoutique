<?php

namespace App\Http\Middleware;

use App\Models\Boutique;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureBoutiqueOwner
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

        $idBoutique = $request->route('id') 
            ?? $request->route('boutique') 
            ?? $request->input('id_boutique');

        $boutique = Boutique::find($idBoutique);

        if (! $boutique) {
            return response()->json(['message' => 'Boutique introuvable.'], 404);
        }

        if ($user->role !== 'commercant' || (int) $boutique->id_commercant !== (int) $user->id_utilisateur) {
            return response()->json(['message' => 'Vous ne pouvez pas gérer cette boutique.'], 403);
        }

        return $next($request);
    }
}