<?php

namespace App\Http\Services;

use App\Enums\Duration;
use RRule\RRule;
use DateInterval;
use Carbon\Carbon;
use App\Http\Helpers\EventHelper;
use App\Models\Calendar;
use App\Models\Package;
use App\Models\Service;

class RecurrenceService
{
    /**
     * Generates a series of occurrences for a given event based on a recurrence rule (RRule).
     *
     */
    public function basic($event, $ruleType, $numberOfOccurrences = 10): array
    {
        $startDate      = Carbon::parse($event['start']);
        $endDate        = $startDate->copy()->addMinutes(60);

        $rrule = new RRule([
            'FREQ'      => $ruleType,
            'COUNT'     => $numberOfOccurrences,
            'DTSTART'   => $startDate,
        ]);

        $occurrences = $rrule->getOccurrences();

        $specificDateRanges = EventHelper::ConvertOccurrences($event);

        $events = [];

        foreach ($occurrences as $index => $occurrence) {
            // Calculate the duration dynamically based on the difference between start and end
            $duration = $endDate->diffInHours($startDate);

            $end = (clone $occurrence)->add(new DateInterval("PT{$duration}H"));

            $uniqueIdentifier = md5($event['id'] . '_B' . ($index + 1));

            $occurrenceData = [
                'id' => $uniqueIdentifier,
                'parentEventId' => $event['id'],
                'title' => $event->title . ' ' . $occurrence->format('d M Y H:i:s'), // Add a counter to the title
                'description' => $event['description'],
                'start' => $occurrence->format('Y-m-d H:i:s'),
                'end' => $end->format('Y-m-d H:i:s'),
            ];

            $events = EventHelper::checkIfOccurrenceIsAvailable($occurrenceData, $specificDateRanges, $events);
        }

        return $events;
    }

    /**
     * Generates occurrences for a given event, creating a list of
     * occurrences for each hour within a day for a specified number
     * of days (in this case, 10 days).
     *
     */
    public function allDayHourlyOccurrences($event, $packageId): array
    {
        $package = Package::find($packageId);
        $endDays = $package->service->end->diffInDays($package->service->start);

        if (Duration::from($package->duration_type)->name() == "Minute") {
            $duration = $package->duration;
            $hourJump = $package->duration / 60;
        } else {
            $duration = $package->duration * 60;
            $hourJump = $package->duration;
        }

        $startDate  = Carbon::parse($package->service->start);
        $endDate    = $startDate->copy()->addMinutes($duration);

        $startHours = Carbon::parse($package->service->individual[0]->start)->format('H');
        $endHours = Carbon::parse($package->service->individual[0]->end)->format('H ');

        $occurrences = [];

        $specificDateRanges = EventHelper::ConvertOccurrences($event);

        // Iterate through each day
        for ($day = 0; $day < $endDays; $day++) {
            // Iterate through each hour within a day
            for ($hour = +$startHours; $hour < +$endHours; $hour += $hourJump) { 
                // Clone the start date, add the day and set the hour
                $occurrence = (clone $startDate)->addDays($day)->setHour($hour);

                // Calculate the duration dynamically based on the difference between start and end
                $duration = $endDate->diffInHours($startDate);

                // Clone the occurrence and add duration to get the end time
                $end = (clone $occurrence)->add(new DateInterval("PT{$duration}H"));

                $uniqueIdentifier = md5($event['id'] . '_DH' . ($day + 1) . '_H' . ($hour + 1) . '_D' . $duration);

                // Create occurrence data
                $occurrenceData = [
                    'id'            => $uniqueIdentifier,
                    'parentEventId' => $event['id'], // Include parent event ID
                    'title'         => $event['title'] . ' Day ' . ($day + 1) . ' Hour ' . ($hour + 1),
                    'description'   => $event['description'],
                    'start'         => $occurrence->format('Y-m-d H:i:s'),
                    'end'           => $end->format('Y-m-d H:i:s'),
                ];

                $occurrences = EventHelper::checkIfOccurrenceIsAvailable(
                    $occurrenceData,
                    $specificDateRanges,
                    $occurrences
                );
            }
        }

        return $occurrences;
    }

