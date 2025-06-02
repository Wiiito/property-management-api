<?php

namespace App\DTO\Property;

use App\Enums\PropertyType;
use App\Http\Requests\Property\CreatePropertyRequest;

class CreatePropertyDTO
{
    public function __construct(
        public string $title,
        public int $value,
        public string $city,
        public PropertyType $type,
        public bool $furnished,
        public int $floor,
        public string $owner_id,
    ) {}

    public static function fromRequest(CreatePropertyRequest $request): self
    {
        return new self(
            $request->title,
            $request->value,
            $request->city,
            PropertyType::from($request->type),
            $request->furnished,
            $request->floor ?? 0,
            $request->user()->id
        );
    }
}
