<?php

use App\Models\Owner;

use function Pest\Laravel\deleteJson;

describe("Delete owner", function () {
    test("must return unauthorized if no token provided", function () {
        $owner = Owner::factory()->create();
        deleteJson(route("owner.delete", $owner->id))
            ->assertStatus(401);
    });

    test("must return forbidden if not the owner", function () {
        $realOwner = Owner::factory()->create();

        $fakeOwner = Owner::factory()->create();
        $fakeOwnerToken = $fakeOwner->createToken("e2e_token")->plainTextToken;

        $headers = ["Authorization" => "Bearer " . $fakeOwnerToken];

        deleteJson(route("owner.delete", $realOwner->id), [], $headers)
            ->assertStatus(403);
    });

    test("must be able to delete", function () {
        $owner = Owner::factory()->create();
        $ownerToken = $owner->createToken("")->plainTextToken;

        $headers = ["Authorization" => "Bearer " . $ownerToken];

        deleteJson(route("owner.update", $owner->id), [], $headers)
            ->assertOk();
    });
});
