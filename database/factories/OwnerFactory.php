<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Owner>
 */
class OwnerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => Hash::make($this->faker->password),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
