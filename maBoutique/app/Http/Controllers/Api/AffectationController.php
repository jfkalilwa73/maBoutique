<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AffectationProduitBoutiqueRequest;
use App\Http\Requests\AffectationVendeurBoutiqueRequest;
use App\Http\Requests\AffectationVendeurProduitRequest;
use App\Services\AffectationService;
use App\Support\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class AffectationController extends Controller
{
    public function __construct(
        private AffectationService $affectationService
    ) {
    }

    public function affecterVendeurBoutique(AffectationVendeurBoutiqueRequest $request)
    {
        $data = $request->validated();

        try {
            $this->affectationService->affecterVendeurABoutique(
                $request->user(),
                (int) $data['id_boutique'],
                (int) $data['id_vendeur']
            );
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(['message' => 'Vendeur affecté à la boutique.'], 200);
    }

    public function affecterProduitBoutique(AffectationProduitBoutiqueRequest $request)
    {
        $data = $request->validated();

        try {
            $this->affectationService->affecterProduitABoutique(
                $request->user(),
                (int) $data['id_boutique'],
                (int) $data['id_produit']
            );
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(['message' => 'Produit affecté à la boutique.'], 200);
    }

    public function affecterVendeurProduit(AffectationVendeurProduitRequest $request)
    {
        $data = $request->validated();

        try {
            $this->affectationService->affecterVendeurAProduit(
                $request->user(),
                (int) $data['id_produit'],
                (int) $data['id_vendeur']
            );
        } catch (AuthorizationException $e) {
            return ApiResponse::error($e->getMessage(), 403);
        }

        return ApiResponse::json(['message' => 'Vendeur affecté au produit.'], 200);
    }
}
