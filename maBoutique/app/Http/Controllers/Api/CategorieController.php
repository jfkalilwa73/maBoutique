<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;
use App\Services\CategorieService;
use App\Support\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function __construct(
        private CategorieService $categorieService
    ) {
    }

    public function index()
    {
        return ApiResponse::json(
            [
                'message' => 'Liste des catégories.',
                'data' => Categorie::latest()->paginate(15),
            ],
            200
        );
    }

    public function store(StoreCategorieRequest $request)
    {
        $data = $request->validated();

        try {
            $categorie = $this->categorieService->creerCategorie($request->user(), $data);
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(
            [
                'message' => 'Catégorie créée.',
                'categorie' => $categorie,
            ],
            201
        );
    }

    public function show(string $category)
    {
        $model = Categorie::findOrFail($category);

        return ApiResponse::json(
            [
                'message' => 'Détail catégorie.',
                'categorie' => $model,
            ],
            200
        );
    }

    public function update(UpdateCategorieRequest $request, string $category)
    {
        $model = Categorie::findOrFail($category);
        $data = $request->validated();

        try {
            $model = $this->categorieService->modifierCategorie($request->user(), $model, $data);
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(
            [
                'message' => 'Catégorie mise à jour.',
                'categorie' => $model,
            ],
            200
        );
    }

    public function destroy(Request $request, string $category)
    {
        $model = Categorie::findOrFail($category);

        try {
            $this->categorieService->supprimerCategorie($request->user(), $model);
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(['message' => 'Catégorie supprimée.'], 200);
    }
}
