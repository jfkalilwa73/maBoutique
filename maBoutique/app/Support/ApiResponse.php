<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function json(array $payload, int $status = 200): JsonResponse
    {
        return response()->json($payload, $status);
    }

    public static function error(string $message, int $status = 400, ?array $errors = null): JsonResponse
    {
        $data = ['message' => $message];
        if ($errors !== null) {
            $data['errors'] = $errors;
        }

        return response()->json($data, $status);
    }
}