    public function dailyHourlyOccurrences2($event, $packageId): array
    {
        $package = Package::find($packageId);

        $startService = $package->service->start;
        $endService = $package->service->end;
        $startWeekDayHours = [];
        $endWeekDayHours = [];
        $weekDays = [];

        foreach ($package->service->individual as $dayOfWeek) {
            $weekDays[] = $dayOfWeek->weekday;
            $startWeekDayHours[] = Carbon::parse($dayOfWeek->start)->format('H');
            $endWeekDayHours[] = Carbon::parse($dayOfWeek->end)->format('H ');
        }

        $weekDays = array_map(null, $weekDays, $startWeekDayHours, $endWeekDayHours);
        $diffDays = $endService->diffInDays($startService);

        if (Duration::from($package->duration_type)->name() == "Minute") {
            $duration = $package->duration;
            $hourJump = $package->duration / 60;
        } else {
            $duration = $package->duration * 60;
            $hourJump = $package->duration;
        }

        $endService =  $startService->copy()->addMinutes($duration);
        $occurrences = [];
        $specificDateRanges = EventHelper::ConvertOccurrences($event);

        for ($day = 0; $day <= $diffDays; $day++) {
            $diaAtual = (clone $startService)->addDays($day);
            foreach ($weekDays as $data) {

                if (in_array($diaAtual->dayOfWeek, $data)) {
                    for ($hour = +$data[1]; $hour < +$data[2]; $hour += $hourJump) {

                        $occurrence = (clone  $startService)->addDays($day)->setHour($hour);
                        $duration = $endService->diffInHours($startService);
                        $end = (clone $occurrence)->add(new DateInterval("PT{$duration}H"));

                        $uniqueIdentifier = md5($event['id'] . '_DH' . ($day + 1) . '_H' . ($hour + 1) . '_D' . $duration);
                        $occurrenceData = [
                            'id'            => $uniqueIdentifier,
                            'parentEventId' => $event['id'], // Include parent event ID
                            'title'         => $event['title'] . ' ' . $occurrence->format('d M Y H:i:s'),
                            'description'   => $event['description'],
                            'start'         => $occurrence->format('Y-m-d H:i:s'),
                            'end'           => $end->format('Y-m-d H:i:s'),
                        ];

                        $occurrences = EventHelper::checkIfOccurrenceIsAvailable(
                            $occurrenceData,
                            $specificDateRanges,
                            $occurrences
                        );
                    }
                };
            }
        }

        return $occurrences;
    }

    private static function durationType($durationType, $diffDays, $startService, $alteredDays, $weekDays, $event, $specificDateRanges, $occurrences, $endService, $hourJump, $duration)
    {
        return match ($durationType) {
            'Minute'         => RecurrenceService::durationMinute($diffDays, $startService, $alteredDays, $weekDays, $event, $specificDateRanges, $occurrences, $endService, $hourJump, $duration),
            'Hour'        => RecurrenceService::durationHour($diffDays, $startService, $alteredDays, $weekDays, $event, $specificDateRanges, $occurrences, $endService, $hourJump),
            'Day'       => RecurrenceService::durationDay($diffDays, $startService, $alteredDays, $weekDays, $event, $specificDateRanges, $occurrences, $endService, $hourJump, $duration),
            default => [],
        };
    }

