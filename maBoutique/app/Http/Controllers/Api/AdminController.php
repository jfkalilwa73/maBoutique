<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Boutique;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Utilisateur;
use App\Support\ApiResponse;

class AdminController extends Controller
{
    public function dashboard()
    {
        return ApiResponse::json(
            [
                'message' => 'Indicateurs tableau de bord.',
                'stats' => [
                    'utilisateurs_total' => Utilisateur::count(),
                    'admins_total' => Utilisateur::where('role', 'admin')->count(),
                    'commercants_total' => Utilisateur::where('role', 'commercant')->count(),
                    'vendeurs_total' => Utilisateur::where('role', 'vendeur')->count(),
                    'boutiques_total' => Boutique::count(),
                    'categories_total' => Categorie::count(),
                    'produits_total' => Produit::count(),
                ],
            ],
            200
        );
    }
}