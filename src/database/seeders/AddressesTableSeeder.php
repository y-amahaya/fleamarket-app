<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressesTableSeeder extends Seeder
{
    public function run(): void
    {
        Address::factory()->count(50)->create();
    }
}
