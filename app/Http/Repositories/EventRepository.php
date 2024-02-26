<?php

namespace App\Http\Repositories;

use App\Models\Calendar;
use App\Models\Event;
use App\Models\Service;

class EventRepository
{
    public function events(): \Illuminate\Database\Eloquent\Collection
    {
        return Event::all();
    }

    public function store(array $validatedData): bool
    {
        return Event::create($validatedData);
    }

    public function getById($id): ?Event
    {
        return Event::find($id);
    }

    public function update(Event $event, $validatedData): bool
    {
        return $event->update($validatedData);
    }

    public function eventsWithRecurrencesFromCalendar($packageId)
    {
        $service = Service::whereHas('packages', fn ($query) => $query->where('packages.id', $packageId))->first();
        return Calendar::WHERE('service_id', $service->id)->where('recurrence_id', '!=', null)->get();
    }

    public function eventsWithRecurrencesFromIndividual($packageId)
    {
        $service = Service::whereHas('packages', fn ($query) => $query->where('packages.id', $packageId))->first();
        return Calendar::WHERE('service_id', $service->id)->get();
    }
}
