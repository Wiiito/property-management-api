<?php

namespace App\DTO\Property;

use App\Enums\PropertyType;
use App\Http\Requests\Property\FilterPropertyRequest;

class FilterPropertyDTO
{
    public function __construct(
        public string | null $city,
        public int | null $maxValue,
        public int | null $minValue,
        public int | null $minFloor,
        public int | null $maxFloor,
        public PropertyType | null $type,
        public bool | null $furnished,
    ) {}

    public static function fromRequest(FilterPropertyRequest $request): self
    {
        return new self(
            $request->city,
            $request->maxValue,
            $request->minValue,
            $request->minFloor,
            $request->maxFloor,
            $request->type ? PropertyType::from($request->type) : null,
            $request->furnished,
        );
    }
}
