<?php

namespace App\DTO\Owner;

use App\Http\Requests\Owner\LoginOwnerRequest;

class LoginOwnerDTO
{
    public function __construct(
        public string $email,
        public string $password,
        public string $deviceName
    ) {}

    public static function fromRequest(LoginOwnerRequest $request): self
    {
        return new self($request->email, $request->password, $request->deviceName);
    }
}
