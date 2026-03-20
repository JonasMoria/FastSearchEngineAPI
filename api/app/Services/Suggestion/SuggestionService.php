<?php

namespace App\Services\Suggestion;

use App\Models\Suggestion\Suggestion;
use App\Support\Http\ApiResponse;
use App\Support\Http\HttpStatus;
use Symfony\Component\HttpFoundation\JsonResponse;

class SuggestionService {
    public function create(array $data): JsonResponse {
        $suggestion = Suggestion::create($data);

        return ApiResponse::success(
            $suggestion,
            'Sugestão cadastrada com sucesso',
            HttpStatus::CREATED
        );
    }

    public function showById(int $id): JsonResponse {
        $suggestion = Suggestion::find($id);

        if (empty($suggestion)) {
            return ApiResponse::error('Sugestão não encontrada', HttpStatus::NOT_FOUND);
        }

        return ApiResponse::success(
            $suggestion,
            'Sugestão encontrada com sucesso'
        );
    }
} 