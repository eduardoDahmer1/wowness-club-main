<?php

namespace App\Http\Requests;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreFacilitatorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'country_id' => ['required','exists:countries,id'],
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
            'quote' => ['nullable', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'file', 'image', 'max:3072'],
            'street' => ['nullable', 'string', 'max:255'],
            'number' => ['nullable', 'string', 'max:255'],
            'complement' => ['nullable', 'string', 'max:255'],
            'city' => ['required','nullable', 'string', 'max:255'],
            'zipcode' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:650'],
            'certificates' => ['nullable'],
            'certificates.*' => ['file'],
            'terms' => 'required',
            'google_id' => ['nullable', 'string'],
            'google_token' => ['nullable', 'string'],
            'site' => ['nullable', 'url', 'max:255'],
            'offer' => ['nullable', 'string', 'max:255'],
            'help' => ['nullable', 'string', 'max:255'],
            'years_experience' => ['nullable', 'string', 'max:255'],
            'languages.*' => ['required'],
            'languages.*.id' => ['exists:languages,id'],
            'specialisations.*.name' => ['nullable', 'string', 'max:255'],
            'testimonials.*.name' => ['nullable', 'string', 'max:255'],
            'categories.*' => ['nullable'],
            'categories.*.id' => ['exists:categories,id'],
            'subcategories.*' => ['nullable'],
            'subcategories.*.id' => ['exists:subcategories,id'],
            'selected_plan' => ['nullable', 'string', 'max:255']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['role' => Role::ServiceProvider->value]);
    }
}
