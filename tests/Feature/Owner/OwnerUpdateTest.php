<?php

use App\Models\Owner;

use function Pest\Laravel\putJson;

describe("Update owner", function () {
    test("must return unauthorized if no token provided", function () {
        $owner = Owner::factory()->create();
        putJson(route("owner.update", $owner->id))
            ->assertStatus(401);
    });

    test("must return forbidden if not the owner", function () {
        $realOwner = Owner::factory()->create();

        $fakeOwner = Owner::factory()->create();
        $fakeOwnerToken = $fakeOwner->createToken("e2e_token")->plainTextToken;

        $headers = ["Authorization" => "Bearer " . $fakeOwnerToken];

        putJson(route("owner.update", $realOwner->id), [], $headers)
            ->assertStatus(403);
    });

    test("must be able to update", function () {
        $owner = Owner::factory()->create();
        $ownerToken = $owner->createToken("")->plainTextToken;

        $headers = ["Authorization" => "Bearer " . $ownerToken];

        $data = ["name" => "updatedName", "email" => "updatedMail@mail.com"];

        putJson(route("owner.update", $owner->id), $data, $headers)
            ->assertOk()
            ->assertJson($data);
    });
});
