<?php

namespace App\Http\Controllers;

use App\Enums\Aimed;
use App\Enums\Method;
use App\Enums\Policy;
use App\Enums\Recurring;
use App\Models\User;
use App\Enums\Role;
use App\Enums\Type;
use App\Http\Helpers\EventHelper;
use Illuminate\Support\Facades\Storage;
use App\Models\Meal;
use App\Models\Country;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateIndividualRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Services\EventService;
use App\Models\Amenity;
use App\Models\Calendar;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Individual;
use App\Models\Result;
use App\Models\Language;
use App\Models\OccurrenceIgnored;
use App\Models\Order;
use App\Models\Package;
use App\Models\PackageGallery;
use App\Models\Recurrence;
use App\Models\Scheduling;
use App\Models\Subcategory;
use App\Models\Timeday;
use Illuminate\Http\Request;
use App\Models\Timezone;
use App\Models\Weekday;
use App\Models\Review;
use Carbon\Carbon;
use DateTime;
use Throwable;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }
     
    public function index(Request $request)
    {
        return view('admin.services.index')
            ->with('services', Service::filterUser($request->user())->filter($request->toArray())->paginate());
    }

    public function schedulingCondition(Service $service)
    {
        return view('admin.services.scheduling')->with([
            'service' => $service,
        ]);
    }

    public function weekDays(Service $service)
    {
        $daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        $weekDays = Weekday::where('service_id', $service->id)->get();
        $weekdayValues = [];
        $timedays = [];
        foreach($weekDays as $day) {
            $weekdayValues[] = $day->weekday;
            $timedays = Timeday::where('weekday_id', $day->id)->get();
        }

        return view('admin.services.weekDays')->with([
            'weekDays' => $weekDays,
            'weekdayValues' => $weekdayValues,
            'daysOfWeek' => $daysOfWeek,
            'service' => $service,
            'timedays' => $timedays,
        ]);
    }

    public function show(Service $service)
    {
        if ($service->type->value != Type::Individual->value && $service->recurring != Recurring::Custom->value) {
            if (!$service->status || $service->end && $service->end->shiftTimezone($service->timezone->timezone) < now($service->timezone->timezone)) {
                return to_route('service.search');
            }
        } else {
            if (!$service->status || $service->custom_end_date < now($service->timezone->timezone) || max($service->calendars->pluck('end')->toArray()) < now($service->timezone->timezone)) {
                return to_route('service.search');
            }
        } 

        $reviewsService = Review::where('status', 1)->whereHas('order', function ($query) use ($service) {
            $query->whereHas('package', function ($query) use ($service) {
                $query->where('service_id', $service->id);
            });
        })->count();
        $admin = User::where('role', Role::Admin->value)->first();

        if ($service->type->value != 2) {   
            $customDates = EventHelper::montandoSelectDeRecorrencias($service);
            return view('front.services.show', ['service' => $service])
                ->with('services', Service::has('packages')->onlyNotExpiredService($service->timezone->timezone)->onlyNotExpiredIndividualService($service->timezone->timezone)->filterByUserStatus()->filterByServiceStatus()->take(32)->get())
                ->with('amenities', Amenity::all())
                ->withAdmin($admin)
                ->with('meals', Meal::all())
                ->with('customDates', $customDates)
                ->with('reviewsService', $reviewsService);
        };

        return view('front.services.show', ['service' => $service])
            ->with('services', Service::has('packages')->onlyNotExpiredService($service->timezone->timezone)->onlyNotExpiredIndividualService($service->timezone->timezone)->filterByUserStatus()->filterByServiceStatus()->take(32)->get())
            ->with('amenities', Amenity::all())
            ->withAdmin($admin)
            ->with('meals', Meal::all())
            ->with('reviewsService', $reviewsService);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $practitioners = User::where('role', Role::ServiceProvider->value)->where('status', true)->get();

        $this->authorize('create', Service::class);
            return view('admin.services.create')
            ->with('countries', Country::all())
            ->with('results', Result::all())
            ->with('meals', Meal::all())
            ->with('amenities', Amenity::all())
            ->with('languages', Language::all())
            ->with('categories', Category::all())
            ->with('subcategories', Subcategory::all())
            ->with('timezones', Timezone::all())
            ->with('policies', Policy::cases())
            ->with('recurrings', Recurring::cases())
            ->with('practitioners', $practitioners);

    }

    public function replicate(Service $service)
    {
        $message = 'You need to insert the photos again!';
        $recurrences = $service->recurrences->where('main_date', false);
        $practitioners = User::where('role', Role::ServiceProvider->value)->where('status', true)->get();
            return view('admin.services.create')
            ->with('message', $message)
            ->with('countries', Country::all())
            ->with('results', Result::all())
            ->with('meals', Meal::all())
            ->with('amenities', Amenity::all())
            ->with('languages', Language::all())
            ->with('categories', Category::all())
            ->with('subcategories', Subcategory::all())
            ->with('recurrences', $recurrences)
            ->with('service', $service)
            ->with('timezones', Timezone::all())
            ->with('policies', Policy::cases())
            ->with('recurrings', Recurring::cases())
            ->with('practitioners', $practitioners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();
        if ($data['type'] == 2) {
            $data['group_size'] = 1;
        }

        $data['user_id'] = auth()->id();
        if(isset($data['practitioner'])) $data['user_id'] = $data['practitioner'];
        $data['photo'] = $request->file('photo')->store('images', 'public');
        $service = DB::transaction(function () use ($data, $request) {
            $service = Service::create($data);
            if ($service->type->value == Type::Individual->value) {
                $service['recurring'] = Recurring::Everyweek->value;
            }

            if (isset($data['start_date']) && isset($data['recurring']) && $data['recurring'] == 6 && $data['type'] != 2) {
                $startDates = $data['start_date'];
                $endDates = $data['end_date'];
                array_push($startDates, $data['start']);
                array_push($endDates, $data['end']);
                if ($startDates[0] != null) {
                    $recurrences = collect($startDates)->zip($endDates);
                    $recurrenceObjects = [];
                    $lastIndex = $recurrences->count() - 1;
                    $recurrences->each(function ($dates, $index) use (&$recurrenceObjects, $lastIndex) {
                        $recurrenceObjects[] = new Recurrence([
                            'start_date' => $dates[0],
                            'end_date' => $dates[1],
                            'main_date' => $index == $lastIndex ? true : false,
                        ]);
                    });
                    $service->recurrences()->saveMany($recurrenceObjects);
                    $service['custom_end_date'] = max($endDates);  
                }
            }

            collect($data['packages'] ?? [])->each(
                fn ($package) => !empty($package['name'] && $package['price'] && $package['quantity'] && $package['duration'] && $package['duration_type'])
                    ? $service->packages()->create($package) : true
            );

            collect($data['extras'] ?? [])->each(fn ($extra) => !empty($extra['name'] && $extra['price']) ? $service->extras()->create($extra) : true);
            collect($data['videos'] ?? [])->each(fn ($video) => !empty($video['link']) ? $service->videos()->create($video) : true);
            collect($data['menus'] ?? [])->each(fn ($menu) => !empty($menu['name']) ? $service->menus()->create($menu) : true);

            $service->categories()->sync(collect($data['categories'] ?? [])->pluck('id'));
            $service->subcategories()->sync(collect($data['subcategories'] ?? [])->pluck('id'));
            $service->results()->sync(collect($data['results'] ?? [])->pluck('id'));
            $service->meals()->sync(collect($data['meals'] ?? [])->pluck('id'));
            $service->amenities()->sync(collect($data['amenities'] ?? [])->pluck('id'));
            $service->languages()->sync(collect($data['languages'] ?? [])->pluck('id'));

            if ($request->galleries) {
                foreach ($request->file('galleries') as $gallery) {
                    $path = $gallery->store('galleries', 'public');
                    Gallery::create([
                        'service_id' => $service->id,
                        'path' => $path
                    ]);
                }
            }

            $packages = $service->packages;
            $packageId = [];

            foreach ($packages as $package) {
                $packageId[] = $package->id;
                $idPosition = array_search($package->id, $packageId);
                $haveGallery = $request->file('packages_galleries');

                if ($request->packages_galleries) {
                    foreach ($haveGallery as $galleries) {
                        if(array_search($galleries, $haveGallery) == $idPosition) {
                            foreach ($galleries as $gallery) {
                                $path = $gallery->store('packages_galleries', 'public');
                                PackageGallery::create([
                                    'package_id' => $packageId[$idPosition],
                                    'path' => $path
                                ]);
                            }
                        }
                    }
                }
            }
            $service->save();
            return $service;
        });

        if ($service->type->value == Type::Individual->value) {
            return to_route('services.weekDays', $service->id);
        } else {
            return to_route('services.calendar', $service->id)->with('message', 'Service successfully created. Check the dates related to your service.');
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $calendar = Calendar::where('service_id', $service->id)->first();
        $recurrences = $service->recurrences->where('main_date', false);
        return view('admin.services.edit')
            ->with('countries', Country::all())
            ->with('results', Result::all())
            ->with('meals', Meal::all())
            ->with('amenities', Amenity::all())
            ->with('languages', Language::all())
            ->with('categories', Category::all())
            ->with('subcategories', Subcategory::all())
            ->with('service', $service->loadMissing('videos', 'extras', 'results', 'meals', 'amenities', 'languages', 'packages', 'galleries'))
            ->with('recurrences', $recurrences)
            ->with('timezones', Timezone::all())
            ->with('policies', Policy::cases())
            ->with('recurrings', Recurring::cases())
            ->with('calendar', $calendar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {

        $data = $request->validated();
        if ($data['type'] == 2) {
            $data['group_size'] = 1;
        }
        
        if ($service->recurring == Recurring::Custom->value) {
            $calendarsToDelete = Calendar::where('service_id', $service->id)->where('recurrence_type', null);
            $calendarsToDelete->delete();
            $idsToDelete = Recurrence::where('service_id', $service->id)->pluck('id');
            Recurrence::destroy($idsToDelete);
            $data['custom_end_date'] = max($data['end_date']); 
        }

        if ($service->type->value == Type::Individual->value) {
            $data['recurring'] = Recurring::Everyweek->value;
        }

        if (!isset($data['end_repeat'])) {
            $data['end_repeat'] = null;
        }
        if (!isset($data['weekday']) || !isset($data['recurring']) || isset($data['recurring']) && +$data['recurring'] != 3) {
            $data['weekday'] = null;
        }
        if ($request->photo) {
            $data['photo'] = $request->file('photo')->store('images', 'public');
        }
        $packagesId = collect($data['packages'] ?? [])->pluck('id')->toArray();
        $allPackages = $service->packages->pluck('id')->toArray();
        $idDelete = array_diff($allPackages, $packagesId);
        $packagesInOrder = Order::whereIn('package_id', $idDelete)->pluck('package_id')->toArray();
        if (!empty($packagesInOrder)) {
            return to_route('services.edit', $service->id)->with('message', 'Unable to delete a package belonging to an order!');
        }
        DB::transaction(function () use ($service, $data, $request, &$allPackages, &$idDelete) {
            $validPackages = [];
            if (!isset($data->status)) {
                $service['status'] = false;
            }
            $service->update($data);
            $service->extras()->delete();
            $service->videos()->delete();
            $service->menus()->delete();
            foreach ($allPackages as $id) {
                if (in_array($id, $idDelete)) {
                    $validPackages[] = $id;
                } else {
                    $package = $service->packages->where('id', $id)->first();
                    $packageData = collect($data['packages'] ?? [])->where('id', $id)->first();

                    if ($package && isset($packageData['name'], $packageData['price'], $packageData['quantity'], $packageData['duration'], $packageData['duration_type'])) {
                        $package->update($packageData);
                    }
                }
            }
            $service->packages()->whereIn('id', $validPackages)->delete();
            $newPackages = collect($data['packages'] ?? [])->whereNotIn('id', $allPackages)->toArray();
            foreach ($newPackages as $newPackage) {
                $service->packages()->create($newPackage);
            }

            if (isset($data['start_date']) && isset($data['end_date'])) {
                $startDates = $data['start_date'];
                $endDates = $data['end_date'];
                if ($service->recurring == Recurring::Custom->value) {
                    array_push($startDates, $data['start']);
                    array_push($endDates, $data['end']);
                    foreach ($startDates as $index => $startDate) {
                        if (empty($service->recurrences[$index]) && isset($endDates[$index])) {
                            $newRecurrence = new Recurrence([
                                'service_id' => $service->id,
                                'start_date' => $startDate,
                                'end_date' => $endDates[$index],
                                'main_date' => $index == array_key_last($startDates) ? true : false,
                            ]);
                            $newRecurrence->save();
                        }
                    }
                    $data['custom_end_date'] = max($endDates); 
                }
            }

            collect($data['extras'] ?? [])->each(fn ($extra) => !empty($extra['name'] && $extra['price']) ? $service->extras()->create($extra) : true);
            collect($data['videos'] ?? [])->each(fn ($video) => !empty($video['link']) ? $service->videos()->create($video) : true);
            collect($data['menus'] ?? [])->each(fn ($menu) => !empty($menu['name']) ? $service->menus()->create($menu) : true);

            $service->categories()->sync(collect($data['categories'] ?? [])->pluck('id'));
            $service->subcategories()->sync(collect($data['subcategories'] ?? [])->pluck('id'));
            $service->results()->sync(collect($data['results'] ?? [])->pluck('id'));
            $service->meals()->sync(collect($data['meals'] ?? [])->pluck('id'));
            $service->amenities()->sync(collect($data['amenities'] ?? [])->pluck('id'));
            $service->languages()->sync(collect($data['languages'] ?? [])->pluck('id'));

            if ($request->galleries) {
                foreach ($request->file('galleries') as $gallery) {
                    $path = $gallery->store('galleries', 'public');
                    Gallery::create([
                        'service_id' => $service->id,
                        'path' => $path
                    ]);
                }
            }

            $packages = Package::where('service_id', $service->id)->get();
            $packageId = [];

            foreach ($packages as $package) {
                $packageId[] = $package->id;
                $idPosition = array_search($package->id, $packageId);
                $haveGallery = $request->file('packages_galleries');

                if ($request->packages_galleries) {
                    foreach ($haveGallery as $galleries) {
                        if(array_search($galleries, $haveGallery) == $idPosition) {
                            foreach ($galleries as $gallery) {
                                $path = $gallery->store('packages_galleries', 'public');
                                PackageGallery::create([
                                    'package_id' => $packageId[$idPosition],
                                    'path' => $path
                                ]);
                            }
                        }
                    }
                }
            }
        });

        return to_route('services.calendar', $service->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        if ($service->packages->pluck('orders')->flatten()->count()) {
            return to_route('services.index')->with('message', 'Unable to delete a service belonging to an order!');
        }
        $service->delete();

        return to_route('services.index');
    }

    public function deleteImg(Gallery $gallery)
    {
        $this->authorize('delete', $gallery);
        if($gallery->path) {
            Storage::disk('public')->delete($gallery->path);
        }

        $gallery->delete();

        return to_route('dashboard');
    }

    public function deleteImgPackage(PackageGallery $img)
    {
        $this->authorize('delete', $img);
        if($img->path) {
            Storage::disk('public')->delete($img->path);
        }

        $img->delete();

        return to_route('dashboard');
    }

    public function searchService(Request $request)
    {
        $services = Service::whereHas('packages')
            ->join('timezones', 'services.timezone_id', '=', 'timezones.id')
            ->select('services.*', 'timezones.timezone')
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('services.type', 2)
                        ->orWhere('services.recurring', 6);
                })->whereRaw('custom_end_date >= (NOW() + INTERVAL timezones.timezone HOUR)');
            })
            ->orWhere(function ($query) {
                $query->where('services.type', '<>', 2)->where('services.recurring', '<>', 6)
                    ->whereRaw('end >= (NOW() + INTERVAL timezones.timezone HOUR)');
            })
            ->filter($request->toArray())
            ->filterByUserStatus()
            ->filterByServiceStatus()
            ->search($request->toArray())
            ->paginate(9);

        return view('admin.services.search')
            ->with('services', $services)
            ->with('results', Result::all())
            ->with('categories', Category::all())
            ->with('subcategories', Subcategory::all())
            ->with('languages', Language::all())
            ->with('methods', Method::class)
            ->with('aimeds', Aimed::class)
            ->with('maxPrice', Package::max('price'))
            ->with('minPrice', Package::min('price'))
            ->with('countries', Country::all())
            ->with('types', Type::class);
    }

    public function showServiceCalendar(Service $service)
    {
        $calendar = Calendar::where('service_id', $service->id)->get();
        $recurrences = Recurrence::where('service_id', $service->id)->get();

        return view('admin.calendar.show', [
            'calendar' => $calendar,
            'service' => $service,
            'recurrences' => $recurrences,
            'recurrings' => Recurring::cases(),
        ]);
    }

    public function changeStatus(Service $service)
    {
        $service->status = !$service->status;
        $service->save();

        return to_route('services.index');
    }

    public function updateWeekday(Service $service, Request $request)
    {
        $deleteDays = Weekday::where('service_id', $service->id)->get();
        foreach($deleteDays as $deleteDay) {
            $deleteDay->delete();
        }
        $recurencesService = Recurrence::where('service_id', $service->id)->get();
        $calendarsService = Calendar::where('service_id', $service->id)->get();
    
        foreach($recurencesService as $recurenceService) {
            if($recurenceService) {
                $recurenceService->delete();
            }
        }

        foreach($calendarsService as $calendarService) {
            if($calendarsService) {
                $calendarService->delete();
            }
        }

        $arrayWeekdaysID = [];
        $weekdays = $request->input('weekday');
        if (isset($weekdays)) {
            for ($i = 0; $i <=  3; $i++) {
                foreach ($weekdays as $weekday) {
                    $weekdaysCreated[] = Weekday::create(
                        [
                            'service_id' => $service->id,
                            'weekday' => $weekday,
                        ]
                    );
                }
            }
            $startIndividual = Carbon::now();
            $endIndividual = Carbon::now()->addDays(30);
            $daysInterval = [];

            while ($startIndividual->lte($endIndividual)) {
                $daysInterval[] = Carbon::createFromDate($startIndividual->toDateString());
                $startIndividual->addDays();
            }

            $weekdayValues = [];

            $arrayWeekdays = Weekday::where('service_id', $service->id)->get();
            foreach ($arrayWeekdays as $idWeekday) {
                $weekdayValues[] = $idWeekday->weekday;
                $arrayWeekdaysID[] = $idWeekday->id;
            }
            $countId = count($weekdays);
            $lastItems = array_slice($arrayWeekdaysID, -$countId, $countId);

            $arrayStart = [];
            $arrayEnd = [];
            $timedaysCreated = [];

            foreach ($request->input('start_time') as $starts) {
                foreach ($starts as $start) {
                    $arrayStart[] = $start;
                }
            }
    
            foreach ($request->input('end_time') as $key => $ends) {
                foreach ($ends as $end) {
                    $arrayEnd[] = $end;
                    $endIndex = array_search($end, $arrayEnd);
                    $start = $arrayStart[$endIndex];
       
                    $newId = null;
                    if (in_array($key, $weekdayValues)) {
                        $positionID = array_search($key, $weekdayValues);
                        $newId = $lastItems[$positionID];
                    }
                    
                    if ($end != null && $start != null && $newId != null) {
                        for ($i = 0; $i <= 3; $i++) {
                            $timedaysCreated[] = Timeday::create(
                                [
                                    'weekday_id' => $newId,
                                    'start' => $start,
                                    'end' => $end,
                                ]
                            );
                        }
                    }
                }
            }

            $startRequest = $request->input('start_time');
            $endRequest = $request->input('end_time');
            $recurrencesCreated = [];
            $endDates = [];
            foreach ($daysInterval as $dataDay) {
                if (in_array($dataDay->dayOfWeek, $weekdayValues)) {
                    $endTimeOfDay = $endRequest[$dataDay->dayOfWeek];
                    foreach ($startRequest[$dataDay->dayOfWeek] as $key => $horario) {
                        $endDates[] = $dataDay->copy()->setTimeFrom($horario);
                        $recurrencesCreated[] = Recurrence::create([
                            'service_id' => $service->id,
                            'start_date' => $dataDay->copy()->setTimeFrom($horario),
                            'end_date' => $dataDay->copy()->setTimeFrom($endTimeOfDay[$key]),
                            'altered' => true,
                        ]);
                    }
                }
            }
            $service['custom_end_date'] = max($endDates);
            $service->update();
            $keys = [];
            $currentKey = 0;
            foreach ($recurrencesCreated as $key => $recurrenceCreated) {
                try {
                    $currentKey = $key;
                    $weekdaysCreated[$key]->update([
                        'created_at' => $recurrenceCreated->start_date
                    ]);
                    $timedaysCreated[$key]->update([
                        'weekday_id' => $weekdaysCreated[$key]->id,
                    ]);
                } catch (Throwable $err) {
                    $keys[] = $currentKey;
                };
            }
            foreach ($keys as $v) {
                $newWeekday = Weekday::create([
                    'service_id' => $service->id,
                    'weekday' => $recurrencesCreated[$v]->start_date->dayOfWeek,
                    'created_at' => $recurrencesCreated[$v]->start_date,
                ]);
                Timeday::create([
                    'weekday_id' => $newWeekday->id,
                    'start' => $recurrencesCreated[$v]->start_date,
                    'end' => $recurrencesCreated[$v]->end_date,
                ]);
            }

        }
        $this->eventService->createCalendar($service);
        return to_route('services.calendar', $service->id)->with('message', 'Service successfully created. Check the dates related to your service.');
    }

    public function updateIndividual(UpdateIndividualRequest $request, Service $service)
    {
        $data = $request->validated();
        Individual::where('service_id', $service->id)->delete();
        if (isset($data['start']) && isset($data['end'])) {
            $alldayService = Individual::updateOrCreate([
                'start' => $data['start'],
                'end' => $data['end'],
                'occurrence_type' => $data['occurrence_type'],
                'service_id' => $service->id,
                'when' => isset($data['before']) ? $data['before'] : $data['after'],
                'schedule_time' => isset($data['when_time_before']) ? $data['when_time_before'] : $data['when_time_after'],
                'schedule_type' => isset($data['selectBefore']) ? $data['selectBefore'] : $data['selectAfter'],
            ]);
            $alldayService->save();
        }

        if (isset($data['start_time']) && isset($data['end_time'])) {
            // $deleteSchedules = Individual::where('service_id', $service->id)->get();
            // foreach ($deleteSchedules as $deleteSchedule) {
            //     $deleteSchedule->delete();
            // }
            $startTimes = array_filter($data['start_time'], function ($value) {
                return !is_null($value);
            });
            $endTimes = array_filter($data['end_time'], function ($value) {
                return !is_null($value);
            });
            $serviceId = $service->id;
            foreach ($startTimes as $key => $start) {
                $end = $endTimes[$key];
                $service = Individual::create([
                    'start' => $start,
                    'end' => $end,
                    'weekday' => $key,
                    'occurrence_type' => $data['occurrence_type'],
                    'service_id' => $serviceId,
                    'when' => isset($data['before']) ? $data['before'] : $data['after'],
                    'schedule_time' => isset($data['when_time_before']) ? $data['when_time_before'] : $data['when_time_after'],
                    'schedule_type' => isset($data['selectBefore']) ? $data['selectBefore'] : $data['selectAfter'],
                ]);
            }
            $service->save();
        }
        return to_route('services.index');
    }

    public function updateScheduling(Service $service, Request $request)
    {
        $deleteSchedules = Scheduling::where('service_id', $service->id)->get();
        foreach($deleteSchedules as $deleteSchedule) {
            $deleteSchedule->delete();
        }
        $data = [
            'service_id' => $service->id,
            'not_schedule' => $request->input('not_schedule'),
            'not_schedule_type' => $request->input('not_schedule_type'),
            'max_events' => $request->input('max_events'),
            'when' => $request->input('when'),
            'when_time' => $request->input('when_time'),
            'when_type' => $request->input('when_type'),
            'schedule_time' => $request->input('schedule_time'),
            'schedule_type' => $request->input('schedule_type'),
            'schedule_start' => $request->input('schedule_start'),
            'schedule_end' => $request->input('schedule_end'),
            'indefinitely' => $request->input('indefinitely'),
        ];
        Scheduling::create($data);

        return to_route('services.calendar', $service->id);
    }

    public function updateTimes(Service $service, Request $request)
    {
        $dateClick = $request->input('start');
        $startDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $dateClick);
        $endDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $dateClick);
        $startTimes = $request->input('start_time');
        $endTimes = $request->input('end_time');
        $recurrence = Recurrence::where('service_id', $service->id)->whereDate('start_date', $dateClick)->get();
        $newRecurrence = [];
        $deleteRecurrences = Recurrence::where('service_id', $service->id)
        ->whereDay('start_date', '=', $startDate->day)
        ->whereMonth('start_date', '=', $startDate->month)
        ->whereYear('start_date', '=', $startDate->year)
        ->get();
        try {
            if ($deleteRecurrences->isNotEmpty()) {
                $weekdays = Weekday::where('service_id', $service->id)->whereIn('created_at', $deleteRecurrences->pluck('start_date'))->get();
                foreach ($weekdays as $weekday) {
                    $weekday->delete();
                }
                foreach ($deleteRecurrences as $deleteRecurrence) {
                    $deleteRecurrence->delete();
                }
            }
        } catch (Throwable $err) {
            return to_route('services.calendar', $service->id);
        }
        
        if($startTimes) {
            OccurrenceIgnored::where('service_id', $service->id)->whereDate('start', $dateClick)->delete();
            foreach ($startTimes as $key => $startTime) {
                if(isset($endTimes[$key])) {
                    $endTime = $endTimes[$key];
                }
                foreach($startTime as $key => $time) {
                    $start = $startDate->setTimeFrom($time);
                    $end = $endDate->setTimeFrom($endTime[$key]);
                    $newRecurrence =  Recurrence::create([
                        'service_id' => $service->id,
                        'start_date' => $start,
                        'end_date' => $end,
                        'altered' => true,
                    ]);
                }
            }
            $service['custom_end_date'] = $end;
        }
        $newCalendar = $this->eventService->createCalendar($service);
        if (!$startTimes && !$endTimes) {
            $service['custom_end_date'] = max($service->calendars->pluck('end')->toArray());
            $start_date = new DateTime($recurrence->pluck('start_date')[0]);
            $start_date->setTime(0, 0, 0);
            $end_date = new DateTime($recurrence->pluck('end_date')[0]);
            $end_date->setTime(23, 00, 00);
            OccurrenceIgnored::create([
                'service_id' => $service->id,
                'calendar_id' => $newCalendar->id,
                'title' => 'test',
                'start' => $start_date,
                'end' => $end_date,
            ]);
        }
        if (isset($startTimes)) {
            $arrayKey = array_keys($startTimes)[0];
            $newWeekDay = Weekday::create([
                'service_id' => $service->id,
                'weekday' => $startDate->dayOfWeek,
                'created_at' => $newRecurrence->start_date,
            ]);
           
            $newTimeday = Timeday::create([
                'weekday_id' => $newWeekDay->id,
                'start' => $startTimes[$arrayKey][0],
                'end' => $endTimes[$arrayKey][0],
            ]);
        }
        $service->update();
        return to_route('services.calendar', $service->id);
    }

    public function editIndividual(Service $service)
    {
        $individuals = $service->individual;
        $individualsByWeekday = [];
        foreach ($individuals as $individual) {
            $individualsByWeekday[$individual->weekday] = $individual;
        }
        if (in_array("2", $individuals->pluck('occurrence_type')->toArray())) {
            $occurrence = '';
            foreach ($individuals as $individual) {
                $occurrence = $individual['occurrence_type'];
            }
            return view('admin.individuals.edit')->with([
                'service' => $service,
                'occurrence' => $occurrence,
                'individuals' => $individualsByWeekday,
                'scheduling' => $individuals[0],
            ]);
        } elseif (in_array("1", $individuals->pluck('occurrence_type')->toArray())) {
            $occurrence2 = '';
            foreach ($individuals as $individual) {
                $occurrence2 = $individual['occurrence_type'];
            }

            return view('admin.individuals.edit')->with([
                'service' => $service,
                'individualAllday' => $individuals[0],
                'occurrence' => $occurrence2,
                'scheduling' => $individuals[0],
            ]);
        } else {
            return view('admin.individuals.edit')->with([
                'service' => $service,
            ]);
        }
        return to_route('services.calendar', $service->id);
    }
}