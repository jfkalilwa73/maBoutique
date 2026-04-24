<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AffectationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BoutiqueController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\ProduitController;
use App\Http\Controllers\Api\UtilisateurController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');

/*
|--------------------------------------------------------------------------
| Routes protégées
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

        // Gestion complète des utilisateurs côté admin
        Route::apiResource('utilisateurs', UtilisateurController::class)->except(['store']);
    });

    /*
    |--------------------------------------------------------------------------
    | Création de comptes (admin + commercant)
    |--------------------------------------------------------------------------
    | Règle métier:
    | - admin -> peut créer commercant / vendeur
    | - commercant -> peut créer vendeur seulement
    */
    Route::post('/utilisateurs', [UtilisateurController::class, 'store'])
        ->middleware(['role:admin,commercant', 'create.user']);

    /*
    |--------------------------------------------------------------------------
    | Commerçant (et admin si besoin d'intervenir)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,commercant')->group(function () {
        // Catégories
        Route::apiResource('categories', CategorieController::class);

        // Boutiques
        Route::apiResource('boutiques', BoutiqueController::class);

        // Produits
        Route::apiResource('produits', ProduitController::class);

        // Affectations
        Route::post('/affectations/vendeur-boutique', [AffectationController::class, 'affecterVendeurBoutique']);
        Route::post('/affectations/produit-boutique', [AffectationController::class, 'affecterProduitBoutique']);
        Route::post('/affectations/vendeur-produit', [AffectationController::class, 'affecterVendeurProduit']);
    });
});