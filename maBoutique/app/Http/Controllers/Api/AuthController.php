<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Utilisateur;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $utilisateur = Utilisateur::where('email', $data['email'])->first();

        if (! $utilisateur || ! Hash::check($data['mot_de_passe'], $utilisateur->mot_de_passe)) {
            Log::channel('auth_api')->warning('api.login.failed', [
                'email' => $data['email'],
                'ip' => $request->ip(),
            ]);

            return ApiResponse::error('Identifiants invalides.', 401);
        }

        $token = $utilisateur->createToken('api_token')->plainTextToken;

        return ApiResponse::json(
            [
                'message' => 'Connexion réussie.',
                'token' => $token,
                'utilisateur' => $utilisateur,
            ],
            200
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return ApiResponse::json(['message' => 'Déconnexion réussie.'], 200);
    }

    public function me(Request $request)
    {
        return ApiResponse::json(
            [
                'message' => 'Profil utilisateur.',
                'utilisateur' => $request->user(),
            ],
            200
        );
    }
}
