<?php

namespace App\Http\Requests\Property;

use App\Enums\PropertyType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterPropertyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "city" => ["nullable", "max:255"],
            "maxValue" => ["nullable", "integer"],
            "minValue" => ["nullable", "integer"],
            "minFloor" => ["nullable", "integer"],
            "maxFloor" => ["nullable", "integer"],
            "type" => ["nullable", Rule::in(PropertyType::cases())],
            "furnished" => ["nullable", "boolean"],
        ];
    }
}
