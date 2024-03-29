@section('title', 'Edit ' . $service->name)

<x-app-layout>
    <div class="mdk-drawer-layout__content page">

        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Services</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">@lang('Edit Service')</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">

            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col-12 card-form__body card-body">
                        <form method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data" id='serviceForm'>
                            @csrf
                            @method('PUT')
                            <div class="content row">

                                <div class="col-lg-4">
                                    <div class="title-forms-defaults">
                                        <h3>Cover Photo *</h3>
                                    </div>
                                    <x-input-info-label>Size: 1080x1080 | JPG, PNG, JPEG</x-input-info-label>
                                    <input required type="file" name="photo"
                                        accept="image/png, image/jpeg, image/jpg"
                                        data-value-image="{{ $service->photo ? asset('storage/' . $service->photo) : '' }}">

                                    <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                                </div>

                                <div class="col-lg-8 multiple-galleries">
                                    <div class="title-forms-defaults">
                                        <h3>Gallery</h3>
                                    </div>
                                    <div class="box-galleries">
                                        <div class="d-flex">
                                            @foreach ($service->galleries as $img)
                                                <div class="box-image-gallery" id="gallery-{{ $img->id }}"
                                                    style="background-image: url('{{ asset('storage/' . $img->path) }}');">
                                                    <i class="material-icons delete-gallery"
                                                        data-id="{{ $img->id }}">delete</i>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="file" id="galleries" name="galleries[]"
                                        accept="image/png, image/jpeg, image/jpg" multiple
                                        data-value-image="{{ $service->galleries }}" />
                                    <x-input-error class="mt-2" :messages="$errors->get('galleries')" />
                                </div>

                                <div class="col-12">
                                    <div class="title-forms-defaults">
                                        <h3>Main Details</h3>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <x-input-label for="name" :value="__('Title *')" />
                                        <x-text-input id="name" name="name" type="text" class="form-control"
                                            required :value="old('name', $service->name)"
                                            placeholder="Hint: [ADJECTIVE] + [TIME/DURATION] + [YOUR SERVICE] + [LOCATION]" />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <x-input-label for="type" :value="__('Type of service *')" />
                                        <select class="type-service" name="type" id="type" required data-toggle="select">
                                            <option value="1" @selected(old('type', $service->type->value) == 1)>{{ __('Group') }}
                                            </option>
                                            <option value="2" @selected(old('type', $service->type->value) == 2)>{{ __('Individual') }}
                                            </option>
                                            <option value="3" @selected(old('type', $service->type->value) == 3)>{{ __('Course') }}
                                            </option>
                                            <option value="4" @selected(old('type', $service->type->value) == 4)>{{ __('Retreat') }}
                                            </option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <x-input-label for="method" :value="__('Method *')" />
                                        <select name="method" id="method" required data-toggle="select">
                                            <option value="1" @selected(old('method', $service->method->value) == 1)>{{ __('Online') }}
                                            </option>
                                            <option value="2" @selected(old('method', $service->method->value) == 2)>{{ __('In-Person') }}
                                            </option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('method')" />
                                    </div>
                                </div>

                                <div class="col-6 col-lg-2">
                                    <div class="form-group">
                                        <x-input-label for="group_size" :value="__('Group Size*')" />
                                        <x-tooltip-info id='infogroup_size' :info="__('Maximum Group Size / Total Capacity.')" />
                                        <x-text-input id="group_size" name="group_size" type="number"
                                            class="form-control" min="0" :value="old('group_size', $service->group_size)" />
                                        <x-input-error class="mt-2" :messages="$errors->get('uses')" />
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <x-input-label for="target" :value="__('Target *')" />
                                        <select name="target" id="target" required data-toggle="select">
                                            <option value="1" @selected(old('target', $service->target->value) == 1)>{{ __('Seekers') }}
                                            </option>
                                            <option value="2" @selected(old('target', $service->target->value) == 2)>
                                                {{ __('Facilitators') }}
                                            </option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('target')" />
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <x-input-label for="aimed" :value="__('Aimed for *')" />
                                        <select name="aimed" id="aimed" required data-toggle="select">
                                            <option value="1" @selected(old('aimed', $service->aimed->value) == 1)>{{ __('Men Only') }}
                                            </option>
                                            <option value="2" @selected(old('aimed', $service->aimed->value) == 2)>{{ __('Gay Woman') }}
                                            </option>
                                            <option value="3" @selected(old('aimed', $service->aimed->value) == 3)>{{ __('Gay Men') }}
                                            </option>
                                            <option value="4" @selected(old('aimed', $service->aimed->value) == 4)>{{ __('Couple') }}
                                            </option>
                                            <option value="5" @selected(old('aimed', $service->aimed->value) == 5)>
                                                {{ __('Women Only') }} </option>
                                            <option value="6" @selected(old('aimed', $service->aimed->value) == 6)> {{ __('Single') }}
                                            </option>
                                            <option value="7" @selected(old('aimed', $service->aimed->value) == 7)>{{ __('Anyone') }}
                                            </option>
                                            <option value="8" @selected(old('aimed', $service->aimed->value) == 8)>{{ __('Corporate') }}
                                            </option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('aimed')" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="title-forms-defaults">
                                        <h3>Dates</h3>
                                    </div>
                                </div>   
                                <div class="start col-lg-3">
                                    <div class="form-group">
                                        <x-input-label for="start" :value="__('Start *')" />
                                        <div class="flatpickr">
                                            <input type="datetime-local" name="start" required id="start"
                                                class="form-control" placeholder="Choose start date"
                                                data-toggle="flatpickr" data-flatpickr-min-date="today"
                                                data-flatpickr-enable-time="true"
                                                data-flatpickr-alt-format="F j, Y at H:i"
                                                data-flatpickr-date-format="Y-m-d H:i" value={{ old('start', ($service->start ? $service->start->format('Y-m-d\TH:i:s') : ($calendar ? $calendar->start->format('Y-m-d\TH:i:s') : ''))) }}>
                                            <i class="fa fa-calendar-alt"></i>
                                        </div>

                                        <x-input-error class="mt-2" :messages="$errors->get('start')" />
                                    </div>
                                </div>
                                <div class="end col-lg-3" id="end">
                                    <div class="form-group">
                                        <x-input-label for="end" :value="__('End *')" />
                                        <div class="flatpickr">
                                            <input type="datetime-local" name="end" required id="end"
                                                class="end form-control" placeholder="Choose closing date"
                                                data-toggle="flatpickr" data-flatpickr-enable-time="true"
                                                data-flatpickr-alt-format="F j, Y at H:i"
                                                data-flatpickr-date-format="Y-m-d H:i"
                                                value={{ old('end', ($service->end ? $service->end->format('Y-m-d\TH:i:s') : ($calendar ? $calendar->end->format('Y-m-d\TH:i:s') : ''))) }}>
                                            <i class="fa fa-calendar-alt"></i>
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('end')" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <x-input-label for="timezone_id" :value="__('Timezone *')" />
                                        <select name="timezone_id" id="timezone_id" required data-toggle="select">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($timezones as $timezone)
                                                <option value="{{ $timezone->id }}" {{ old('timezone_id', isset($service) ? $service->timezone_id : '') == $timezone->id ? 'selected' : '' }}>
                                                    {{ $timezone->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('timezone_id')" />
                                    </div>
                                </div>

                                <div class="alert-date col-lg-8 d-none mt-0 ml-3" style="display: flex; align-items: center;">
                                    <img src="https://i.ibb.co/Mg1LrrZ/ri-alert-fill.png" alt="Alert Icon" style="margin-right: 10px;">
                                    COMPLETE YOUR SERVICE REGISTRATION AND YOU WILL BE REDIRECTED TO CHOOSE AVAILABLE DATES.
                                </div>               
                                <div class="recurring col-lg-2" id="recurring_div">
                                    <div class="form-group">
                                        <x-input-label for="recurring" :value="__('Recurring*')" />
                                        <div class="form-group">
                                            <select id="recurring" name="recurring" data-toggle="select">
                                                <option value="" selected disabled>{{__('Select the recurrence')}}</option>
                                                @foreach ($recurrings as $recurring)
                                                    <option value="{{ $recurring->value }}" {{ $service->recurring == $recurring->value ? 'selected' : '' }}>
                                                        {{ $recurring->name() }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error class="mt-2" :messages="$errors->get('recurring')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="recurring col-lg-2" id="recurring_custom_div">
                                    <div class="form-group">
                                        <x-input-label for="recurring" :value="__('Recurring*')" />
                                        <div class="form-group">
                                            <select id="recurring_custom" name="recurring" data-toggle="select">
                                                <option value="" selected disabled>{{__('Select the recurrence')}}</option>
                                                <option value="1" {{ $service->recurring == 1 ? 'selected' : '' }}>
                                                    Does not repeat</option>
                                                <option value="6" {{ $service->recurring == 6 ? 'selected' : '' }}>
                                                + Custom</option>
                                            </select>
                                            <x-input-error class="mt-2" :messages="$errors->get('recurring')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="repeat form-group col-lg-12">
                                    <x-input-label class="col-12" :value="__('Repeat every week on...')" style="font-size: 0.9rem;" />
                                    <div class="checkbox-repeat d-flex flex-wrap mt-3">
                                        <input type="checkbox" id="monday" name="weekday[]" value="1" @checked($service->weekday ? in_array("1", $service->weekday): false)>
                                        <label style="font-weight: 500;" for="monday">Monday</label>
                                        <input type="checkbox" id="tuesday" name="weekday[]" value="2" @checked($service->weekday ? in_array("2", $service->weekday): false)>
                                        <label style="font-weight: 500;" for="tuesday">Tuesday</label>
                                        <input type="checkbox" id="wednesday" name="weekday[]" value="3" @checked($service->weekday ? in_array("3", $service->weekday): false)>
                                        <label style="font-weight: 500;" for="wednesday">Wednesday</label>
                                        <input type="checkbox" id="thursday" name="weekday[]" value="4" @checked($service->weekday ? in_array("4", $service->weekday): false)>
                                        <label style="font-weight: 500;" for="thursday">Thursday</label>
                                        <input type="checkbox" id="friday" name="weekday[]" value="5" @checked($service->weekday ? in_array("5", $service->weekday): false)>
                                        <label style="font-weight: 500;" for="friday">Friday</label>
                                        <input type="checkbox" id="saturday" name="weekday[]" value="6" @checked($service->weekday ? in_array("6", $service->weekday): false)>
                                        <label style="font-weight: 500;" for="saturday">Saturday</label>
                                        <input type="checkbox" id="sunday" name="weekday[]" value="0" @checked($service->weekday ? in_array("0", $service->weekday): false)>
                                        <label style="font-weight: 500;" for="sunday">Sunday</label>
                                    </div>
                                </div>
                                <div class="d-flex col-12">
                                    <div class="endRepeat col-2 ml-0 mb-3 mt-4">
                                        <input type="checkbox" id="end_repeat" name="end_repeat" value="1" @checked($service->end_repeat)>
                                        <label style="color: rgba(126, 130, 136);" for="end_repeat" class="endrepeat ml-2">End repeat?</label>
                                    </div>
                                    <div class="end col-4" id="end_recurrence">
                                        <div class="form-group">
                                            <x-input-label for="end" :value="__('End Recurrence')" />
                                            <div class="flatpickr">
                                                <input type="datetime-local" name="end" required id="end_recurrence"
                                                    class="end form-control" placeholder="Choose closing date"
                                                    data-toggle="flatpickr" data-flatpickr-enable-time="true"
                                                    data-flatpickr-alt-format="F j, Y at H:i"
                                                    data-flatpickr-date-format="Y-m-d H:i"
                                                    value={{ old('end', ($service->end ? $service->end->format('Y-m-d\TH:i:s') : ($calendar ? $calendar->end->format('Y-m-d\TH:i:s') : ''))) }}>
                                                <i class="fa fa-calendar-alt"></i>
                                            </div>
                                            <x-input-error class="mt-2" :messages="$errors->get('end')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 dateRecurrenceDiv mt-2">
                                    <div class="form-group recurrences">
                                         <button type="button" class="btn btn-primary p-2 text-uppercase fw-bold"
                                            data-handler="newinputRecurrence" data-ratio="recurrence">+
                                            add dates *</button>
                                            <x-input-info-label>Create especific dates for service recurrence</x-input-info-label>
                                            @foreach($recurrences as $recurrence)
                                            <div id="recurrence_{{ $recurrence->id }}" class="recurrenceDiv container-fluid mb-3 ">
                                                <div id="" class="row align-items-end">
                                                    <div class="col-lg-5 pl-0">
                                                        <x-input-label for="end" :value="__('Start *')" />
                                                        <div class="flatpickr">
                                                            <input type="datetime-local" name="start_date[{{$loop->index}}]" required id="start_date"
                                                                class="form-control" placeholder="Choose closing date"
                                                                data-toggle="flatpickr" data-flatpickr-enable-time="true"
                                                                data-flatpickr-alt-format="F j, Y at H:i"
                                                                data-flatpickr-date-format="Y-m-d H:i"
                                                                value={{ $recurrence->start_date ? \Carbon\Carbon::parse($recurrence->start_date)->format('Y-m-d\TH:i:s') : ''  }}>
                                                            <i class="fa fa-calendar-alt"></i>
                                                        </div>
                                                        <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                                                    </div>
                                                    
                                                    <div class="col-5 col-lg-5 pl-0 ">
                                                     <x-input-label for="end" :value="__('End *')" />
                                                    <div class="flatpickr">
                                                        <input type="datetime-local" name="end_date[{{$loop->index}}]" required id="end_date"
                                                            class="form-control" placeholder="Choose closing date"
                                                            data-toggle="flatpickr" data-flatpickr-enable-time="true"
                                                            data-flatpickr-alt-format="F j, Y at H:i"
                                                            data-flatpickr-date-format="Y-m-d H:i"
                                                            value={{  $recurrence->end_date ? \Carbon\Carbon::parse($recurrence->end_date)->format('Y-m-d\TH:i:s') : '' }}>
                                                        <i class="fa fa-calendar-alt"></i>
                                                    </div>
                                                <x-input-error class="mt-2" :messages="$errors->get('end')" />
    
                                                    </div>
                                                    <i class="material-icons icon-delete delete-recurring" onclick="RecurrenceDeleteInputs(event, {{ $recurrence->id }})" data-ratio="recurrence">delete</i>
                                                </div>
                                            </div>
                                            
                                        @endforeach
                                    </div>
                                    <input type="hidden" id="recurrencesId" name="recurrencesId" value="">
                                </div>
                            
                                <div class="col-12 col-lg-12">
                                    <div class="form-group packages">
                                        <button type="button" class="btn btn-primary p-2 text-uppercase fw-bold"
                                            data-handler="newinputPackages" data-ratio="packages" data-name="name">+
                                            Pricing Options *</button>
                                        <x-tooltip-info id='infoPackages' :info="__(
                                            'For individual sessions, you can add variations of different type of services and duration. For example, 60/90 minutes Deep Tissue Massage and 60/90 minutes Relaxing Massage. For events and group sessions, you can add Standard or VIP tickets. For retreats, you can add variations of accommodation such as Deluxe or Twin room. You can one ore more options but the client will only be able to select one of them.',
                                        )" />
                                        @foreach ($service->packages as $package)
                                            <div class="box-inputs-dinamic container-fluid">
                                                <div id="packages_{{ $loop->index }}" class="row align-items-end">
                                                    <div class="col-lg-5 pl-0">
                                                        <x-input-label :value="__('Option *')" />
                                                        <x-text-input id="package_name{{ $loop->index }}"
                                                            name="packages[{{ $loop->index }}][name]" type="text"
                                                            placeholder="[Type of Service OR ticket OR accomodation]"
                                                            required class="form-control" :value="old('packages.' . $loop->index . '.name', $package->name)" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('packages.' . $loop->index . '.name')" />
                                                    </div>
                                                    <div class="col-5 col-lg-2 pl-0">
                                                        <x-input-label :value="__('price *')" />
                                                        <x-text-input id="package_price{{ $loop->index }}"
                                                            placeholder="&#163"
                                                            name="packages[{{ $loop->index }}][price]"
                                                            type="number" required min="0"
                                                            class="form-control" :value="old(
                                                                'packages.' . $loop->index . '.price',
                                                                $package->price,
                                                            )" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('packages.' . $loop->index . '.price')" />

                                                    </div>
                                                    <div class="col-5 col-lg-2 pl-0">
                                                        <x-input-label :value="__('Quantity *')" />
                                                        <x-text-input name="packages[{{ $loop->index }}][quantity]"
                                                            type="number" required min="0"
                                                            class="qty form-control" :value="old(
                                                                'packages.' . $loop->index . '.quantity',
                                                                $package->quantity,
                                                            )" />
                                                        <x-input-error class="mt-2" :messages="$errors->get(
                                                            'packages.' . $loop->index . '.quantity',
                                                        )" />

                                                    </div>
                                                    <div class="col-5 col-lg-1 pl-0">
                                                        <x-input-label for="duration" :value="__('Duration*')" />
                                                        <x-text-input id="duration" name="packages[{{$loop->index}}][duration]" type="number"
                                                            class="form-control" min="0" required :value="old(
                                                                'packages.'. $loop->index . '.duration', $package->duration)" />
                                                         <x-input-error class="mt-2" :messages="$errors->get(
                                                            'packages.' . $loop->index . '.duration',
                                                        )" />
                                                    </div>
                                                    <div class="col-5 col-lg-1 pl-0">
                                                        <div class="input-group-append">
                                                            <select name="packages[{{$loop->index}}][duration_type]" class="form-control" data-toggle="select">
                                                                    <option value="1" {{ (old('duration_type', $package->duration_type) == 1) ? 'selected' : '' }}>{{ __('Days') }}</option>
                                                                    <option value="2" {{ (old('duration_type', $package->duration_type) == 2) ? 'selected' : '' }}>{{ __('Hours') }}</option>
                                                                    <option value="3" {{ (old('duration_type', $package->duration_type) == 3) ? 'selected' : '' }}>{{ __('Minutes') }}</option>
                                                            </select>
                                                            <x-input-error class="mt-2" :messages="$errors->get(
                                                                'packages.' . $loop->index . '.duration_type',
                                                            )" />
                                                        </div>     
                                                    </div>
                                                    @if(!$package->orders?->count())
                                                        <i class="material-icons icon-delete delete-package" onclick="PackageDeleteInputs(event)" data-ratio="packages">delete</i>
                                                    @else
                                                        <i class="material-icons icon-del-have-order" onclick="alertDeleteHaveOrder()" data-ratio="packages">delete</i>
                                                    @endif
                                                    <div class="col-12 p-0">
                                                        <x-input-label :value="__('Description')" />
                                                        <textarea name="packages[{{ $loop->index }}][description]" placeholder="Brief Description" class="form-control">{{ old('packages.' . $loop->index . '.description', $package->description) }}</textarea>
                                                        <x-input-error class="mt-2" :messages="$errors->get(
                                                            'packages.' . $loop->index . '.description',
                                                        )" maxlength="200"/>

                                                    </div>
                                                    <div class="col-lg-8 multiple-galleries">
                                                        <div class="box-galleries">
                                                            <div class="d-flex">
                                                                @foreach ($package->packageGallerry as $img)
                                                                    <div class="box-image-gallery" id="packageGallery-{{ $img->id }}"
                                                                        style="background-image: url('{{ asset('storage/' . $img->path) }}');">
                                                                        <i class="material-icons del-package-gallery"
                                                                            package-id="{{ $img->id }}">delete</i>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <input type="file" id="galleries" name="packages_galleries[{{ $loop->index }}][]"
                                                        accept="image/png, image/jpeg, image/jpg" multiple
                                                        data-value-image="{{ $package->packageGallerry }}" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('packages_galleries')" />
                                                    </div>

                                                    <div>
                                                        <input type="hidden" id="package_id{{$loop->index}}" name="packages[{{ $loop->index }}][id]"  value="{{$package->id}}" >
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if (session('message'))
                                    <div class="alert alert-danger"> 
                                        <p>
                                        {{ session('message') }} 
                                        </p>
                                    </div>
                                    @endif
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button type="button" id="open-list-cat"
                                            class="btn btn-primary p-2 text-uppercase fw-bold">{{ __('+ Categories *') }}</button>
                                        <x-tooltip-info id='infoCategorie' :info="__(
                                            'Didn’t find a suitable category? Email us at: support@wownessclub.com and let us know your category.',
                                        )" />

                                        <div id="categories-check" class="row"></div>

                                        <div class="list-categ">
                                            <div class="row">
                                                <x-input-info-label class="col-12">Click to select the categories you
                                                    want to relate to the service</x-input-info-label>
                                                @if ($categories->count() == 0 && $subcategories->count() == 0)
                                                    <h6 class="col-12 py-2">No categories created, try creating <a
                                                            href="{{ route('categories.store') }}">new categories</a>
                                                    </h6>
                                                @endif
                                            </div>
                                            <div class="row">
                                                @foreach ($categories as $category)
                                                    <div class="col-md-4">
                                                        <input class="check-categories" type="checkbox"
                                                            name="categories[{{ $category->id }}][id]"
                                                            data-handle-name="{{ $category->name }}"
                                                            data-handle-id="category_{{ $category->id }}"
                                                            id="category_{{ $category->id }}"
                                                            value="{{ $category->id }}"
                                                            @checked($service->categories->contains('id', $category->id)) />
                                                        <label for="category_{{ $category->id }}">
                                                            <img class="pr-2" width='28px'
                                                                src="{{ asset('storage/' . $category->icon) }}"
                                                                alt="">
                                                            {{ $category->name }}
                                                        </label>
                                                        <div class="d-flex flex-wrap">
                                                            @foreach ($category->subcategories as $subcategory)   
                                                            <div>
                                                                <input class="check-categories" type="checkbox"
                                                                    name="subcategories[{{ $subcategory->id }}][id]"
                                                                    data-handle-name="{{ $subcategory->name }}"
                                                                    data-handle-id="subcategory_{{ $subcategory->id }}"
                                                                    id="subcategory_{{ $subcategory->id }}"
                                                                    value="{{ $subcategory->id }}"
                                                                    @checked($service->subcategories->contains('id', $subcategory->id)) />
                                                                <label class="p-1" style="font-size: 13px; margin: 1.5px;" for="subcategory_{{ $subcategory->id }}">
                                                                    {{ $subcategory->name }}
                                                                </label>
                                                            </div>                                                             
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <x-input-label :value="__('Goals *')" />
                                        <x-input-info-label>Select up to 5</x-input-info-label>
                                        <div class="row">
                                            @foreach ($results as $result)
                                                <div class="col-lg-4 py-1">
                                                    <input class="check-goals" type="checkbox"
                                                        name="results[{{ $result->id }}][id]"
                                                        id="result_{{ $result->id }}" value="{{ $result->id }}"
                                                        @checked($service->results->contains('id', $result->id)) />
                                                    <label for="result_{{ $result->id }}"
                                                        class="check-styles">{{ $result->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="title-forms-defaults">
                                        <h3>Address</h3>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <x-input-label for="complement" :value="__('Street')" />
                                        <x-text-input id="complement" name="complement" type="text"
                                            class="form-control" :value="old('complement', $service->complement)" />
                                        <x-input-error class="mt-2" :messages="$errors->get('complement')" />
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <x-input-label for="number" :value="__('Number')" />
                                        <x-text-input id="number" name="number" type="text"
                                            class="form-control" :value="old('number', $service->number)" />
                                        <x-input-error class="mt-2" :messages="$errors->get('number')" />
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <x-input-label for="city" :value="__('City ')" />
                                        <x-text-input id="city" name="city" type="text"
                                            class="form-control" :value="old('city', $service->city)" />
                                        <x-input-error class="mt-2" :messages="$errors->get('city')" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <x-input-label for="state" :value="__('State ')" />
                                        <x-text-input id="state" name="state" type="text"
                                            class="form-control" :value="old('state', $service->state)" />
                                        <x-input-error class="mt-2" :messages="$errors->get('state')" />
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <x-input-label for="zipcode" :value="__('Zipcode ')" />
                                        <x-text-input id="zipcode" name="zipcode" type="text"
                                            class="form-control"  :value="old('zipcode', $service->zipcode)" />
                                        <x-input-error class="mt-2" :messages="$errors->get('zipcode')" />
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <x-input-label for="country_id" :value="__('Country')" />
                                        <select name="country_id" id="country_id" required data-toggle="select" >
                                            <option selected disabled>Select</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ old('country_id') ? old('country_id') : $country->id }}" @selected(old('country_id', $service->country_id)== $country->id)>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('country_id')" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-input-label for="transport" :value="__('Transport')" />
                                        <textarea name="transport" id="transport" class="form-control" placeholder="What is the closest airport/station?">{{old('transport', $service->transport)}}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('transport')" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-input-label for="directions" :value="__('Directions')" />
                                        <textarea name="directions" id="directions" class="form-control"
                                            placeholder="Any additional instructions for people making their own travel arrangements.">{{old('directions', $service->directions)}}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('directions')" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="title-forms-defaults">
                                        <h3>Service Details</h3>
                                        <x-input-info-label>This is your opportunity to show your potential clients what
                                            they can expect.</x-input-info-label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-input-label for="description" :value="__('Description *')" />
                                        <textarea name="description" id="description" class="form-control" required
                                            placeholder="Describe in detail what you will offer.">{{ old('description', $service->description) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-input-label for="highlights" :value="__('Highlights')" />
                                        <textarea name="highlights" id="highlights" class="form-control"
                                            placeholder="Top 3 – 5 highlights of your event/service if any.">{{ old('highlights', $service->highlights) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('highlights')" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-input-label for="benefits" :value="__('Benefits')" />
                                        <textarea name="benefits" id="benefits" class="form-control"
                                            placeholder="Top 3-5 benefits clients can expect from your service.">{{ old('benefits', $service->benefits) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('benefits')" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-input-label for="schedule" :value="__('Schedule')" />
                                        <textarea name="schedule" id="schedule" class="form-control" 
                                            placeholder="Here you can breakdown what will be covered in your event (days/times) if applicable.">{{ old('schedule', $service->schedule) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('schedule')" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-input-label for="included" :value="__('What is included')" />
                                        <textarea name="included" id="included" class="form-control" 
                                            placeholder="List what is included in your service. Here you can mention any extra services that will be provided at an additional cost.">{{ old('included', $service->included) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('included')" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-input-label for="not_included" :value="__('What isn\'t included')" />
                                        <textarea name="not_included" id="not_included" class="form-control" 
                                            placeholder="Set the expectations and list any points which will not be covered.">{{ old('not_included', $service->not_included) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('not_included')" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-input-label for="disclaimer" :value="__('preparation/Disclaimer')" />
                                        <x-tooltip-info id='infodisclaimer' :info="__(
                                            'Please advise of any risks and/or contraindications your clients should be aware of in participating in this service.',
                                        )" />
                                        <textarea id="disclaimer" name="disclaimer" class="form-control" 
                                            placeholder="Advise of any risks and/or contraindications your clients should be aware of in participating in this service and any preparation, for example: bring towel/mat, be on an empty stomach 2 hours before the session…">{{ old('disclaimer', $service->disclaimer) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('disclaimer')" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-input-label for="next_steps" :value="__('After purchase instructions')" />
                                        <x-tooltip-info id='infonext_steps' :info="__(
                                            'Have any instructions you wish to give the customers after they complete the order? Add them here.',
                                        )" />
                                        <textarea name="next_steps" id="next_steps" class="form-control" 
                                            placeholder="For example: Share a WhatsApp/Facebook/Zoom link. If you require any confirmation or preparation guidelines.">{{ old('next_steps', $service->next_steps) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('next_steps')" />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <x-input-label :value="__('Amenities')" />
                                        <x-input-info-label>Leave in blank if amenities are not applicable to your type
                                            of service.</x-input-info-label>
                                        <div class="row">
                                            @foreach ($amenities as $amenity)
                                                <div class="col-lg-3 py-1">
                                                    <input type="checkbox" name="amenities[{{ $amenity->id }}][id]"
                                                        id="amenity_{{ $amenity->id }}" value="{{ $amenity->id }}"
                                                        @checked($service->amenities->contains('id', $amenity->id)) />
                                                    <label for="amenity_{{ $amenity->id }}"
                                                        class="check-styles">{{ $amenity->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-input-label :value="__('Language')" />
                                        <x-input-info-label>Select more than 1 if you offer simultaneous translation
                                        </x-input-info-label>
                                        <div class="row">
                                            @foreach ($languages as $language)
                                                <div class="col-lg-6 py-1">
                                                    <input type="checkbox" name="languages[{{ $language->id }}][id]"
                                                        id="language_{{ $language->id }}"
                                                        value="{{ $language->id }}" @checked($service->languages->contains('id', $language->id)) />
                                                    <label for="language_{{ $language->id }}"
                                                        class="check-styles">{{ $language->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-input-label :value="__('Meals options')" />
                                        <x-input-info-label>Leave in blank if food is not provided.</x-input-info-label>
                                        <div class="row">
                                            @foreach ($meals as $meal)
                                                <div class="col-lg-4 py-1">
                                                    <input type="checkbox" name="meals[{{ $meal->id }}][id]"
                                                        id="meal_{{ $meal->id }}" value="{{ $meal->id }}"
                                                        @checked($service->meals->contains('id', $meal->id)) />
                                                    <label for="meal_{{ $meal->id }}"
                                                        class="check-styles">{{ $meal->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group menus">
                                        <button type="button" class="btn btn-primary p-2 text-uppercase fw-bold"
                                            data-handler="newinput" data-ratio="menus" data-name="name"
                                            data-placeholder="Ex: Breakfast">+ new menu
                                            options</button>
                                        <x-tooltip-info id='infomenus' :info="__(
                                            'Add any variations of food you might offer or leave in blank if food is not provided.',
                                        )" />

                                        @foreach ($service->menus as $menu)
                                            <div class="box-inputs-dinamic d-flex align-items-center">
                                                <x-text-input id="menus_{{ $loop->index }}"
                                                    name="menus[{{ $loop->index }}][name]" type="text"
                                                    class="form-control" :value="old('menus.' . $loop->index . '.name', $menu->name)"
                                                    placeholder="Insert text here" />
                                                <x-input-error class="mt-2" :messages="$errors->get('menus.' . $loop->index . '.name')" />
                                                <div class="p-1">
                                                    <i onclick="removeExtras()" class="material-icons icon-delete btn-extras" data-ratio="videos">delete</i>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="form-group videos">
                                        <button type="button" class="btn btn-primary p-2 text-uppercase fw-bold"
                                            data-handler="newinput" data-ratio="videos" data-name="link"
                                            data-placeholder="https://youtube.com/examplevideo">+ new links
                                            videos</button>
                                        <x-tooltip-info id='infoVideos' :info="__('Promotional Videos and Testimonials.')" />

                                        @foreach ($service->videos as $link)
                                            <div class="box-inputs-dinamic d-flex align-items-center">
                                                <x-text-input id="link_{{ $loop->index }}"
                                                    name="videos[{{ $loop->index }}][link]" type="text"
                                                    class="form-control" :value="old('videos.' . $loop->index . '.link', $link->link)"
                                                    placeholder="Insert text here" />
                                                <x-input-error class="mt-2" :messages="$errors->get('videos.' . $loop->index . '.link')" />
                                                <div class="p-1">
                                                    <i onclick="removeExtras()" class="material-icons icon-delete btn-extras" data-ratio="videos">delete</i>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <div class="form-group extras">
                                        <button type="button" class="btn btn-primary p-2 text-uppercase fw-bold"
                                            data-handler="newinputExtras" data-ratio="extras" data-name="name">+ new
                                            extras</button>
                                        <i class="material-icons icon-delete" data-ratio="extras">delete</i>
                                        <x-tooltip-info id='infoExtra' :info="__(
                                            'This information will only be seen after an order is completed. Feel free to add any further information such as invitation links: Zoom, WhatsApp, Calendly.',
                                        )" />

                                        @foreach ($service->extras as $extra)
                                            <div class="box-inputs-dinamic container-fluid">
                                                <div class="row">
                                                    <div class="col-8 pl-0">
                                                        <x-input-label :value="__('name')" />
                                                        <x-text-input id="extra_name{{ $loop->index }}"
                                                            name="extras[{{ $loop->index }}][name]" type="text"
                                                            class="form-control" :value="old(
                                                                'extras[' . $loop->index . '][name]',
                                                                $extra->name,
                                                            )" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('extras.' . $loop->index . '.name')" />
                                                    </div>
                                                    <div class="col-4 pl-0">
                                                        <x-input-label :value="__('price')" />
                                                        <x-text-input id="extra_price{{ $loop->index }}"
                                                            name="extras[{{ $loop->index }}][price]" type="number"
                                                            min="0" class="form-control" :value="old(
                                                                'extras.' . $loop->index . '.price',
                                                                $extra->price,
                                                            )" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('extras.' . $loop->index . '.price')" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div> --}}

                                <div class="col-12 col-md-2">
                                    {{__('Cancellation Policy')}}<span>*</span>
                                </div>
                                <div class="col-12 col-md-10">
                                    <span>{{__('Choose a cancellation policy that will apply to your service')}}</span>
                                    <div class="form-group">
                                        <select id="policy" required data-toggle="select">
                                            @if ($service->policy)
                                                <option value="{{$service->policy}}" selected>{{__('Current')}}</option>
                                            @else
                                                <option value="" selected disabled>{{__('Select')}}</option>
                                            @endif
                                            @foreach ($policies as $policy)
                                                <option value="{{$policy->text()}}" @selected(old('policy') == $policy->text())>
                                                {{$policy->name()}}</option>
                                            @endforeach
                                            <option value="custom">{{__('Custom')}}</option>
                                        </select>
                                        <textarea id="text-policy" name="policy" readonly class="form-control" rows="5">{{$service->policy}}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('policy')" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input name="status" type="checkbox" id="verified-for-{{ $service->id }}" class="custom-control-input" value="1" @checked($service->status)>
                                            <label class="custom-control-label" for="verified-for-{{ $service->id }}">..</label>
                                        </div>
                                        <label for="verified-for-{{ $service->id }}" class="mb-0"><small>Published</small></label>
                                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                    </div>
                                </div>
                                <div class="col-12 py-3">
                                    <div class="d-flex justify-content-center">
                                        <input class="mr-1" type="checkbox" value="1" name="terms"
                                            id="terms" required>
                                        <label for="terms">I agree with the
                                            <a href="https://wownessclub.co.uk/terms-conditions-for-practitioners" target="_blank">{{ __('Terms & Conditions') }}</a>,
                                            <a href="https://stripe.com/en-gb/legal/ssa" target="_blank">{{ __('Stripe Services Agreement') }}</a>,
                                            <a href="https://stripe.com/en-gb/legal/connect-account" target="_blank">{{ __('Stripe Connected Account Agreement') }}</a>.
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <a style="color:#333;" href="{{ route('services.index') }}"
                                        class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                        {{ __('Cancel') }}
                                    </a>
                                    <x-success-button>{{ __('Save') }}</x-success-button>
                                </div>
                            </div> <!-- Final da Row -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let isFirtsClick = true;
        document.querySelectorAll('i.delete-gallery').forEach(element => {
            element.addEventListener('click', () => {

                if (isFirtsClick) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "By continuing you will delete this image without having to save your changes.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Continue',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Função que deleta uma imagem da galeria
                            var idGallery = element.getAttribute('data-id');
                            var url = `/galleries/${idGallery}`
                            $('div#gallery-' + idGallery).remove()
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                type: 'DELETE',
                                url: url,
                            });
                            isFirtsClick = false;
                        }
                    })
                    return
                }

                // Função que deleta uma imagem da galeria
                var idGallery = element.getAttribute('data-id');
                var url = `/galleries/${idGallery}`
                $('div#gallery-' + idGallery).remove()
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: url,
                });
            })
        });

        document.querySelectorAll('i.del-package-gallery').forEach(element => {
            element.addEventListener('click', () => {
                
                // Função que deleta uma imagem da galeria
                var idPackage = element.getAttribute('package-id');
                var url = `/packages_galleries/${idPackage}`
                $('div#packageGallery-' + idPackage).remove()
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: url,
                });
            })
        });
    </script>
</x-app-layout>

<style>
    .icon-del-have-order {
        padding: 8px 5px;
        color: #8b8b8b;
        background: #fff;
        border-radius: 4px;
        cursor: pointer;
    }
    .alert-date{
        margin-top: 1rem;
        margin-bottom: 1.4rem;
        background: #fff;
        padding: 10px;
        border-radius: 10px;
        justify-content: center; 
        font-size: 16px;
        font-weight: bolder;
    }
    .repeat input[type="checkbox"] {
        margin-right: 10px;
        margin-left: 10px;
        margin-top: auto;
        transform: scale(1.4);
    }

    .checkbox-repeat label{
        font-size: 1rem !important;
        margin-top: auto;
    }
    .endRepeat input[type="checkbox"]{
        transform: scale(1.35);
    }
    .endRepeat{
        margin-left: 0.6rem;
    }
    .endrepeat{
        color: #495057;
        font-weight: 500;
        font-size: 1.2rem;
    }
</style>

<script src="{{ asset('assets/admin/js/flatpickr.js') }}"></script>
<script>

$(document).ready(function() {
    var recurrences = @json($recurrences);
    var recurring = @json($service->recurring);
    var type = @json($service->type->value ?? null);

    var group_size = @json($service->group_size);
    var recurringCustom = recurring

    if(type == 1 && recurring == 2 || type == 1 && recurring == 3){
        $('#end_recurrence').show();
        $('#end').hide();
        $('input[id=end').prop('disabled', true);
        $('input[id=end').next().attr('disabled', true);
    }else{
        $('#end_recurrence').hide();
        $('input[id=end_recurrence').attr('disabled', true);
        $('input[id=end_recurrence').next().attr('disabled', true);
    }

    if(type != 2){
        $('input[name=planning_start').prop('disabled', true)
        $('#planning_start').hide();
    }else{
        $('input[id=group_size').val('');
        $('input[id=group_size').attr('disabled', 'disabled');
    }

    $('#recurring').change(function(){
        type = $('#type').val();
        recurring = $('#recurring').val();

        if(type != 2 && recurring == 2 || recurring == 3){
            $('input[id=end_recurrence').prop('disabled', false);
            $('input[id=end_recurrence').next().prop('disabled', false);
            $('input[id=end').prop('disabled', true);
            $('input[id=end').next().prop('disabled', true);
            $('#end_recurrence').show();
            $('#end').hide();
        }else{
            $('input[id=end').prop('disabled', false);
            $('input[id=end').next().prop('disabled', false);
            $('input[id=end_recurrence').prop('disabled', true);
            $('input[id=end_recurrence').next().attr('disabled', true);
            $('#end_recurrence').hide();
            $('#end').show();
        }

    });

    $('#type').change(function() {
        type = $('#type').val();
        if(type != 2){
            $('input[id=group_size').removeAttr('disabled', 'disabled');
            $('input[id=group_size').val(group_size);
        }else{
            $('input[id=group_size').val('');
            $('input[id=group_size').attr('disabled', 'disabled');
        }
    });
    
    toggleElements(type);
    handleWeekDayValidation(recurring, type)
    handleEndRecurrenceDate(type, recurring)

    toggleRecurrence(type, recurring, recurringCustom);

    $('#type, #recurring, #recurring_custom').change(function() {
        type = $('#type').val();
        recurring = $('#recurring').val();
        var customRecurrence = $('#recurring_custom').val();

        toggleElements(type);
        handleWeekDayValidation(recurring, type);
        handleEndRecurrenceDate(type, recurring)
        toggleRecurrence(type, recurring, customRecurrence);
    });
});

</script>

@include('admin.scripts')
