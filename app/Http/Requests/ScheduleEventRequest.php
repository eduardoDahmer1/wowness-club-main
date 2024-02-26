<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleEventRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'occurrenceId' => 'required|string',
            'eventId' => 'required|integer',
            'title' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'description' => 'nullable|string',
            'recurrence' => 'in:DAILY,WEEKLY,MONTHLY,YEARLY',
        ];
    }
}
