<?php

use App\Models\Owner;

use function Pest\Laravel\postJson;

describe("Token validation", function () {
    test("must generate a valid token", function () {
        $owner = Owner::factory()->defaultPassword()->create();
        $data = ["email" => $owner->email, "password" => "password", "deviceName" => "e2e_device"];
        postJson(route("owner.token", $data))
            ->assertOk()
            ->assertJsonStructure(["token"]);
    });

    test("must return error if no data received", function () {
        postJson(route("owner.token"))
            ->assertStatus(422)
            ->assertJsonValidationErrors(["email", "password", "deviceName"]);
    });

    test("must return error if wrong password", function () {
        $owner = Owner::factory()->defaultPassword()->create();
        $data = ["email" => $owner->email, "password" => "invalidPassword", "deviceName" => "e2e_device"];
        postJson(route("owner.token", $data))
            ->assertStatus(401)
            ->assertJsonValidationErrors(["email", "password"]);
    });

    test("must return error if email not signed-in", function () {
        $data = ["email" => "invalidEmail@mail.com", "password" => "password", "deviceName" => "e2e_device"];
        postJson(route("owner.token", $data))
            ->assertStatus(401)
            ->assertJsonValidationErrors(["email", "password"]);
    });
});
