<?php

use App\Models\Owner;
use App\Models\Property;

use function Pest\Laravel\putJson;

describe("Update Property", function () {
    test("must return unauthorized if no token provided", function () {
        $property = Owner::factory()->create();
        putJson(route("property.update", $property->id))
            ->assertStatus(401);
    });

    test("must return forbidden if not the owner", function () {
        $realOwner = Owner::factory()->create();
        $realProperty = Property::factory()->set("owner_id", $realOwner->id)->create();

        $fakeOwner = Owner::factory()->create();
        $fakeOwnerToken = $fakeOwner->createToken("e2e_token")->plainTextToken;

        $headers = ["Authorization" => "Bearer " . $fakeOwnerToken];

        putJson(route("property.update", $realProperty->id), [], $headers)
            ->assertStatus(403);
    });

    test("must be able to update", function () {
        $owner = Owner::factory()->create();
        $ownerToken = $owner->createToken("")->plainTextToken;

        $headers = ["Authorization" => "Bearer " . $ownerToken];

        $data = Property::factory()->set("owner_id", $owner->id)->create();

        putJson(route("property.update", $data->id), $data->toArray(), $headers)
            ->assertOk()
            ->assertJson($data->toArray());
    });
});
