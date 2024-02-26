<?php

namespace App\Observers;

use App\Enums\Recurring;
use App\Models\Calendar;
use App\Models\Recurrence;

class RecurrenceObserver
{
    /**
     * Handle the Recurrence "created" event.
     *
     * @param  \App\Models\Recurrence  $recurrence
     * @return void
     */
    public function created(Recurrence $recurrence)
    {
        $calendar = Calendar::create([
            'service_id' => $recurrence->service_id,
            'title' => $recurrence->service->name,
            'start' => $recurrence->start_date,
            'end' => $recurrence->end_date,
            'color' => '#7B9A6C',
            'resourceId' => 'a',
            'recurrence_type' => Recurring::from($recurrence->service->recurring)->name(),
            'recurrence_id' => $recurrence->id,
            'altered' => $recurrence->altered ? $recurrence->altered : false,
        ]);
        $calendar->save();
    }

    /**
     * Handle the Recurrence "updated" event.
     *
     * @param  \App\Models\Recurrence  $recurrence
     * @return void
     */
    public function updated(Recurrence $recurrence)
    {
        Calendar::where('recurrence_id', $recurrence->id)->update([
            'start' => $recurrence->start_date,
            'end' => $recurrence->end_date,
            'recurrence_type' => Recurring::from($recurrence->service->recurring)->name(),
            'color' => '#7B9A6C',
        ]);
    }

    public function deleted(Recurrence $recurrence)
    {
        Calendar::where('recurrence_id', $recurrence->id)->delete();
    }
}
