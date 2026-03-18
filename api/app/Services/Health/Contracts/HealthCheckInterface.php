<?php

namespace App\Services\Health\Contracts;

interface HealthCheckInterface {
    public function name(): string;
    public function check(): bool;
}
