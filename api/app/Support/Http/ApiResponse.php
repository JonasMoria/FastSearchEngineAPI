<?php

namespace App\Support\Http;

use Illuminate\Http\JsonResponse;

class ApiResponse {
    public static function success(
        mixed $data = [],
        string $message = 'Sucesso',
        int $status = HttpStatus::OK
    ): JsonResponse {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function error(
        string $message = 'Erro',
        int $status = HttpStatus::BAD_REQUEST,
        mixed $data = []
    ): JsonResponse {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function validation(
        string $message = 'Erro de validação'
    ): JsonResponse {
        return response()->json([
            'status' => HttpStatus::UNPROCESSABLE_ENTITY,
            'message' => $message,
            'data' => [],
        ], 422);
    }
}