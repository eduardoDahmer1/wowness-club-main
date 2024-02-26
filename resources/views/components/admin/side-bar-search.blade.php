@props(['results', 'categories', 'subcategories','methods', 'languages', 'countries', 'services', 'minPrice', 'maxPrice', 'types'])

<form method="GET" class="filter-service" id="search-form">
    <div class="mb-4">
        <h5 class="label-filter">{{__('Search For:')}}</h5>
        <div class="row">
            <div class="col-12">
                <a class="btn_1" href="{{ route('service.search') }}">Service</a>
                <a class="btn_2" href="{{ route('content.search') }}">Content</a>
                <a class="btn_2" href="{{ route('practitioner.search') }}">Practitioner</a>
            </div>
        </div>
    </div>

    <div class="mb-2">
        <h5 class="label-filter">{{__('Location')}}</h5>
        <div class="row">
            <div class="col-12">
                <div class="custom_select">
                    <select class="wide" name="country_id" id="country_id" required data-toggle="select">
                        <option selected disabled>Select</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @selected(request("country_id") == $country->id)>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <h5 class="label-filter">{{__('Date')}}</h5>

        <div class="row">
            <div class="col-12">
                <input type="date" class="flatpickr form-control" placeholder="Select the period" data-default-date="{{request('startDate', '')}}, {{request('endDate', '')}}">
            </div>
            <input type="hidden" name="startDate" id="start" class="form-control"
                        placeholder="Choose start date" value="{{ request('startDate', '') }}">
            <input type="hidden" name="endDate" id="end" class="form-control"
            placeholder="Choose end date" value="{{ request('endDate', '') }}">
        </div>

    </div>

    <div class="form-group">
        <h5 class="label-filter">{{__('Categories')}}</h5>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-12 d-flex align-items-center pt-2">
                    <div style="padding-right: 5px;" class="check-styles">
                        <input type="checkbox" name="categories[{{ $category->id }}][id]"
                        data-handle-name="{{ $category->name }}" data-handle-id="category_{{ $category->id }}"
                        id="category_{{ $category->id }}" value="{{ $category->id }}"
                        {{ request("categories.$category->id.id") ? 'checked' : '' }}/>
                    </div>
                    <label class="wrap-texto" for="category_{{ $category->id }}">
                        <img class="pe-1" width='22px' src="{{ asset('storage/' . $category->icon) }}"
                            alt="">
                        {{$category->name}}
                    </label>
                </div>
                <div class="d-flex flex-wrap">
                    @foreach ($category->subcategories as $subcategory)
                        <div class="col-6 d-flex justify-content-left px-3">
                            <input type="checkbox" name="subcategories[{{ $subcategory->id }}][id]"
                                data-handle-name="{{ $subcategory->name }}" data-handle-id="subcategory_{{ $subcategory->id }}"
                                id="subcategory_{{ $subcategory->id }}" value="{{ $subcategory->id }}"
                                {{ request("subcategories.$subcategory->id.id") ? 'checked' : '' }}/>
                            <label class="wrap-texto" for="subcategory_{{ $subcategory->id }}">
                                <img class="px-1" width='22px' src="{{ asset('storage/' . $subcategory->icon) }}"
                                    alt="">
                                {{$subcategory->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group">
        <h5 class="label-filter">{{__('Goals ')}}</h5>
        <div class="row">
            @foreach ($results as $result)
                <div class="col-12 d-flex align-items-center">
                    <div style="padding-right: 5px;" class="check-styles">
                        <input type="checkbox" name="results[{{ $result->id }}][id]"
                            id="result_{{ $result->id }}" value="{{ $result->id }}"
                            {{ request("results.$result->id.id") ? 'checked' : '' }} />
                    </div>
                    <label class="wrap-texto" for="result_{{ $result->id }}">
                        <img class="pe-1" src="{{ $result->icon }}" width="22px">
                        {{ $result->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group">
        <h5 class="label-filter">{{__('Method')}}</h5>
        <div class="row">
            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="online" name="methods[1]" value="1"
                    {{ request('methods.1') ? 'checked' : '' }}>
                <label for="online">{{ __('Online') }}</label>
            </div>

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="inperson" name="methods[2]" value="2"
                    {{ request('methods.2') ? 'checked' : '' }}>
                <label for="inperson">{{ __('In-Person') }}</label>
            </div>
        </div>
        <x-input-error class="mt-2" :messages="$errors->get('method')" />
    </div>

    <div class="form-group">
        <h5 class="label-filter">{{__('Type')}}</h5>
        <div class="row">
            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="group" name="types[1]" value="1"
                    {{ request('types.1') ? 'checked' : '' }}>
                <label for="group">{{ __('Group') }}</label>
            </div>

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="individual" name="types[2]" value="2"
                    {{ request('types.2') ? 'checked' : '' }}>
                <label for="individual">{{ __('Individual') }}</label>
            </div>

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="course" name="types[3]" value="3"
                    {{ request('types.3') ? 'checked' : '' }}>
                <label for="course">{{ __('Course') }}</label>
            </div>

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="retreat" name="types[4]" value="4"
                    {{ request('types.4') ? 'checked' : '' }}>
                <label for="retreat">{{ __('Retreat') }}</label>
            </div>
        </div>
        <x-input-error class="mt-2" :messages="$errors->get('type')" />
    </div>

    <div class="form-group">
        <h5 class="label-filter">{{__('Aimed For')}}</h5>
        <div class="row">

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="menOnly" name="aimeds[1]" value="1"
                    {{ request('aimeds.1') ? 'checked' : '' }}>
                <label for="menOnly">{{ __('Men Only') }}</label>
            </div>

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="gayWoman" name="aimeds[2]" value="2"
                    {{ request('aimeds.2') ? 'checked' : '' }}>
                <label for="gayWoman">{{ __('Gay Woman') }}</label>
            </div>

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="gayMen" name="aimeds[3]" value="3"
                    {{ request('aimeds.3') ? 'checked' : '' }}>
                <label for="gayMen">{{ __('Gay Men') }}</label>
            </div>

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="couple" name="aimeds[4]" value="4"
                    {{ request('aimeds.4') ? 'checked' : '' }}>
                <label for="couple">{{ __('Couple') }}</label>
            </div>

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="womenOnly" name="aimeds[5]" value="5"
                    {{ request('aimeds.5') ? 'checked' : '' }}>
                <label for="womenOnly">{{ __('Women Only') }}</label>
            </div>

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="single" name="aimeds[6]" value="6"
                    {{ request('aimeds.6') ? 'checked' : '' }}>
                <label for="single">{{ __('Single') }}</label>
            </div>

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="anyone" name="aimeds[7]" value="7"
                    {{ request('aimeds.7') ? 'checked' : '' }}>
                <label for="anyone">{{ __('Anyone') }}</label>
            </div>

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="corporate" name="aimeds[8]" value="8"
                    {{ request('aimeds.8') ? 'checked' : '' }}>
                <label for="corporate">{{ __('Corporate') }}</label>
            </div>

        </div>
        <x-input-error class="mt-2" :messages="$errors->get('aimed')" />
    </div>

    <div class="form-group">
        <h5 class="label-filter">{{__('Target')}}</h5>

        <div class="row">
            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="seekers" name="targets[1]" value="1"
                    {{ request('targets.1') ? 'checked' : '' }}>
                <label for="seekers">{{ __('Seekers') }}</label>
            </div>

            <div class="col-lg-6 check-styles">
                <input type="checkbox" id="facilitators" name="targets[2]" value="2"
                    {{ request('targets.2') ? 'checked' : '' }}>
                <label for="facilitators">{{ __('Facilitator') }}</label>
            </div>

        </div>
        <x-input-error class="mt-2" :messages="$errors->get('target')" />
    </div>

    <div class="form-group">
        <h5 class="label-filter">{{__('Language')}}</h5>
        <div class="row">
            @foreach ($languages as $language)
                <div class="col-lg-6 check-styles py-1">
                    <input type="checkbox" name="languages[{{ $language->id }}][id]"
                        id="language_{{ $language->id }}"
                        value="{{ $language->id }}"{{ request("languages.$language->id.id") ? 'checked' : '' }} />
                    <label for="language_{{ $language->id }}">{{ $language->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group">
        <h5 class="label-filter">{{__('Price')}}</h5>
        <div class="row">
            <div class="col-12 pb-2">
                <input id="range"
                type="range"
                min="{{ $minPrice }}"
                max="{{ $maxPrice }}"
                value="{{ $maxPrice }}"
                oninput="rangevalue.value=value" />
            </div>
            <div class="col-6">
                <p class="m-0 text-muted">{{__('Min Price')}}</p>
                <input value="{{ request('minPrice', '') ? request('minPrice', '') : $minPrice }}" type="number" name="minPrice"
                    id="priceMin" style="width: 100px;">
            </div>
            <div class="col-6 d-flex justify-content-end">
                <div>
                    <p class="m-0 text-muted">{{__('Max Price')}}</p>
                    <input value="{{ request('maxPrice', '') ? request('maxPrice', '') : $maxPrice }}" type="number" name="maxPrice"
                    id="rangevalue" style="width: 100px;" oninput="range.value=value">
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-auto py-3 d-flex flex-column">
        <button id="filter_sideSearch" name="q" type="submit" class="btn_1 d-block m-auto" value="{{ request('q', '') }}"> Search Service
        </button>
        <a href="{{ request('q', '') ? '/search?q='.request('q', '') : route('service.search') }}" class="btn_2">Clear filters</a>
    </div>

</form>
