<?php

namespace App\Http\Services;

use App\Models\Calendar;
use RRule\RRule;

class EventService
{
    private RecurrenceService $recurrenceService;

    public function __construct(RecurrenceService $recurrenceService)
    {
        $this->recurrenceService = $recurrenceService;
    }

    public function getOccurrences($events, $packageId): array
    {
        $allRecurringEvents = [];

        foreach ($events as $event) {
            $allRecurringEvents = $this->getRecurringEventsForEvent($event, $packageId);
        }
        return $allRecurringEvents;
    }

    private function getRecurringEventsForEvent($event, $packageId): array
    {
        $recurrence = $event->recurrence_type;
        return match ($recurrence) {
            'DAILY'         => $this->recurrenceService->basic($event, RRule::DAILY),
            'WEEKLY'        => $this->recurrenceService->basic($event, RRule::WEEKLY),
            'MONTHLY'       => $this->recurrenceService->basic($event, RRule::MONTHLY),
            'YEARLY'        => $this->recurrenceService->basic($event, RRule::YEARLY),
            'DAILY_24H'     => $this->recurrenceService->hourlyFor24Occurrences($event),
            'TEST' => $this->recurrenceService->allDayHourlyOccurrences($event, $packageId),
            'Every week' => $this->recurrenceService->dailyHourlyOccurrences4($event, $packageId),
            default => [],
        };
    }

    public function getOccurrencesIndividuals($packageId): array
    {
        $event = Calendar::where('grouped', true)->first();

        $allRecurringEvents = $this->getRecurringEventsForEvent($event, $packageId);
        return $allRecurringEvents;
    }

    public function createCalendar($service)
    {
        $calendar = Calendar::where('service_id', $service->id)->where('grouped', true)->first();
        if ($calendar) {
            $calendar->delete();
        }
        $calendars = Calendar::where('service_id', $service->id)->get();
        $calendarIndividual = [];
        $calendarIndividual = [
            "title" => $calendars[0]->title,
            "start" =>  min($calendars->pluck('start')->toArray()),
            "end" => max($calendars->pluck('end')->toArray()),
            "color" => "#7B9A6C",
            "resourceId" => "a",
            "service_id" => $calendars[0]->service_id,
            "recurrence_id" => null,
            "recurrence_type" => "Every week",
            "grouped" => true,
        ];
        $newCalendar = Calendar::create($calendarIndividual);
        return $newCalendar;
    }
}