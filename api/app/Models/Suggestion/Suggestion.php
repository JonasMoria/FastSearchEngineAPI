<?php

namespace App\Models\Suggestion;

use Database\Factories\SuggestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model {
    use HasFactory;

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

    protected static function newFactory() {
        return SuggestionFactory::new();
    }
}
