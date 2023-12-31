<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Добавьте импорт для класса Str

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
        $name = $this->faker->realText(rand(40, 50));
        return [
            'category_id' => rand(1, 4),
            'brand_id' => rand(1, 4),
            'name' => $name,
            'content' => $this->faker->realText(rand(400, 500)),
            'slug' => Str::slug($name),
            'price' => rand(1000, 2000),
        ];
    }
}
