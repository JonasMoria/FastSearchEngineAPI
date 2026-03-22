<?php

namespace App\Services\Suggestion;

use App\Jobs\RemoveSuggestionFromRedisJob;
use App\Models\Suggestion\Suggestion;
use App\Services\Admin\RedisService;
use App\Support\Http\ApiResponse;
use App\Support\Http\HttpStatus;
use Illuminate\Http\Request;
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

    public function update(array $data, Suggestion $suggestion): JsonResponse {
        // Limpa para ser reenviado ao Redis
        $data['cached_at'] = null;

        $suggestion->update($data);
        return ApiResponse::success($suggestion, 'Sugestão atualizada com sucesso!');
    }

    public function destroy(Suggestion $suggestion): JsonResponse {
        $suggestion->delete();

        RemoveSuggestionFromRedisJob::dispatch($suggestion->id);

        return ApiResponse::success([], 'Sugestão removida com sucesso!');
    }

    public function search(Request $request): JsonResponse {
        $query = $this->sanitizeChars(
            $request->input('q')
        );

        if (empty($query)) {
            return ApiResponse::error(
                'Parâmetro q é obrigatório',
                HttpStatus::UNPROCESSABLE_ENTITY
            );
        }

        if (!$this->isMinSizeValid($query)) {
            return ApiResponse::success([]);
        }

        $results = (new RedisService())->search($query);

        return ApiResponse::success(
            $results,
            'Sugestões encontradas com sucesso!'
        );
    }

    private function sanitizeChars(string $query): string {
        return trim(
            mb_strtolower(
                preg_replace('/[^a-zA-Z0-9\s]/', '', $query), 'UTF-8'
            )
        );
    }

    private function isMinSizeValid(string $query): bool {
        return strlen($query) > 3;
    }
} 