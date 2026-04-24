<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Models\Produit;
use App\Services\ProduitService;
use App\Support\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function __construct(
        private ProduitService $produitService
    ) {
    }

    public function index()
    {
        return ApiResponse::json(
            [
                'message' => 'Liste des produits.',
                'data' => Produit::with(['categorie', 'vendeurs', 'boutiques'])->latest()->paginate(15),
            ],
            200
        );
    }

    public function store(StoreProduitRequest $request)
    {
        $data = $request->validated();

        try {
            $produit = $this->produitService->creerProduit($request->user(), $data);
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(
            [
                'message' => 'Produit créé.',
                'produit' => $produit,
            ],
            201
        );
    }

    public function show(string $produit)
    {
        $model = Produit::with(['categorie', 'vendeurs', 'boutiques'])->findOrFail($produit);

        return ApiResponse::json(
            [
                'message' => 'Détail produit.',
                'produit' => $model,
            ],
            200
        );
    }

    public function update(UpdateProduitRequest $request, string $produit)
    {
        $model = Produit::findOrFail($produit);
        $data = $request->validated();

        try {
            $model = $this->produitService->modifierProduit($request->user(), $model, $data);
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(
            [
                'message' => 'Produit mis à jour.',
                'produit' => $model,
            ],
            200
        );
    }

    public function destroy(Request $request, string $produit)
    {
        $model = Produit::findOrFail($produit);

        try {
            $this->produitService->supprimerProduit($request->user(), $model);
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(['message' => 'Produit supprimé.'], 200);
    }
}
