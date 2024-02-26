<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCalendarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id" => "nullable",
            "title" => "required",
            "color" => "required",  
            "start" => "required",
            "end" => "required",
            "resourceId" => 'nullable',
            "service_id" => "required",
            'recurring' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'end_repeat' => 'boolean',
            'weekday.*' => 'nullable',
            "recurrence_type" => "nullable",
        ];
    }
}
