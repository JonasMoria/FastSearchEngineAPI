<?php

namespace App\Http\Controllers\Suggestion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suggestion\SuggestionStoreRequest;
use App\Http\Requests\Suggestion\SuggestionUpdateRequest;
use App\Models\Suggestion\Suggestion;
use App\Services\Suggestion\SuggestionService;
use Symfony\Component\HttpFoundation\JsonResponse;

class SuggestionController extends Controller {
    private SuggestionService $service;
    public function __construct(?SuggestionService $service = null) {
        $this->service = $service ?? new SuggestionService();
    }

    public function store(SuggestionStoreRequest $request): JsonResponse {
        return $this->service->create($request->validated());
    }

    public function showById(int $id): JsonResponse {
        return $this->service->showById($id);
    }

    public function update(SuggestionUpdateRequest $request, Suggestion $suggestion): JsonResponse {
        return  $this->service->update($request->validated(), $suggestion);
    }
}
