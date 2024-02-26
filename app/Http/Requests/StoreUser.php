<?php

namespace App\Http\Requests;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreUser extends FormRequest
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
            'role' => ['nullable', new Enum(Role::class)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['string', 'max:255', 'required'],
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
            'position' => ['nullable', 'integer', $this->uniquePosition()],
            'certificates.*' => ['file'],
            'show_certificates' => ['boolean'],
            'google_id' => ['nullable', 'string'],
            'google_token' => ['nullable', 'string'],
            'specialisations.*.name' => ['nullable', 'string', 'max:255'],
            'testimonials.*.name' => ['nullable', 'string', 'max:255'],
            'categories.*' => ['nullable'],
            'categories.*.id' => ['exists:categories,id'],
            'subcategories.*' => ['nullable'],
            'subcategories.*.id' => ['exists:subcategories,id']
        ];
    }

    protected function uniquePosition()
    {
        return Rule::unique('users')->where(function ($query) {
            return $query->whereNull('deleted_at');
        });
    }

    protected function prepareForValidation()
    {
        if ($this->filled('position')) {
            if ($this->position == 0) {
                $this->merge(['position' => null]);
            }
        }

        $this->merge(['role' => Role::ServiceProvider->value]);

        if (!$this->filled('show_certificates')) {
            $this->merge(['show_certificates' => false]);
        }
    }

}
