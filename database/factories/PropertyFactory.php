<?php

namespace Database\Factories;

use App\Enums\PropertyType;
use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $owners_id = Owner::pluck("id");
        return [
            "title" => $this->faker->sentence,
            "value" => $this->faker->numberBetween(100000, 10000000),
            "city" => $this->faker->city,
            "type" => $this->faker->randomElement(PropertyType::cases())->value,
            "furnished" => $this->faker->boolean,
            "floor" => $this->faker->numberBetween(0, 10),
            "owner_id" => $owners_id->random(),
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}
