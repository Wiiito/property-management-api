<?php

namespace App\DTO\Property;

use App\Enums\PropertyType;
use App\Http\Requests\Property\UpdatePropertyRequest;

class UpdatePropertyDTO
{
    public function __construct(
        public string | null $id,
        public string | null $title,
        public int | null $value,
        public PropertyType | null $type,
        public bool | null $furnished,
        public int | null $floor,
        public string | null $owner_id,
    ) {}

    public static function fromRequest(UpdatePropertyRequest $request, string $id): self
    {
        return new self(
            $id,
            $request->title,
            $request->value,
            $request->type ? PropertyType::from($request->type) : null,
            $request->furnished,
            $request->floor,
            $request->user()->id
        );
    }
}
