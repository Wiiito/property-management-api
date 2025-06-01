<?php

namespace App\Http\Requests\Property;

use App\Enums\PropertyType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePropertyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'value' => ['required', 'integer'],
            'type' => ['required', Rule::in(PropertyType::cases())],
            'furnished' => ['required', 'boolean'],
            'floor' => ['nullable', 'integer'],
        ];
    }
}
