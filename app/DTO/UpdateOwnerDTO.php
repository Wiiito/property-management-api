<?php

namespace App\DTO;

use App\Http\Requests\UpdateOwnerRequest;

class UpdateOwnerDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public string | null $password,
    ) {}

    public static function fromRequest(UpdateOwnerRequest $request, string $id): self
    {
        return new self($id, $request->name, $request->email, $request->password);
    }
}
