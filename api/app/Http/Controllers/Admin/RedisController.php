<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\RedisService;
use Illuminate\Http\JsonResponse;

class RedisController extends Controller {
    private RedisService $service;
    public function __construct(?RedisService $service = null) {
        $this->service = $service ?? new RedisService();
    }

    public function init(): JsonResponse {
        return $this->service->init();
    }
}
