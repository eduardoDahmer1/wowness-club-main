<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon' => ['required', 'image', 'max:3072'],
            'subcategories.*.name' => ['nullable', 'string', 'max:255'],
            'subcategories.*.description' => ['nullable', 'string'],
            'subcategories.*.icon' => ['nullable', 'image', 'max:3072'],
        ];
    }
}
