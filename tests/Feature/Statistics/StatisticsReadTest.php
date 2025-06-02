<?php

use App\Models\Owner;
use App\Models\Property;
use App\Models\PropertyStatistics;

use function Pest\Laravel\getJson;

describe("Statistics read data", function () {
    test("get all data must return 200 if logged in", function () {
        $owner = Owner::factory()->create();
        $ownerToken = $owner->createToken("")->plainTextToken;

        $headers = ["Authorization" => "Bearer " . $ownerToken];

        getJson(route("property.statistics.all"), $headers)
            ->assertOk();
    });

    test("get specific property statistics must return it", function () {
        $owner = Owner::factory()->create();
        $ownerToken = $owner->createToken("")->plainTextToken;

        $headers = ["Authorization" => "Bearer " . $ownerToken];


        $property = Property::factory()->create();
        $propertyStatistics = PropertyStatistics::factory()->create();

        getJson(route("property.statistics.get", $property->id), $headers)
            ->assertOk()
            ->assertJson($propertyStatistics->toArray());
    });

    test("if no token provided on all route must return an error", function () {
        getJson(route("property.statistics.all"))
            ->assertStatus(401);
    });

    test("if no token provided on specific route must return an error", function () {
        Owner::factory()->create();
        Property::factory()->create();
        $propertyStatistics = PropertyStatistics::factory()->create();

        getJson(route("property.statistics.get", $propertyStatistics->id))
            ->assertStatus(401);
    });
});
