<?php

namespace App\DTO\Owner;

use App\Http\Requests\Owner\StoreOwnerRequest;
use Ramsey\Uuid\Uuid;

class CreateOwnerDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $remember_token
    ) {}

    public static function fromRequest(StoreOwnerRequest $request): self
    {
        return new self($request->name, $request->email, $request->password, Uuid::uuid4()->toString());
    }
}
