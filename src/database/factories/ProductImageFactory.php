<?php

namespace Database\Factories;

use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'image_path' => 'sample.jpg', // サンプル画像
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
