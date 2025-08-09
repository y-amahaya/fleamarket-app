<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImagesTableSeeder extends Seeder
{
    public function run(): void
    {
        ProductImage::factory()->count(30)->create();
    }
}
