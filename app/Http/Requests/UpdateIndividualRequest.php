<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIndividualRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'start' => 'nullable',
            'end' => 'nullable',
            "start_time.*" => 'nullable',
            "end_time.*" => 'nullable',
            "weekday.*" => 'nullable',
            "before" => 'nullable',
            "after" => 'nullable',
            "when_time_before" => 'nullable',
            "when_time_after" => 'nullable',
            "selectBefore" => 'nullable',
            "selectAfter" => 'nullable',
            "occurrence_type" => 'nullable',
        ];
    }
}
