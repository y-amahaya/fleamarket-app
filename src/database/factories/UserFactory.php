<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password123'), // 本番用はseederでenv管理も考慮
            'profile_image' => 'default.jpg',
            'postal_code' => $this->faker->postcode(),
            'address' => $this->faker->address(),
            'tel' => $this->faker->phoneNumber(),
            'remember_token' => Str::random(10),
        ];
    }
}
