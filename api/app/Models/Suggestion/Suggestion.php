<?php

namespace App\Models\Suggestion;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model {
    protected $fillable = [
        'primary_name',
        'secondary_name',
        'image_path',
        'cached_at',
        'priority',
        'type',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'cached_at' => 'datetime',
    ];
}
