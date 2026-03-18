<?php

namespace App\Http\Controllers\Health;

use App\Http\Controllers\Controller;
use App\Services\Health\Checks\DatabaseCheck;
use App\Services\Health\Checks\RedisCheck;
use App\Services\Health\HealthService;
use App\Support\Http\HttpStatus;

class HealthController extends Controller {
    private HealthService $service;

    public function __construct(?HealthService $service = null) {
        $this->service = $service ?? new HealthService([
            new DatabaseCheck(),
            new RedisCheck()
        ]);
    }

    public function getHealth() {
        $result = $this->service->run();

        $statusCode = $result['status'] === 'ok' ? HttpStatus::OK : HttpStatus::INTERNAL_SERVER_ERROR;

        return response()->json($result, $statusCode);
    }
}
