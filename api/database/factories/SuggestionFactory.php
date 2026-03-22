<?php

namespace Database\Factories;

use App\Models\Suggestion\Suggestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuggestionFactory extends Factory {
    protected $model = Suggestion::class;

    public function definition(): array {
        $products = $this->makeProductsArray();
        $brands = $this->makeBrands();
        $categories = $this->makeCategories();

        return [
            'primary_name' => $this->faker->randomElement($products),
            'secondary_name' => $this->faker->randomElement($brands),
            'image_path' => $this->faker->imageUrl(400, 400, 'tech'),
            'priority' => $this->faker->numberBetween(1, 10),
            'type' => 'product',
            'metadata' => [
                'brand' => $this->faker->randomElement($brands),
                'category' => $this->faker->randomElement($categories),
                'rating' => $this->faker->randomFloat(1, 3, 5),
            ],
        ];
    }

    private function makeProductsArray(): array {
        return [
            'iPhone 15', 'iPhone 14', 'iPhone 13',
            'Galaxy S23', 'Galaxy S22',
            'Moto G84', 'Moto G73',
            'MacBook Pro', 'MacBook Air',
            'Dell XPS 13', 'Inspiron 15',
            'PlayStation 5', 'Xbox Series X',
            'AirPods Pro', 'Galaxy Buds',
            'iPad Pro', 'iPad Air'
        ];
    }

    private function makeBrands(): array {
        return [
            'Apple',
            'Samsung',
            'Motorola',
            'Dell',
            'Sony',
            'Microsoft'
        ];
    }

    private function makeCategories(): array {
        return [
            'Smartphone',
            'Notebook',
            'Console',
            'Audio',
            'Tablet'
        ];
    }
}
