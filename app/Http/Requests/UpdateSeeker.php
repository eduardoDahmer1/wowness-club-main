<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSeeker extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'country_id' => ['exists:countries,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', "unique:users,email,{$this->user->id}"],
            'password' => ['string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'alias' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'file', 'image', 'max:3072'],
            'street' => ['nullable', 'string', 'max:255'],
            'number' => ['nullable', 'string', 'max:255'],
            'complement' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'zipcode' => ['nullable', 'string', 'max:255'],
            'role' => ['integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->filled('password')) {
            $this->merge(['password' => $this->user->password]);
        }

        if (!$this->filled('role')) {
            $this->merge(['role' => $this->user->role->value]);
        }
    }
}
