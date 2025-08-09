<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'user_id' => optional(User::inRandomOrder()->first())->id ?? User::factory()->create()->id,
            'postal_code'   => $this->faker->postcode,
            'prefecture'   => $this->faker->state(),
            'city'         => $this->faker->city(),
            'address_line'  => $this->faker->streetAddress,
            'building'      => $this->faker->secondaryAddress,
            'phone_number'  => $this->faker->phoneNumber,
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }
}
