<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 10),
            'category_id' => rand(1, 5),
            'name' => $this->faker->word(),
            'brand' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'condition' => $this->faker->randomElement(['新品', '未使用に近い', '目立った傷なし', '傷や汚れあり']),
            'price' => $this->faker->numberBetween(100, 10000),
            'image_path' => 'sample.jpg',
            'is_sold' => false,
        ];
    }
}
