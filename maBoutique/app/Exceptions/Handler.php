<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
        'mot_de_passe',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (AuthenticationException $e, Request $request) {
            if ($this->wantsApiJson($request)) {
                return response()->json([
                    'message' => 'Authentification requise. Fournissez un jeton Bearer valide.',
                ], 401);
            }
        });

        $this->renderable(function (AuthorizationException $e, Request $request) {
            if ($this->wantsApiJson($request)) {
                return response()->json([
                    'message' => $e->getMessage() ?: 'Action non autorisée.',
                ], 403);
            }
        });

        $this->renderable(function (ModelNotFoundException $e, Request $request) {
            if ($this->wantsApiJson($request)) {
                return response()->json([
                    'message' => 'Ressource introuvable.',
                ], 404);
            }
        });

        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($this->wantsApiJson($request)) {
                return response()->json([
                    'message' => 'Route introuvable.',
                ], 404);
            }
        });

        $this->renderable(function (ThrottleRequestsException $e, Request $request) {
            if ($this->wantsApiJson($request)) {
                return response()->json([
                    'message' => 'Trop de requêtes. Réessayez plus tard.',
                ], 429);
            }
        });
    }

    protected function wantsApiJson(Request $request): bool
    {
        return $request->is('api/*') || $request->expectsJson();
    }
}
