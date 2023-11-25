<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $product_name = $this->faker->unique()->words($nb = 6, $asText = true);
        $slug = Str::slug($product_name, '-');
        return [
            'name' => $product_name,
            'slug' => $slug,
            'short_description' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'SKU' => 'PRD' . $this->faker->unique()->numberBetween(10, 500),
            'stock_status' => 'in_stock',
            'quantity' => $this->faker->numberBetween(10, 50),
            'category_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
