<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyStatistics>
 */
class PropertyStatisticsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "impressions" => $this->faker->numberBetween(0, 1500),
            "clicks" => $this->faker->numberBetween(0, 200),
            "property_id" => "1",
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}
