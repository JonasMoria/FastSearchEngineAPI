<?php

use App\Http\Controllers\Health\HealthController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function() {

    Route::get('/health', [HealthController::class, 'getHealth']);

});
