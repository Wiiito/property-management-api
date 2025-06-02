<?php

namespace App\Http\Requests\Property;

use App\Enums\PropertyType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePropertyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'value' => ['nullable', 'integer'],
            'type' => ['nullable', Rule::in(PropertyType::cases())],
            'furnished' => ['nullable', 'boolean'],
            'floor' => ['nullable', 'integer'],
        ];
    }
}
