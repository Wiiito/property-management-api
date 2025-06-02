<?php

use App\Models\Owner;

use function Pest\Laravel\getJson;

describe("Owner read data", function () {
    test("owner specific must return a single user", function () {
        $owner = Owner::factory()->create();
        getJson(route("owner.get", 1))
            ->assertOk()->assertJson($owner->toArray());
    });

    test("owner return all must return all users", function () {
        Owner::factory(5)->create();
        getJson(route("owner.all"))
            ->assertOk();
    });
});
