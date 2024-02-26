<?php

namespace App\Http\Controllers;

use App\Models\Occurrence;
use Illuminate\Http\JsonResponse;
use App\Http\Services\EventService;
use App\Http\Requests\StoreEventRequest;
use App\Http\Repositories\EventRepository;
use App\Http\Requests\ScheduleEventRequest;
use App\Models\Calendar;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private EventService $eventService;
    private EventRepository $eventRepository;

    public function __construct(EventService $eventService, EventRepository $eventRepository)
    {
        $this->eventService = $eventService;
        $this->eventRepository = $eventRepository;
    }

    /**
     * Retrieve a list of events.
     *
     */
    public function events(): JsonResponse
    {
        $events = $this->eventRepository->events();
        return response()->json($events);
    }

    /**
     * Retrieve a list of events occurrences.
     *
     */
    public function eventsWithRecurrences($packageId): JsonResponse
    {
        $events = $this->eventRepository->events();
        $allRecurringEvents = $this->eventService->getOccurrences($events, $packageId);
        return response()->json($allRecurringEvents);
    }

    /**
     * Retrieve a list of events occurrences.
     *
     */
    public function eventsWithRecurrencesFromCalendar(Request $request): JsonResponse
    {
        $events = $this->eventRepository->eventsWithRecurrencesFromCalendar($request->packageId);
        $allRecurringEvents = $this->eventService->getOccurrences($events, $request->packageId);
        $sessionEvents = $request->input('storedEvents');

        $ids = [];
        if (json_decode($sessionEvents, true) !== null) {
            $eventsDecoded = json_decode($request->input('storedEvents'));

            foreach ($eventsDecoded as $eventDecoded) {
                $ids[] = $eventDecoded->occurrenceId;
            }

            foreach ($allRecurringEvents as $key => $recurringEvent) {
                if (isset($recurringEvent['id']) && in_array($recurringEvent['id'], $ids)) {
                    $allRecurringEvents[$key]['color'] = '#FF7276';
                }
            }
        }
  
        return response()->json($allRecurringEvents);
    }

    public function eventsWithRecurrencesFromIndividual(Request $request)
    {
        $calendars = $this->eventRepository->eventsWithRecurrencesFromIndividual($request->packageId);
        $allIndividuals = $this->eventService->getOccurrencesIndividuals($calendars, $request->packageId);

        // $events = $this->eventRepository->eventsWithRecurrencesFromIndividual($request->packageId);
        return response()->json($allIndividuals);
    }

    /**
     * Create a new event.
     *
     */
    public function store(StoreEventRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $event = $this->eventRepository->store($validatedData);
        return response()->json($event, 201);
    }

    /**
     * Handle the scheduling of occurrences.
     *
     */
    public function schedule(ScheduleEventRequest $request): JsonResponse
    {
        $validatedData  = $request->validated();
        $event = $this->eventRepository->getById($validatedData['eventId']);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        // Create a new Occurrence instance with the validated data
        $occurrence = new Occurrence([
            'occurrence_id' => $validatedData['occurrenceId'],
            'title' => $validatedData['title'],
            'start' => $validatedData['start'],
            'end' => $validatedData['end'],
            // Add other fields as needed
        ]);

        // Associate the occurrence with the event
        $occurrence->calendar()->associate($event);

        // Save the occurrence to the database
        $occurrence->save();

        return response()->json('Event scheduled', 200);
    }

    /**
     * Handle the scheduling of occurrences.
     *
     */
    public function scheduleFromCalendar(Request $request): JsonResponse
    {
        // dd($request->json());
        $occurrencesData = $request->json();

        foreach ($occurrencesData as $occurrenceData) {
            $event = Calendar::find($occurrenceData['eventId']);

            if (!$event) {
                return response()->json(['error' => 'Event not found'], 404);
            }

            // Create a new Occurrence instance with the validated data
            $occurrence = new Occurrence([
                'occurrence_id' => $occurrenceData['occurrenceId'],
                'title' => $occurrenceData['title'],
                'start' => $occurrenceData['start'],
                'end' => $occurrenceData['end'],
                // Add other fields as needed
            ]);
            // Associate the occurrence with the event
            $occurrence->calendar()->associate($event);

            // Save the occurrence to the database
            $occurrence->save();
        }

        return response()->json('Events scheduled', 200);
    }
}
