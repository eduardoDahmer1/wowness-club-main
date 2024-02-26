<?php

namespace App\Observers;

use App\Enums\Recurring;
use App\Enums\Type;
use App\Models\Calendar;
use App\Models\Recurrence;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceObserver
{
    /**
     * Handle the Service "created" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function created(Service $service)
    {
        $service->slug = Str::slug($service->name . ' ' . Str::substr($service->id, 0, 15));
        $service->save();

        if ($service->type->value == Type::Individual->value) {
            $calendar = Calendar::create([
                'service_id' => $service->id,
                'title' => $service->name,
                'start' => $service->start,
                'end' => $service->end,
                'color' => '#7B9A6C',
                'resourceId' => 'a',
                'recurrence_type' => Recurring::from(3)->name(),
            ]);
            $calendar->save();
        }
    }

    public function updating(Service $service)
    {
        if($service->getOriginal('photo') && $service->getOriginal('photo') != $service->photo) Storage::disk('public')->delete($service->getOriginal('photo'));

    }
    public function updated(Service $service)
    {
        if ($service->type->value == Type::Individual->value) {
            Calendar::where('service_id', $service->id)->update([
                'title' => $service->name,
            ]);
        }
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function forceDeleted(Service $service)
    {
        if($service->getOriginal('photo')) Storage::disk('public')->delete($service->getOriginal('photo'));
    }
}
