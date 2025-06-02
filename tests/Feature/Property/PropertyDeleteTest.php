<?php

use App\Models\Owner;
use App\Models\Property;

use function Pest\Laravel\deleteJson;

describe("Delete Property", function () {
    test("must return unauthorized if no token provided", function () {
        $property = Owner::factory()->create();
        deleteJson(route("property.delete", $property->id))
            ->assertStatus(401);
    });

    test("must return forbidden if not the owner", function () {
        $realOwner = Owner::factory()->create();
        $realProperty = Property::factory()->set("owner_id", $realOwner->id)->create();

        $fakeOwner = Owner::factory()->create();
        $fakeOwnerToken = $fakeOwner->createToken("e2e_token")->plainTextToken;

        $headers = ["Authorization" => "Bearer " . $fakeOwnerToken];

        deleteJson(route("property.delete", $realProperty->id), [], $headers)
            ->assertStatus(403);
    });

    test("must be able to delete", function () {
        $owner = Owner::factory()->create();
        $ownerToken = $owner->createToken("")->plainTextToken;

        $headers = ["Authorization" => "Bearer " . $ownerToken];

        $property = Property::factory()->set("owner_id", $owner->id)->create();

        deleteJson(route("property.delete", $owner->id), [], $headers)
            ->assertOk();
    });
});
