<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOwnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['email', 'required', 'max:255', 'unique:owners'],
            'password' => ['string', 'required', 'max:255'],
        ];
    }
}
