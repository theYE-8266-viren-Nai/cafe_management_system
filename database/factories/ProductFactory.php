<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'category_id' => 1, // Assuming category_id 1 exists
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(640, 480, 'food', true) , // Default image placeholder
            'price' => $this->faker->randomFloat(2, 5, 100),
            'stock' => $this->faker->numberBetween(10, 100),
            'view_count' => $this->faker->numberBetween(0, 500),
        ];
    }
}
