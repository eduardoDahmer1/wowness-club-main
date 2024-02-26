<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'overall' => 'required',
            'practitioner' => 'required',
            'practitioner_knowledge' => 'required',
            'practitioner_communication' => 'required',
            'practitioner_recommend' => 'required',
            'service' => 'required',
            'service_quality' => 'required',
            'service_value' => 'required',
            'service_recommend' => 'required',
            'title' => ['nullable', 'max:255'],
            'description' => ['nullable', 'max:10000'],
            'photo' => 'nullable', 'image', 'max:2048',
        ];
    }
}
