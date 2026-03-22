<?php

use App\Http\Controllers\Admin\RedisController;
use App\Http\Controllers\Health\HealthController;
use App\Http\Controllers\Suggestion\SuggestionController;
use Illuminate\Support\Facades\Route;

Route::get('health', [HealthController::class, 'getHealth']);

Route::prefix('suggestions')->group(function() {
    Route::post('/', [SuggestionController::class, 'store']);
    Route::get('/search', [SuggestionController::class, 'search']);
    Route::get('/{id}', [SuggestionController::class, 'showById']);
    Route::patch('/{suggestion}', [SuggestionController::class, 'update']);
    Route::delete('/{suggestion}', [SuggestionController::class, 'destroy']);
});

Route::post('/redis/init', [RedisController::class, 'init']);