    public static function durationHour($diffDays, $startService, $alteredDays, $weekDays, $event, $specificDateRanges, $occurrences, $endService, $hourJump)
    {
        for ($day = 0; $day <= $diffDays; $day++) {
            $diaAtual = (clone $startService)->addDays($day);
            foreach ($weekDays as $key => $data) {
                if (in_array($diaAtual->dayOfWeek, $data)) {
                    if (array_key_exists($diaAtual->format('Y-m-d'), $alteredDays)) {
                        $data[1] = $alteredDays[$diaAtual->format('Y-m-d')][0];
                        $data[2] = $alteredDays[$diaAtual->format('Y-m-d')][1];
                    }
                    $gapTiming = 0;
                    for ($hour = +$data[1]; $hour < (+$data[2] - 1); $hour += $hourJump) {
                        $planning_start = $hour == +$data[1] ? 0 : $event->planning_start;
                        $occurrence = (clone  $startService)->addDays($day)->setHour($hour)->addMinutes($planning_start + $gapTiming);
                        $gapTiming += $planning_start;
                        $duration = $endService->diffInHours($startService);
                        $end = (clone $occurrence)->add(new DateInterval("PT{$duration}H"));
                        $uniqueIdentifier = md5($event->id . '_DH' . ($day + 1) . '_H' . ($hour + 1) . '_D' . $duration);
                        $occurrenceData = [
                            'id'            => $uniqueIdentifier,
                            'parentEventId' => $event->id, // Include parent event ID
                            'title'         => $event->title . ' ' . $occurrence->format('d M Y H:i:s'),
                            'description'   => $event->description,
                            'start'         => $occurrence->format('Y-m-d H:i:s'),
                            'end'           => $end->format('Y-m-d H:i:s'),
                        ];
                        $occurrences = EventHelper::checkIfOccurrenceIsAvailable(
                            $occurrenceData,
                            $specificDateRanges,
                            $occurrences
                        );
                    }
                };
            }
        }

        return $occurrences;
    }

    public static function durationMinute($diffDays, $startService, $alteredDays, $weekDays, $event, $specificDateRanges, $occurrences, $endService, $hourJump, $duration)
    {
        $minutes = 0;
        $time = floatval($duration / 60);
        $time = number_format($time, 2);
        if ($time != 0) {
            $time = explode('.', $time);
            $hourJump = $time[0];
            $minutes = + ('0.' . $time[1]) / 0.0166667;
            $minutes = intval(round($minutes));
        }
        for ($day = 0; $day <= $diffDays; $day++) {
            $diaAtual = (clone $startService)->addDays($day);
            foreach ($weekDays as $key => $data) {
                if (in_array($diaAtual->dayOfWeek, $data)) {
                    if (array_key_exists($diaAtual->format('Y-m-d'), $alteredDays)) {
                        $data[1] = $alteredDays[$diaAtual->format('Y-m-d')][0];
                        $data[2] = $alteredDays[$diaAtual->format('Y-m-d')][1];
                    }
                    $gapTiming = 0;

                    if (+$hourJump == 0) {
                        +$hourJump = ($minutes * 0.0166667) / 8;
                        $dateInterval = intval(round(+$hourJump, 2));
                    } else {
                        $dateInterval = +$hourJump;
                    }

                    for ($hour = +$data[1]; $hour < +$data[2]; $hour += +$hourJump) {
                        $planning_start = $hour == +$data[1] ? 0 : $event->planning_start;
                        $occurrence = (clone  $startService)->addDays($day)->setHour($hour)->addMinutes($planning_start + $gapTiming);
                        $gapTiming += $planning_start + $minutes;
                        $duration = $endService->diffInHours($startService);
                        $end = (clone $occurrence)->add(new DateInterval("PT{$dateInterval}H"))->addMinutes($minutes);
                        $uniqueIdentifier = md5($event->id . '_DH' . ($day + 1) . '_H' . ($hour) . '_D' . +$dateInterval);
                        $occurrenceData = [
                            'id'            => $uniqueIdentifier,
                            'parentEventId' => $event->id, // Include parent event ID
                            'title'         => $event->title . ' ' . $occurrence->format('d M Y H:i:s'),
                            'description'   => $event->description,
                            'start'         => $occurrence->format('Y-m-d H:i:s'),
                            'end'           => $end->format('Y-m-d H:i:s'),
                        ];
                        $occurrences = EventHelper::checkIfOccurrenceIsAvailable(
                            $occurrenceData,
                            $specificDateRanges,
                            $occurrences
                        );
                    }
                };
            }
        }
        return $occurrences;
    }

