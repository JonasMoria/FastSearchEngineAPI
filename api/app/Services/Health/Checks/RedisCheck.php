<?php

namespace App\Services\Health\Checks;

use App\Services\Health\Contracts\HealthCheckInterface;
use Illuminate\Support\Facades\Redis;

class RedisCheck implements HealthCheckInterface {
    public function name(): string {
        return 'redis';
    }

    public function check(): bool {
        try {
            Redis::ping();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    } 
}