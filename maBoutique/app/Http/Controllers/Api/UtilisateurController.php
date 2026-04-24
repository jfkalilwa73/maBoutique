<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUtilisateurRequest;
use App\Http\Requests\UpdateUtilisateurRequest;
use App\Models\Utilisateur;
use App\Services\UtilisateurService;
use App\Support\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    public function __construct(
        private UtilisateurService $utilisateurService
    ) {
    }

    public function index()
    {
        return ApiResponse::json(
            [
                'message' => 'Liste des utilisateurs.',
                'data' => Utilisateur::latest()->paginate(15),
            ],
            200
        );
    }

    public function store(StoreUtilisateurRequest $request)
    {
        $data = $request->validated();

        try {
            $utilisateur = $this->utilisateurService->creerUtilisateur($request->user(), $data);
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(
            [
                'message' => 'Utilisateur créé avec succès.',
                'utilisateur' => $utilisateur,
            ],
            201
        );
    }

    public function show(string $utilisateur)
    {
        $u = Utilisateur::findOrFail($utilisateur);

        return ApiResponse::json(
            [
                'message' => 'Détail utilisateur.',
                'utilisateur' => $u,
            ],
            200
        );
    }

    public function update(UpdateUtilisateurRequest $request, string $utilisateur)
    {
        $model = Utilisateur::findOrFail($utilisateur);
        $data = $request->validated();

        if (isset($data['mot_de_passe'])) {
            $data['mot_de_passe'] = Hash::make($data['mot_de_passe']);
        }

        $model->update($data);

        return ApiResponse::json(
            [
                'message' => 'Utilisateur mis à jour.',
                'utilisateur' => $model->fresh(),
            ],
            200
        );
    }

    public function destroy(string $utilisateur)
    {
        $model = Utilisateur::findOrFail($utilisateur);
        $model->delete();

        return ApiResponse::json(
            [
                'message' => 'Utilisateur supprimé.',
            ],
            200
        );
    }
}
