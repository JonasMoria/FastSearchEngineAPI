<?php

namespace App\Services\Health;

class HealthService {
    private array $checks;
    public function __construct(iterable $checks) {
        $this->checks = $checks;
    }

    public function run(): array {
        $results = [];
        $allOk = true;

        foreach ($this->checks as $check) {
            $status = $check->check();
            $results[$check->name()] = $status ? 'ok' : 'fail';

            if (!$status) {
                $allOk = false;
            }
        }

        return [
            'status' => $allOk ? 'ok' : 'error',
            'checks' => $results,
        ];
    }
}