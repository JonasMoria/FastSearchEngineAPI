<?php

namespace Database\Seeders;

use App\Models\Suggestion\Suggestion;
use Illuminate\Database\Seeder;

class SuggestionSeeder extends Seeder {
    public function run(): void {
        Suggestion::factory()->count(100)->create();
    }
}
