<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Page not Found';
});

Route::get('/docs/api.yaml', function () {
     return response()->file(resource_path('docs/api.yaml'));
});

Route::get('/docs', function () {
    return view('swagger');
});