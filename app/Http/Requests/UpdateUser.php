<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'country_id' => ['exists:countries,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($this->user->id)],
            'password' => ['string', 'max:255'],
            'status' => ['boolean'],
            'phone' => ['nullable', 'string', 'max:255'],
            'alias' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'twitter' => ['nullable', 'url', 'max:255'],
            'tiktok' => ['nullable', 'url', 'max:255'],
            'site' => ['nullable', 'url', 'max:255'],
            'quote' => ['nullable', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'years_experience' => ['nullable', 'string', 'max:255'],
            'languages.*' => ['required'],
            'languages.*.id' => ['exists:languages,id'],
            'offer' => ['nullable', 'string', 'max:255'],
            'help' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'file', 'image', 'max:3072'],
            'street' => ['nullable', 'string', 'max:255'],
            'number' => ['nullable', 'string', 'max:255'],
            'complement' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'zipcode' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:650'],
            'certificates' => ['nullable'],
            'position' => ['nullable', 'integer', "unique:users,position,{$this->user->id}"],
            'certificates.*' => ['file'],
            'show_certificates' => ['boolean'],
            'role' => ['integer'],
            'google_id' => ['nullable', 'string'],
            'google_token' => ['nullable', 'string'],
            'specialisations.*.name' => ['nullable', 'string', 'max:255'],
            'testimonials.*.name' => ['nullable', 'string', 'max:255'],
            'categories.*' => ['nullable'],
            'categories.*.id' => ['exists:categories,id'],
            'subcategories.*' => ['nullable'],
            'subcategories.*.id' => ['exists:subcategories,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('position')) {
            if ($this->position == 0) {
                $this->merge(['position' => null]);
            }
        }
        if (!$this->filled('password')) {
            $this->merge(['password' => $this->user->password]);
        }
        if (!$this->filled('show_certificates')) {
            $this->merge(['show_certificates' => false]);
        }

        if (!$this->filled('status')) {
            $this->merge(['status' => false]);
        }

        if (!$this->filled('role')) {
            $this->merge(['role' => $this->user->role->value]);
        }
    }
}
