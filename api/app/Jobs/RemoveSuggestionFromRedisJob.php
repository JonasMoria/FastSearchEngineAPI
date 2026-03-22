<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class RemoveSuggestionFromRedisJob implements ShouldQueue {
    use Dispatchable;
    use Queueable;
    use SerializesModels;

    private int $id;
    public function __construct(int $id) {
        $this->id = $id;
    }

    public function handle(): void {
        Redis::del("suggestion:{$this->id}");
    }
}
