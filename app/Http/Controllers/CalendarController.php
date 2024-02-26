<?php

namespace App\Http\Controllers;

use App\Enums\Recurring;
use App\Enums\Type;
use App\Http\Requests\DropCalendarRequest;
use App\Http\Requests\GetCalendarRequest;
use App\Http\Requests\ResizeCalendarRequest;
use App\Http\Requests\StoreCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;
use App\Http\Resources\CalendarResource;
use App\Models\Calendar;
use App\Models\Recurrence;
use App\Models\Service;
use App\Models\Weekday;
use DateTime;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $user = auth()->id();
        return view('admin.calendar.calendar', [
            'services' => Service::where('user_id', $user)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCalendarRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCalendarRequest $request)
    {
        $data = $request->validated();
        Calendar::updateOrCreate(['service_id' => $data['service_id']], $data);
        return to_route('services.calendar', $data['service_id']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Calendar $calendar
     * @return CalendarResource
     */
    public function edit(Calendar $calendar)
    {
        $service = Service::where('id', $calendar->service_id)->first();
        if (!$service->end_repeat) {
            $calendar->end = $service->end;
        }
        return new CalendarResource($calendar);
    }

    public function getEvents(GetCalendarRequest $request)
    {
        $user = auth()->id();
        $service = Service::where('user_id', $user)->pluck('id');
        return Calendar::whereIn('service_id', $service)->get();
    }

    public function getServices(GetCalendarRequest $request)
    {
        $date = $request->validated();
        $serviceEvents = Calendar::where('service_id', $date['service_id'])->where('recurrence_id', null)
        ->get();
        $service = Service::where('id', $date['service_id'])->first();

        foreach ($serviceEvents as $serviceEvent) {
            $dateStart = $serviceEvent->start;
            $dateEnd = $serviceEvent->end;
        }

        if ($service->type->value == Type::Individual->value) {
            $events = Calendar::where('service_id', $date['service_id'])->where('altered', true)->where('grouped', null)->get();
        }

        if ($service->type->value != 2 && $service->recurring == Recurring::Notrepeat->value) {
            $notRepeatCalendars = Calendar::where('service_id', $date['service_id'])->where('recurrence_type', 'Does not repeat')->get();
            $events = $notRepeatCalendars;
        }


        if ($service->type->value != 2 && $service->recurring == Recurring::Custom->value) {
            $recurrentServices = Calendar::where('service_id', $date['service_id'])->where('recurrence_type', '+ Custom')->get();
            foreach ($recurrentServices as $recurrentService) {
                $events[] = [
                    'id' => $recurrentService->id,
                    'title' => $service->name,
                    'color' => '#7B9A6C',
                    'start' => $recurrentService->start,
                    'end' => $recurrentService->end,
                    'resourceId' => 'a',
                ];
            }
        }
        if ($service->type->value != 2 && $service->recurring == Recurring::Everyday->value) {
            $everyDayCalendars = Calendar::where('service_id', $date['service_id'])->where('recurrence_type', 'Every day')->get();
            foreach ($everyDayCalendars as $everyDayCalendar) {
                $everyDayStart = $everyDayCalendar->start;
                $everyDayEnd = $everyDayCalendar->end;
            }
            $recurrentEvents = [
                [
                    'title' => 'Every day',
                    'grou pId' => 'recurrentEvents',
                    'startTime' => $everyDayStart->format('H:i:s'),
                    'endTime' => $everyDayEnd->format('H:i:s'),
                    'startRecur' => $everyDayStart,
                    'endRecur' => $service->end_repeat == null ? null : $everyDayEnd,
                    'color' => 'blue',
                ]
            ];
            if (!$service->end_repeat) {
                $everyDayCalendars[0]->end = '9999-12-31';
            }
            $events = $recurrentEvents;
        }
        if ($service->type->value != 2 && $service->recurring == Recurring::Everyweek->value) {
            $everyWeekCalendars = Calendar::where('service_id', $date['service_id'])->where('recurrence_type', 'Every Week')->get();
            foreach ($everyWeekCalendars as $everyWeekCalendar) {
                $everyWeekStart = $everyWeekCalendar->start;
                $everyWeekEnd = $everyWeekCalendar->end;
            }
            $recurrentEvents = [
                [
                    'title' => 'Every week',
                    'groupId' => 'recurrentEvents',
                    'daysOfWeek' => array_map('intval', $service->weekday),
                    'startTime' => $everyWeekStart->format('H:i:s'),
                    'endTime' => $everyWeekEnd->format('H:i:s'),
                    'startRecur' => $everyWeekStart,
                    'endRecur' => !$service->end_repeat ? null : $everyWeekEnd,
                    'color' => 'purple',
                ]
            ];
            if (!$service->end_repeat) {
                $everyWeekCalendars[0]->end = '9999-12-31';
            }
            $events = $recurrentEvents;
        }
         // if ($service->recurring == Recurring::Everymonth->value) {
         //     $recurrentEvents = [
         //         [
         //             'title' => 'Every Month',
         //             'color' => 'red',
         //             'rrule' => [
         //                 'freq' => 'monthly',
         //                 'dtstart' => $dateStart,
         //                 'until' => $dateEnd,
         //                 // Talvez precise adicionar a hora e o minuto da recorrencia;
         //                 // 'byhour' => [7, 18],
         //                 // 'byminute' => [30],
         //             ]
         //         ]
         //     ];

         //     $events = array_merge($serviceEvents->toArray(), $recurrentEvents);
         // }

         // if ($service->recurring == Recurring::Everyyear->value) {
         //     $recurrentEvents = [
         //         [
         //             'title' => 'Every Year',
         //             'color' => 'green',
         //             'rrule' => [
         //                 'freq' => 'yearly',
         //                 'dtstart' => $dateStart,
         //                 'until' => $dateEnd,
         //             ]
         //         ]
         //     ];

         //     $events = array_merge($serviceEvents->toArray(), $recurrentEvents);
         // }
        return $events;
    }
    
    public function updateEvents(UpdateCalendarRequest $request)
    {
        $data = $request->validated();
        $service = Service::where('id', $data['service_id'])->first();
        $recurringValue = +$data['recurring'];

        if (!isset($data['end_repeat'])) {
            $service->end_repeat = null;
        } else {
            $service->end_repeat = $data['end_repeat'];
        }

        if($recurringValue == 3 && isset($data['weekday'])) {
            $service->weekday = $data['weekday'];
        } else {
            $service->weekday = null;
        }

        if($recurringValue == 6) {
            $data['start'] = null;
            $data['end'] = null;
            $service['custom_end_date'] = max($data['end_date']);
        }
        $service->start = $data['start'];
        $service->end = $data['end'];
        $service->recurring = intval($data['recurring']);
        $service->update();
        
        if (array_key_exists('recurring', $data)) {
            unset($data['recurring']);
        }

        $recurrences = Recurrence::where('service_id', $service->id)->get();
        if ($recurrences) {
            foreach ($recurrences as $recurrence) {
                $recurrence->delete();
            }
        }

        if(isset($data['start_date']) && Recurring::Custom->value == $recurringValue) {
            foreach ($data['start_date'] as $key => $start) {
                Recurrence::create(
                    [
                        'service_id' => $service->id,
                        'start_date' => $start,
                        'end_date' => $data['end_date'][$key],
                    ]
                );
            }
        }

        return to_route('services.calendar', $data['service_id']);
    }

    public function resizeEvents(ResizeCalendarRequest $request)
    {
        Calendar::where('id', $request->id)
            ->update($request->validated());

        return to_route('calendar.index');
    }

    public function dropEvents(DropCalendarRequest $request)
    {
        Calendar::where('id', $request->id)
            ->update($request->validated());

        return to_route('calendar.index');
    }

    public function calendarCreated(Request $request)
    {
        $data = $request->all();
        $calendarId = Calendar::where('service_id', array_keys($data)[0])->pluck('id')[0];
        return response()->json($calendarId);
    }
}