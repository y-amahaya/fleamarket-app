<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Like;
use App\Models\User;
use App\Models\Product;

class LikesTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();

        $combinations = collect($users)
            ->crossJoin($products)
            ->shuffle()
            ->take(50);

        foreach ($combinations as [$userId, $productId]) {
            Like::create([
                'user_id'    => $userId,
                'product_id' => $productId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}