    public static function durationDay($diffDays, $startService, $alteredDays, $weekDays, $event, $specificDateRanges, $occurrences, $endService, $hourJump, $duration)
    {
        $minutes = 0;
        $time = floatval($duration / 60);
        $time = number_format($time, 1);
        $time = explode('.', $time);
        $hourJump = $time[0];
        $minutes = + ('0.' . $time[1]) / 0.0166667;
        $minutes = intval(round($minutes));

        for ($day = 0; $day <= $diffDays; $day++) {
            $diaAtual = (clone $startService)->addDays($day);
            foreach ($weekDays as $key => $data) {
                if (in_array($diaAtual->dayOfWeek, $data)) {
                    if (array_key_exists($diaAtual->format('Y-m-d'), $alteredDays)) {
                        $data[1] = $alteredDays[$diaAtual->format('Y-m-d')][0];
                        $data[2] = $alteredDays[$diaAtual->format('Y-m-d')][1];
                    }
                    $gapTiming = 0;
                    for ($hour = +$data[1]; $hour < +$data[2]; $hour += +$hourJump) {
                        $planning_start = $hour == +$data[1] ? 0 : $event->planning_start;
                        $occurrence = (clone  $startService)->addDays($day)->setHour($hour)->addMinutes($planning_start + $gapTiming);
                        $gapTiming += $planning_start + $minutes;
                        $duration = $endService->diffInHours($startService);
                        $end = (clone $occurrence)->add(new DateInterval("PT{$hourJump}H"))->addMinutes($minutes);
                        $uniqueIdentifier = md5($event->id . '_DH' . ($day + 1) . '_H' . ($hour + 1) . '_D' . +$hourJump);
                        $occurrenceData = [
                            'id'            => $uniqueIdentifier,
                            'parentEventId' => $event->id, // Include parent event ID
                            'title'         => $event->title . ' ' . $occurrence->format('d M Y H:i:s'),
                            'description'   => $event->description,
                            'start'         => $occurrence->format('Y-m-d H:i:s'),
                            'end'           => $end->format('Y-m-d H:i:s'),
                        ];
                        $occurrences = EventHelper::checkIfOccurrenceIsAvailable(
                            $occurrenceData,
                            $specificDateRanges,
                            $occurrences
                        );
                    }
                };
            }
        }

        return $occurrences;
    }

    public function dailyHourlyOccurrences3($event, $packageId): array
    {
        $package = Package::find($packageId);
        $startService = $event->start;
        $endService = $event->end;
        $endOccurrence = $endService;
        $startWeekDayHours = [];
        $endWeekDayHours = [];
        $weekDays = [];
        foreach ($package->service->weekdays as $dayOfWeek) {
            $weekDays[] = $dayOfWeek->weekday;
            foreach ($dayOfWeek->timedays as $timeday) {
                $startWeekDayHours[] = Carbon::parse($timeday->start)->format('H');
                $endWeekDayHours[] = Carbon::parse($timeday->end)->format('H');
            }
        }
        $weekDays = array_map(null, $weekDays, $startWeekDayHours, $endWeekDayHours);
        $result = [];
        foreach ($weekDays as $value) {
            if (!in_array($value[0], array_column($result, 0))) {
                $result[] = $value;
            }
        }
        $weekDays = $result;
        $diffDays = $endService->diffInDays($startService);
   
        if (Duration::from($package->duration_type)->name() == "Minute") {
            $duration = $package->duration;
            $hourJump = $package->duration / 60;
        } else if (Duration::from($package->duration_type)->name() == "Hour") {
            $duration = $package->duration * 60;
            $hourJump = $package->duration;
        } else {
            $duration = $package->duration * 1440;
            $hourJump = $package->duration;
        }

        $endService =  $startService->copy()->addMinutes($duration);
        $occurrences = [];
        $specificDateRanges = EventHelper::ConvertOccurrences($event);
        $allCalendars = Calendar::where('service_id', $package->service->id)->where('altered', true)->get();
        $startDates = $allCalendars->pluck('start');
        $endDates = $allCalendars->pluck('end');
        $alteredDays = [];
        foreach ($startDates as $key => $startDate) {
            $alteredDays[$startDate->format('Y-m-d')] = [$startDate->format('H'), $endDates[$key]->format('H')];
        }

        $durationType = Duration::from($package->duration_type)->name();
        $occurrences = $this->durationType($durationType, $diffDays, $startService, $alteredDays, $weekDays, $event, $specificDateRanges, $occurrences, $endService, $hourJump, $duration);
        $referenceDates = $startDates;
        $convertedArray = [];
        foreach ($referenceDates as $referenceDate) {
            $convertedArray[] = $referenceDate->format('Y-m-d');
        }
        foreach ($occurrences as $key => $occurrence) {
            foreach ($referenceDates as $referenceDate) {
                $referenceDayOfWeek = $referenceDate->dayOfWeek;
                $occurrenceDate = Carbon::parse($occurrence['start']);
                if ($occurrenceDate->dayOfWeek == $referenceDayOfWeek && $occurrenceDate->format('Y-m-d') != $referenceDate->format('Y-m-d') && !in_array($occurrenceDate->format('Y-m-d'), $convertedArray)) {
                    unset($occurrences[$key]);
                }
            }

            if (Carbon::parse($occurrence['start']) > $endOccurrence) {

                unset($occurrences[$key]);
            }
        }
        return $occurrences;
    }

