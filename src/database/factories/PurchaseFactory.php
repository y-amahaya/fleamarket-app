<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\User;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition(): array
    {
        return [
            'user_id'       => optional(User::inRandomOrder()->first())->id ?? User::factory()->create()->id,
            'product_id'    => optional(Product::inRandomOrder()->first())->id ?? Product::factory()->create()->id,
            'address_id'    => optional(Address::inRandomOrder()->first())->id ?? Address::factory()->create()->id,
            'payment_method'=> $this->faker->randomElement(['credit_card', 'bank_transfer', 'cash_on_delivery']),
            'status'        => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'purchased_at'  => now()->subDays(rand(1, 30)),
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }
}
