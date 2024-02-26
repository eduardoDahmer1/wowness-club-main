<?php

namespace App\Http\Helpers;

use App\Enums\Recurring;
use App\Enums\Type;
use App\Models\Calendar;
use App\Models\Occurrence;
use App\Models\OccurrenceIgnored;
use Carbon\Carbon;

class EventHelper
{
    /**
     * Check if the date is in the list of available dates
     *
     */
    public static function isDateAvailable($date): bool
    {
        // List of available weekdays (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
        $availableWeekdays = [6, 7]; // Example: Monday, Wednesday, Friday

        // Check if the day of the week of the given date is in the list of available weekdays
        return !in_array($date->format('N'), $availableWeekdays);
    }

    /**
     * Check if the date and time are available.
     *
     */
    public static function checkIfOccurrenceIsAvailable(array $occurrenceData, $specificDateRanges, array $occurrences): array
    {
        $occurrenceStart = Carbon::parse($occurrenceData['start']);
        $occurrenceEnd = Carbon::parse($occurrenceData['end']);

        $ignoreOccurrences = isset($specificDateRanges['ignoreOccurrences']) ? $specificDateRanges['ignoreOccurrences'] : [];
        $existingOccurrences = isset($specificDateRanges['existingOcurrences']) ? $specificDateRanges['existingOcurrences'] : [];

        foreach ($ignoreOccurrences as $specificDateRange) {
            $specificStart = Carbon::parse($specificDateRange['start']);
            $specificEnd = Carbon::parse($specificDateRange['end']);

            if ($occurrenceEnd > $specificStart && $occurrenceStart < $specificEnd) {
                return $occurrences;
            }
        }

        foreach ($existingOccurrences as $specificDateRange) {
            $specificStart = Carbon::parse($specificDateRange['start']);
            $specificEnd = Carbon::parse($specificDateRange['end']);
    
            // Check if the occurrence range overlaps with the specific range
            if ($occurrenceStart == $specificStart && $occurrenceEnd == $specificEnd) {
                return $occurrences;
            }
        }
        $occurrences[] = $occurrenceData;
        return $occurrences;
    }

    /**
     * Convert existing occurrences to specific date ranges
     *
     */
    public static function ConvertOccurrences($event): array
    {
        $occurrences = [];
        $existingOccurrences = Occurrence::where('calendar_id', $event->id)->get();
        $ignoreOccurrences = OccurrenceIgnored::where('service_id', $event->service->id)->get();

        $occurrences['ignoreOccurrences'] = $ignoreOccurrences->map(function ($occurrence) {
            return [
                'start' => $occurrence->start,
                'end' => $occurrence->end,
            ];
        })->toArray();


        $occurrences['existingOcurrences'] = $existingOccurrences->map(function ($occurrence) {
            return [
                'start' => $occurrence->start,
                'end' => $occurrence->end,
            ];
        })->toArray();
        return $occurrences;
    }

    public static function montandoSelectDeRecorrencias($service)
    {
        if ($service->recurring == Recurring::Custom->value) {
            $customDates = [];
            $customDates = Calendar::where('service_id', $service->id)->where('recurrence_type', '+ Custom')->get();

            return $customDates->sortBy('start');
        }
        if ($service->recurring == Recurring::Notrepeat->value) {
            $customDates = [];
            $customDates = Calendar::where('service_id', $service->id)->get();
            return $customDates;
        }

        if ($service->recurring == Recurring::Everyday->value) {
            $everyDayDates = Calendar::where('service_id', $service->id)->first();
            $startDay = $everyDayDates->start->format('d');
            $endDay = $everyDayDates->end->format('d');
            $startMonth = $everyDayDates->start->format('m');
            $endMonth = $everyDayDates->end->format('m');
            $year = $everyDayDates->start->format('Y');
            $startHour = $everyDayDates->start->format('H');
            $endHour = $everyDayDates->end->format('H');
            $startSeconds = $everyDayDates->start->format('s');
            $endSeconds = $everyDayDates->end->format('s');
            $startMinute = $everyDayDates->start->format('i');
            $endMinute = $everyDayDates->end->format('i');
            $calendar = [];

            $start = Carbon::create($year, $startMonth, $startDay, $startHour, $startMinute, $startSeconds);
            $end = Carbon::create($year, $endMonth, $endDay, $endHour, $endMinute, $endSeconds);

            for ($date = $start; $date->lte($end); $date->addDay()) {
                $calendar[] = collect([
                    "id" => $everyDayDates->id + $date->day,
                    "start" => $date->copy(),
                    "end" => $date->copy()->setTime($endHour, $endMinute, $endSeconds),
                ]);
            }
            return $calendar;
        }

        if ($service->recurring == Recurring::Everyweek->value) {

            $everyWeekDate = Calendar::where('service_id', $service->id)->get();
            $calendar = [];
            $endDay = $everyWeekDate[0]->end;
            $startDay = $everyWeekDate[0]->start;
            $diffDays = $endDay->diffInDays($startDay);
            $endHour = $endDay->format('H');
            for ($day = 0; $day <= $diffDays; $day++) {
                $newStartDate = (clone $startDay)->addDays($day);
                if (in_array($newStartDate->dayOfWeek, $service->weekday)) {
                    $newEndHour = (clone $newStartDate)->hour($endHour);
                    $datesEveryWeek[$day] = $newStartDate;
                    $calendar[] = collect([
                        "id" => $everyWeekDate[0]->id + $day,
                        "start" => $datesEveryWeek[$day],
                        "end" => $newEndHour,
                    ]);
                }
            }
            return $calendar;
        }
    }

    public static function pricingOptionsOccurrences($occurrences, $convertedDuration): array
    {
        foreach ($occurrences as $key => $occurrence) {
            $startParsed = Carbon::parse($occurrence['start']);
            $endParsed = Carbon::parse($occurrence['end']);
            $diffMinutes = $startParsed->diffInMinutes($endParsed);
            if (!($convertedDuration <= $diffMinutes)) {
                unset($occurrences[$key]);
            }
        }
        $occurrences = array_values($occurrences);
        return $occurrences;
    }
}