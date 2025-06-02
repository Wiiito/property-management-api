<?php

use App\Models\Owner;
use function Pest\Laravel\postJson;

describe("Owner creation", function () {
    test("empty owner create request must return unprocessable content", function () {
        postJson(route("owner.create"))
            ->assertStatus(422)
            ->assertJsonValidationErrors(["name", "email", "password"]);
    });

    test("owner create must create a valid user", function () {
        $data = ["name" => "Nome", "email" => "valid@mail.com", "password" => "password"];
        postJson(route("owner.create"), $data)
            ->assertOk()
            ->assertJsonStructure(["name", "email", "updated_at", "created_at", "id"]);
    });

    test("new owner email cannot be equal to an existing owner email", function () {
        $owner = Owner::factory()->create();
        $data = ["name" => "Nome", "email" => $owner->data, "password" => "password"];
        postJson(route("owner.create"), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors(["email"]);
    });
});
