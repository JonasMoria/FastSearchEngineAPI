<?php

namespace App\Services\Health\Checks;

use App\Services\Health\Contracts\HealthCheckInterface;
use Illuminate\Support\Facades\DB;

class DatabaseCheck implements HealthCheckInterface {
    public function name(): string {
        return 'database';
    }

    public function check(): bool {
        try {
            DB::connection()->getPdo();
            return true;

        } catch (\Throwable $e) {
            return false;
        }
    }
}
