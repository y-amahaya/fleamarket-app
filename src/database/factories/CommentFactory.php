<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'user_id'    => User::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'comment'    => $this->faker->realText(100), // 100文字程度のテキスト
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
