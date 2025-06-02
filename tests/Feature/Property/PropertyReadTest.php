<?php

use App\Models\Owner;
use App\Models\Property;

use function Pest\Laravel\getJson;

describe("Property read data", function () {
    test("get all data must return 200", function () {
        Owner::factory(5)->create();
        Property::factory(50)->create();

        getJson(route("property.all"))
            ->assertOk();
    });

    test("get specific property must return it", function () {
        Owner::factory()->create();
        $property = Property::factory()->create();

        getJson(route("property.get", $property->id))
            ->assertOk()
            ->assertJson($property->toArray());
    });
});
