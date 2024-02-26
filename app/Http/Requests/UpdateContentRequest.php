<?php

namespace App\Http\Requests;

use App\Enums\Aimed;
use App\Enums\ContentType;
use App\Enums\Cost;
use App\Enums\Duration;
use App\Enums\Target;
use App\Enums\Recurring;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateContentRequest extends FormRequest
{
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'cost' => ['required', new Enum(Cost::class)],
            'type' => ['required', new Enum(ContentType::class)],
            'target' => ['required', new Enum(Target::class)],
            'aimed' => ['required', new Enum(Aimed::class)],
            'title' => ['required', 'string', 'max:255'],
            'price' => ['nullable', 'numeric'],
            'thumbnail' => ['image'],
            'terms' => ['accepted'],
            'subtitle' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required', 'max:10000'],
            'schedule' => ['string', 'nullable', 'max:10000'],
            'goals' => ['array', 'max:5'],
            'goals.*' => ['required'],
            'goals.*.id' => ['exists:results,id'],
            'languages.*' => ['required'],
            'languages.*.id' => ['exists:languages,id'],
            'categories.*' => ['nullable'],
            'categories.*.id' => ['exists:categories,id'],
            'subcategories.*' => ['nullable'],
            'subcategories.*.id' => ['exists:subcategories,id'],
            'learns.*.name' => ['nullable', 'string', 'max:255'],
            'status' => ['boolean'],
        ];

        if ($this->input('type') != ContentType::Course->value) {
            $rules['url'] = ['required', 'string', 'max:255'];
        }

        if ($this->input('type') == ContentType::Course->value) {
            $rules['lessons'] = ['required', 'array', 'max:15'];
            $rules['lessons.*.title'] = ['required', 'string', 'max:255'];
            $rules['lessons.*.subtitle'] = ['required', 'string', 'max:255'];
            $rules['lessons.*.url'] = ['required', 'string', 'max:255'];
        }

        if ($this->input('cost') == Cost::Paid->value) $rules['price'] = ['required', 'numeric'];
        if ($this->input('cost') == Cost::Free->value) unset($rules['price']);

        return $rules;
    }
}
