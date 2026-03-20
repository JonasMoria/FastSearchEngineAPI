<?php

namespace App\Jobs;

use App\Models\Suggestion\Suggestion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Throwable;

class SyncSuggestionToRedisJob implements ShouldQueue {
    use Queueable;
    use Dispatchable;
    use InteractsWithQueue;
    use SerializesModels;

    public int $tries = 5;
    public int $timeout = 30;

    private array $suggestionsIds;

    public function __construct(array $suggestionsIds) {
        $this->suggestionsIds = $suggestionsIds;
    }

    public function handle(): void {
        $suggestions = Suggestion::whereIn('id', $this->suggestionsIds)->get();

        foreach ($suggestions as $suggestion) {
            try {
                $this->putRedisData($suggestion);
                $this->updateCachedAt($suggestion);

            } catch (\Throwable $e) {
                $secondsToWait = 30 * $this->attempts();

                $this->logFailAttemp($suggestion, $e);
                $this->release($secondsToWait);

                return;
            }
        }
    }

    private function updateCachedAt(Suggestion $suggestion): void {
        $suggestion->update([
            'cached_at' => now()
        ]);
    }

    private function putRedisData(Suggestion $suggestion): void {
        $key = "suggestion:{$suggestion->id}";

        $data = [
            'id' => $suggestion->id,
            'primary_name' => $suggestion->primary_name,
            'secondary_name' => $suggestion->secondary_name,
            'type' => $suggestion->type,
            'image_path' => $suggestion->image_path,
            'priority' => $suggestion->priority,
            'metadata' => json_encode($suggestion->metadata),
        ];

        foreach ($data as $field => $value) {
            Redis::hset($key, $field, $value);
        }
    }

    private function logFailAttemp(Suggestion $suggestion, Throwable $e): void {
        Log::error('redis.sync.failed', [
            'job' => self::class,
            'suggestion_id' => $suggestion->id,
            'attempt' => $this->attempts(),
            'max_tries' => $this->tries,
            'exception_class' => get_class($e),
            'exception_message' => $e->getMessage(),
        ]);
    }
}
