<?php

use App\Jobs\DispatchSuggestionBatchJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Sincroniza registros do Redis
Schedule::job(new DispatchSuggestionBatchJob)->everyMinute();