<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;

class PurchasesTableSeeder extends Seeder
{
    public function run(): void
    {
        Purchase::factory()->count(50)->create();
    }
}
