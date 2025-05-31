<?php

namespace App\DTO;

use App\Http\Requests\StoreOwnerRequest;

class CreateOwnerDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {}

    public static function fromRequest(StoreOwnerRequest $request): self
    {
        return new self($request->name, $request->email, $request->password);
    }
}
