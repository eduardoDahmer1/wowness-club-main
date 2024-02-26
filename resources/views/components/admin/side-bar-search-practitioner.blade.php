@props(['results', 'categories', 'subcategories','methods', 'languages', 'countries', 'services', 'minPrice', 'maxPrice', 'types'])

<form method="GET" class="filter-service" id="search-form">
    <div class="mb-4">
        <h5 class="label-filter">{{__('Search For:')}}</h5>
        <div class="row">
            <div class="col-12">
                <a class="btn_2" href="{{ route('service.search') }}">Service</a>
                <a class="btn_2" href="{{ route('content.search') }}">Content</a>
                <a class="btn_1" href="{{ route('practitioner.search') }}">Practitioner</a>
            </div>
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

    <div class="col-sm-auto py-3 d-flex flex-column">
        <button id="filter_sideSearch" name="q" type="submit" class="btn_1 d-block m-auto" value="{{ request('q', '') }}"> Search Content
        </button>
        <a href="{{ request('q', '') ? '/search?q='.request('q', '') : route('content.search') }}" class="btn_2">Clear filters</a>
    </div>

</form>
