<?php

namespace App\Http\Requests;

use App\Enums\Aimed;
use App\Enums\Duration;
use App\Enums\Method;
use App\Enums\Target;
use App\Enums\Type;
use App\Enums\Recurring;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $recurringRule = $this->input('recurring') == 6 || $this->input('type') == 2 ? 'nullable' : 'required';
        $individualRule = $this->input('type') == 2 ? 'nullable' : 'required';

        return [
            'method' => ['required', new Enum(Method::class)],
            'type' => ['required', new Enum(Type::class)],
            'target' => ['required', new Enum(Target::class)],
            'aimed' => ['required', new Enum(Aimed::class)],
            'recurring' => [$individualRule, new Enum(Recurring::class)],
            'uses' => ['required', 'numeric'],
            'terms' => ['accepted'],
            'group_size' => ['nullable', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'complement' => ['nullable', 'string', 'max:255'],
            'number'=>['nullable', 'numeric'],
            'state' => ['nullable', 'string', 'max:255'],
            'zipcode' => ['nullable', 'string', 'max:255'],
            'disclaimer' => ['nullable', 'string', 'max:10000'],
            'photo' => ['image'],
            'start' => [$recurringRule, 'date'],
            'end' => [$recurringRule, 'date'],
            'start_date.*' => ['date', 'nullable'],
            'end_date.*' => ['date', 'nullable'],
            'recurrencesId' => 'nullable',
            'country_id' => [ 'nullable', 'exists:countries,id'],
            'timezone_id' => ['exists:timezones,id'],
            'description' => ['string', 'nullable', 'max:10000'],
            'highlights' => ['string', 'nullable', 'max:10000'],
            'benefits' => ['string', 'nullable', 'max:10000'],
            'transport' => ['string', 'nullable', 'max:10000'],
            'included' => ['string', 'nullable', 'max:10000'],
            'not_included' => ['string', 'nullable', 'max:10000'],
            'directions' => ['string', 'nullable', 'max:10000'],
            'next_steps' => ['string', 'nullable', 'max:10000'],
            'schedule' => ['string', 'nullable', 'max:10000'],
            'videos.*.link' => ['nullable', 'url', 'max:255'],
            'extras.*.name' => ['nullable', 'string', 'max:255'],
            'extras.*.price' => ['nullable', 'numeric'],
            'menus.*.name' => ['nullable', 'string', 'max:255'],
            'results' => ['array', 'max:5'],
            'results.*' => ['nullable'],
            'results.*.id' => ['exists:results,id'],
            'meals.*' => ['nullable'],
            'meals.*.id' => ['exists:meals,id'],
            'amenities.*' => ['nullable'],
            'amenities.*.id' => ['exists:amenities,id'],
            'languages.*' => ['nullable'],
            'languages.*.id' => ['exists:languages,id'],
            'galleries' => ['nullable', 'max:15'],
            'galleries.*' => ['image', 'max:3072'],
            'categories.*' => ['nullable'],
            'categories.*.id' => ['exists:categories,id'],
            'subcategories.*' => ['nullable'],
            'subcategories.*.id' => ['exists:subcategories,id'],
            'packages.*.name' => ['nullable', 'string', 'max:255'],
            'packages.*.price' => ['nullable', 'numeric', 'min:1'],
            'packages.*.quantity' => ['nullable', 'integer', 'min:0'],
            'packages.*.description' => ['nullable', 'string', 'max:200'],
            'packages.*.id' => ['exists:packages,id'],
            'packages.*.duration_type' => ['required', new Enum(Duration::class)],
            'packages.*.duration' => ['required', 'integer'],
            'packages_galleries.*' => ['nullable', 'max:15'],
            'packages_galleries.*.*' => ['image', 'max:3072'],
            'status' => ['boolean'],
            'policy' => ['required', 'string', 'max:10000'],
            'weekday.*' => 'nullable',
            'end_repeat' => 'boolean',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'uses' => collect($this->packages)->sum('quantity'),
        ]);
    }
}
