<?php

use App\Models\Owner;

use function Pest\Laravel\getJson;

describe("Owner email validation", function () {
    test("email validated succeffully", function () {
        $owner = Owner::factory()->create();

        getJson(route("owner.validateMail", $owner->remember_token))
            ->assertOk();
    });

    test("invalid email validation must be invalid", function () {
        getJson(route("owner.validateMail", "fakeUUID"))
            ->assertStatus(400);
    });
});
