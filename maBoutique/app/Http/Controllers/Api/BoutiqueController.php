<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoutiqueRequest;
use App\Http\Requests\UpdateBoutiqueRequest;
use App\Models\Boutique;
use App\Services\BoutiqueService;
use App\Support\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class BoutiqueController extends Controller
{
    public function __construct(
        private BoutiqueService $boutiqueService
    ) {
    }

    public function index()
    {
        return ApiResponse::json(
            [
                'message' => 'Liste des boutiques.',
                'data' => Boutique::with(['commercant', 'vendeurs'])->latest()->paginate(15),
            ],
            200
        );
    }

    public function store(StoreBoutiqueRequest $request)
    {
        $data = $request->validated();

        try {
            $boutique = $this->boutiqueService->creerBoutique($request->user(), $data);
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(
            [
                'message' => 'Boutique créée.',
                'boutique' => $boutique,
            ],
            201
        );
    }

    public function show(string $boutique)
    {
        $model = Boutique::with(['commercant', 'vendeurs', 'produits'])->findOrFail($boutique);

        return ApiResponse::json(
            [
                'message' => 'Détail boutique.',
                'boutique' => $model,
            ],
            200
        );
    }

    public function update(UpdateBoutiqueRequest $request, string $boutique)
    {
        $model = Boutique::findOrFail($boutique);
        $data = $request->validated();

        try {
            $model = $this->boutiqueService->modifierBoutique($request->user(), $model, $data);
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(
            [
                'message' => 'Boutique mise à jour.',
                'boutique' => $model,
            ],
            200
        );
    }

    public function destroy(Request $request, string $boutique)
    {
        $model = Boutique::findOrFail($boutique);

        try {
            $this->boutiqueService->supprimerBoutique($request->user(), $model);
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(['message' => 'Boutique supprimée.'], 200);
    }
}
