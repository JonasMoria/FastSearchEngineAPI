<?php

namespace App\Http\Controllers\Suggestion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suggestion\SuggestionStoreRequest;
use App\Models\Suggestion\Suggestion;
use App\Services\Suggestion\SuggestionService;
use App\Support\Http\ApiResponse;
use App\Support\Http\HttpStatus;

class SuggestionController extends Controller {
    private SuggestionService $service;
    public function __construct(?SuggestionService $service = null) {
        $this->service = $service ?? new SuggestionService();
    }

    public function store(SuggestionStoreRequest $request) {
        return $this->service->create($request->validated());
    }

    public function showById(int $id) {
        return $this->service->showById($id);
    }
}
