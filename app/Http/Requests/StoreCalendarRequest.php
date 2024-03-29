<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalendarRequest extends FormRequest
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
            "title" => "required",
            "color" => "required",  
            "start" => "required",
            "end" => "required",
            "resourceId" => 'nullable',
            "service_id" => "required",
            "recurrence_type" => "required",
        ];
    }
}
