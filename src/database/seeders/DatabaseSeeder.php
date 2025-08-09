<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            ProductImagesTableSeeder::class,
            CommentsTableSeeder::class,
            LikesTableSeeder::class,
            PurchasesTableSeeder::class,
            AddressesTableSeeder::class,
        ]);
    }
}
