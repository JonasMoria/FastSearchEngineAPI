<?php

namespace App\Services\Suggestion;

use App\Models\Suggestion\Suggestion;

class SuggestionService {
    public function create(array $data): Suggestion {
        $suggestion = Suggestion::create($data);
        return $suggestion;
    }
} 