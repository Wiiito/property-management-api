<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyStatistics;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::factory(50)->create()->each(function ($property) {
            PropertyStatistics::factory()
                ->set("property_id", $property->id)
                ->create();
        });
    }
}
