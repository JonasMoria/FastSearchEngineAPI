<?php

namespace App\Services\Admin;

use App\Models\Suggestion\Suggestion;
use App\Support\Http\ApiResponse;
use App\Support\Http\HttpStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Throwable;

class RedisService {
    public function init(): JsonResponse {
        try {
            $this->flushRedis();

            DB::transaction(function () {
                $this->resetSuggestionsTable();
            });

           $this->createSearchIndexes();

            return ApiResponse::success(
                [],
                'Redis iniciado com sucesso'
            );

        } catch (Throwable $e) {

            Log::error('redis.init.failed', [
                'class' => self::class,
                'exception_class' => get_class($e),
                'exception_message' => $e->getMessage(),
            ]);

            return ApiResponse::error(
                'Não foi possível inicializar o Redis',
                HttpStatus::INTERNAL_SERVER_ERROR
            );
        }
    }

    private function createSearchIndexes(): void {
        $redis = app('redis')->connection()->client();

        try {
            $redis->rawCommand(
                'FT.CREATE',
                'idx:suggestions',
                'ON', 'HASH',
                'PREFIX', '1', 'suggestion:',
                'SCHEMA',
                'primary_name', 'TEXT', 'WEIGHT', '5.0',
                'secondary_name', 'TEXT', 'WEIGHT', '2.0',
                'type', 'TAG',
                'priority', 'NUMERIC', 'SORTABLE'
            );

        } catch (Throwable $e) {
            if (!str_contains($e->getMessage(), 'Index already exists')) {
                throw $e;
            }
        }
    }

    private function resetSuggestionsTable(): void {
        Suggestion::query()->update([
            'cached_at' => null
        ]);
    }

    private function flushRedis(): void {
        Redis::connection()->flushdb();
    }
}