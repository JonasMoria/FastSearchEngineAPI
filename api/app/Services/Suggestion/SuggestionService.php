<?php

namespace App\Services\Suggestion;

use App\Models\Suggestion\Suggestion;

class SuggestionService {
    public function create(array $data): Suggestion {
        return Suggestion::create($data);
    }
}