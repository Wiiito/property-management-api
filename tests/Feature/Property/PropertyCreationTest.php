<?php

use App\Models\Owner;
use App\Models\Property;

use function Pest\Laravel\postJson;

describe("Property creation", function () {
    test("empty property create request must have all required attributes", function () {
        $ownerToken = Owner::factory()->create()->createToken("e2e_token")->plainTextToken;

        $headers = ["Authorization" => "Bearer " . $ownerToken];

        postJson(route("property.create"), [], $headers)
            ->assertStatus(422)
            ->assertJsonValidationErrors(["title", "value", "type", "furnished"]);
    });

    test("should not create a property when no token provided", function () {
        postJson(route("property.create"))
            ->assertStatus(401);
    });

    test("should create property when all set", function () {
        $ownerToken = Owner::factory()->create()->createToken("e2e_token")->plainTextToken;

        $headers = ["Authorization" => "Bearer " . $ownerToken];

        $propertyData = Property::factory()->create();

        postJson(route("property.create"), $propertyData->toArray(), $headers)
            ->assertOk()
            ->assertJsonStructure(["id", "title", "value", "type", "furnished", "owner_id"]);
    });
});