    public function dailyHourlyOccurrences4($event, $packageId): array
    {
        $service = Service::whereHas('packages', fn ($query) => $query->where('packages.id', $packageId))->first();
        $packageService = Package::where('id', $packageId)->first();
        $allEvents = Calendar::WHERE('service_id', $service->id)->where('grouped', null)->get();
        $occurrencesNew = [];
        $occurrences = [];
        $control = null;
        $startValue = null;
        $endValue = null;

        foreach ($allEvents->sortBy('start') as $key => $allEvent) {
            $specificDateRanges = EventHelper::ConvertOccurrences($allEvent);
            $startValue = $allEvent->start;
            $endValue = $allEvent->end;
            $uniqueIdentifier = md5($event->id . '_DH' . (intval($allEvent->start->format('d')) + 1) . '_H' . (intval($allEvent->start->format('h')) + 1));
            $occurrencesNew = [
                'id'            => $uniqueIdentifier,
                'parentEventId' => $allEvent->id, // Include parent event ID
                'title'         => $allEvent->title . ' ' . $startValue->format('d M Y H:i:s'),
                'description'   => $allEvent->description,
                'start'         => $startValue->format('Y-m-d H:i:s'),
                'end'           => $endValue->format('Y-m-d H:i:s'),
            ];
            $occurrences = EventHelper::checkIfOccurrenceIsAvailable(
                $occurrencesNew,
                $specificDateRanges,
                $occurrences
            );
        }
        if ($packageService->duration_type == Duration::Minute->value) {
            $occurrences = EventHelper::pricingOptionsOccurrences($occurrences, $packageService->duration);
        }
        if ($packageService->duration_type == Duration::Hour->value) {
            $convertedDuration = $packageService->duration * 60;
            $occurrences = EventHelper::pricingOptionsOccurrences($occurrences, $convertedDuration);
        }

        return $occurrences;
    }
    /**
     * Generates occurrences for a given event, creating a list of
     * occurrences for each hour within a specified time range
     * (typically the 24 hours of a day).
     *
     */
    public function hourlyFor24Occurrences($event): array
    {
        $startDate  = Carbon::parse($event['start']);
        $endDate    = Carbon::parse($event['end']);

        // Initialize an array to store occurrences
        $occurrences = [];

        $specificDateRanges = EventHelper::ConvertOccurrences($event);

        // Iterate through each hour within the specified time range
        for ($i = 0; $i < 24; $i++) {
            // Clone the start date and set the hour
            $occurrence = (clone $startDate)->setHour($i);

            // Calculate the duration dynamically based on the difference between start and end
            $duration = $endDate->diffInHours($startDate);

            // Clone the occurrence and add duration to get the end time
            $end = (clone $occurrence)->add(new DateInterval("PT{$duration}H"));

            // Create occurrence data
            $occurrenceData = [
                'id' => md5($event['id'] . '_H' . ($i + 1)), // Include a unique identifier
                'parentEventId' => $event['id'], // Include parent event ID
                'title'         => $event->title . ' ' . $occurrence->format('d M Y H:i:s'),
                'description'   => $event['description'],
                'start'         => $occurrence->format('Y-m-d H:i:s'),
                'end'           => $end->format('Y-m-d H:i:s'),
            ];

            $occurrences = EventHelper::checkIfOccurrenceIsAvailable(
                $occurrenceData,
                $specificDateRanges,
                $occurrences
            );
        }

        return $occurrences;
    }
}
