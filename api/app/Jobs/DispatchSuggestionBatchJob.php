<?php

namespace App\Jobs;

use App\Models\Suggestion\Suggestion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

class DispatchSuggestionBatchJob implements ShouldQueue {
    use Queueable;
    use Dispatchable;
    use SerializesModels;

    public function handle(): void {
        Suggestion::whereNull('cached_at')
            ->limit(1000)
            ->get(['id'])
            ->pluck('id')
            ->chunk(100)
            ->each(function ($chunk) {
                SyncSuggestionToRedisJob::dispatch($chunk->toArray());
            });
    }
}
