<?php

use App\Http\Controllers\Health\HealthController;
use App\Http\Controllers\Suggestion\SuggestionController;
use Illuminate\Support\Facades\Route;


Route::get('health', [HealthController::class, 'getHealth']);

Route::prefix('suggestions')->group(function() {
    Route::post('/', [SuggestionController::class, 'store']);
    Route::get('/{id}', [SuggestionController::class, 'showById']);
});