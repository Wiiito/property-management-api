<?php

namespace App\DTO\Owner;

use App\Http\Requests\Owner\StoreOwnerRequest;

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
