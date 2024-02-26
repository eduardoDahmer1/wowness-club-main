@section('title', 'New Content')

<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Content</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">@lang('New Content')</h1>
                </div>

            </div>
        </div>
        <div class="container-fluid page__container">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col-12 card-form__body card-body">
                        <form method="POST" action="{{ route('contents.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">

                                @if(isset($content))
                                    <div class="col-12 d-flex justify-content-start text-center">
                                        <div class="alert alert-danger px-5">{{$message}}</div>
                                    </div>
                                @endif

                                <div class="col-lg-12">
                                    <div class="title-forms-defaults">
                                        <h3>Cover Photo*</h3>
                                    </div>
                                    <x-input-info-label>Size: 1080x1080 | JPG, PNG, JPEG</x-input-info-label>
                                    <input required type="file" name="thumbnail"
                                    accept="image/png, image/jpeg, image/jpg">
                                    <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
                                </div>

                                <div class="col-12">
                                    <div class="title-forms-defaults">
                                        <h3>Main Details</h3>
                                    </div>
                                </div>

                                <div class="col-lg-12" id="box-url">
                                    <div class="form-group">
                                        <x-input-label for="url" :value="__('Video URL *')" />
                                        <x-tooltip-info id='infogroup_size' :info="__('Use https:// before the www. link. Example: https://www.youtube.com/yourvideo. Add Vimeo or Youtube link.')" />
                                        <x-text-input id="url" name="url" type="text" class="form-control"
                                            required :value="old('url', isset($content) ? $content->url : '')" placeholder="https://youtube.com/watch?v=Ye45Ds33"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('url')" />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <x-input-label for="title" :value="__('Title *')" />
                                        <x-text-input id="title" name="title" type="text" class="form-control"
                                            required :value="old('title', isset($content) ? $content->title : '')"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <x-input-label for="subtitle" :value="__('Subtitle *')" />
                                        <x-text-input id="subtitle" name="subtitle" type="text" class="form-control"
                                            required :value="old('subtitle', isset($content) ? $content->subtitle : '')"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('subtitle')" />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <x-input-label for="description" :value="__('Description *')" />
                                        <textarea name="description" id="description" class="form-control">{{isset($content) ? $content->description : ''}}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                    </div>
                                </div>

                                @can('viewAny', App\Models\User::class)
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <x-input-label for="practitioner" :value="__('Practitioner *')" />
                                        <select name="practitioner" id="practitioner" data-toggle="select">
                                            <option value="" selected disabled>Select</option>
                                            @foreach($practitioners as $practitioner)
                                                <option value="{{ $practitioner->id }}" {{ (old('practitioner', isset($content) ? $content->user->id : '') == $practitioner->id) ? 'selected' : '' }}>{{ $practitioner->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('practitioner')" />
                                    </div>
                                </div>
                                @endcan

                                {{-- Menus --}}

                                <div class="col-lg-12">
                                    <div class="form-group learns">
                                        <button type="button" class="btn btn-primary p-2 text-uppercase fw-bold"
                                            data-handler="newinput" data-ratio="learns" data-name="learns" data-limit-char="250"
                                            data-placeholder="E.g. [You are going to learn] [how to master the art of being present]">
                                            + What clients will learn?</button>
                                        <x-tooltip-info id='infolearns' :info="__(
                                            'Write on 2nd person (You) OR start with the verb/action (e.g. Master the art of being present).',
                                        )" />
                                        <x-input-info-label>Click to add new option</x-input-info-label>
                                    </div>
                                </div>

                                {{-- /Menus --}}

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button type="button" id="open-list-cat"
                                            class="btn btn-primary p-2 text-uppercase fw-bold">{{ __('+ Categories') }}</button>
                                        <x-tooltip-info id='infoCategorie' :info="__(
                                            'Didn’t find a suitable category? Email us at: support@wownessclub.com and let us know your category.',
                                        )" />
                                        <x-input-info-label>Click to add new categories</x-input-info-label>
                                        <div id="categories-check" class="row"></div>

                                        <div class="list-categ">
                                            <div class="row">
                                                <x-input-info-label class="col-12">Click to select the categories you
                                                    want to relate to the content</x-input-info-label>
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
                                                            {{ isset($content) && $content->categories->contains('id', $category->id) ? 'checked' : '' }}/>
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
                                                                    value="{{ $subcategory->id }}" {{ isset($content) && $content->subcategories->contains('id', $subcategory->id) ? 'checked' : '' }}/>
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
                                            @foreach ($goals as $goal)
                                                <div class="col-lg-4 py-1">
                                                    <input class="check-goals" type="checkbox"
                                                        name="goals[{{ $goal->id }}][id]"
                                                        id="goal_{{ $goal->id }}"
                                                        value="{{ $goal->id }}" {{ isset($content) && $content->goals->contains('id', $goal->id) ? 'checked' : '' }}
                                                        @checked(old('goals.'.$goal->id.'.id'))/>
                                                    <label for="goal_{{ $goal->id }}"
                                                        class="check-styles">{{ $goal->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <x-input-label :value="__('Language')" />
                                        <x-input-info-label>Select more than 1 if you offer simultaneous translation
                                        </x-input-info-label>
                                        <div class="row">
                                            @foreach ($languages as $language)
                                                <div class="col-lg-6 py-1">
                                                    <input type="checkbox" name="languages[{{ $language->id }}][id]"
                                                        id="language_{{ $language->id }}"
                                                        value="{{ $language->id }}" {{ isset($content) && $content->languages->contains('id', $language->id) ? 'checked' : '' }}
                                                        @checked(old('languages.'.$language->id.'.id'))/>
                                                    <label for="language_{{ $language->id }}"
                                                        class="check-styles">{{ $language->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <x-input-label for="type" :value="__('Type of content *')" />
                                        <select name="type" id="type" class="type-content-options" required data-toggle="select">
                                            <option value="" selected disabled>Select</option>
                                            <option value="1" {{ (old('type', isset($content) ? $content->type->value : '') == 1) ? 'selected' : '' }}>{{ __('Classes') }}</option>
                                            <option value="2" {{ (old('type', isset($content) ? $content->type->value : '') == 2) ? 'selected' : '' }}>{{ __('Course') }}</option>
                                            <option value="3" {{ (old('type', isset($content) ? $content->type->value : '') == 3) ? 'selected' : '' }}>{{ __('Talk') }}</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <x-input-label for="cost" :value="__('Cost *')" />
                                        <select name="cost" id="cost" required data-toggle="select">
                                            <option value="" selected disabled>Select</option>
                                            <option value="1" {{ (old('cost', isset($content) ? $content->cost->value : '') == 1) ? 'selected' : '' }}>{{ __('Free') }}</option>
                                            <option value="2" {{ (old('cost', isset($content) ? $content->cost->value : '') == 2) ? 'selected' : '' }}>{{ __('Paid') }}</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('cost')" />
                                    </div>
                                </div>                                

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <x-input-label for="target" :value="__('Target *')" />
                                        <select name="target" id="target" required data-toggle="select">
                                            <option value="" selected disabled>Select</option>
                                            <option value="1" {{ (old('target', isset($content) ? $content->target->value : '') == 1) ? 'selected' : '' }}>{{ __('Seekers') }}</option>
                                            <option value="2" {{ (old('target', isset($content) ? $content->target->value : '') == 2) ? 'selected' : '' }}>{{ __('Facilitators') }}</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('target')" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <x-input-label for="aimed" :value="__('Aimed for *')" />
                                        <select name="aimed" id="aimed" required data-toggle="select">
                                            <option value="" selected disabled>Select</option>
                                            <option value="1" {{ (old('aimed', isset($content) ? $content->aimed->value : '') == 1) ? 'selected' : '' }}>{{ __('Men Only') }}</option>
                                            <option value="2" {{ (old('aimed', isset($content) ? $content->aimed->value : '') == 2) ? 'selected' : '' }}>{{ __('Gay Woman') }}</option>
                                            <option value="3" {{ (old('aimed', isset($content) ? $content->aimed->value : '') == 3) ? 'selected' : '' }}>{{ __('Gay Men') }}</option>
                                            <option value="4" {{ (old('aimed', isset($content) ? $content->aimed->value : '') == 4) ? 'selected' : '' }}>{{ __('Couple') }}</option>
                                            <option value="5" {{ (old('aimed', isset($content) ? $content->aimed->value : '') == 5) ? 'selected' : '' }}>{{ __('Women Only') }}</option>
                                            <option value="6" {{ (old('aimed', isset($content) ? $content->aimed->value : '') == 6) ? 'selected' : '' }}>{{ __('Single') }}</option>
                                            <option value="7" {{ (old('aimed', isset($content) ? $content->aimed->value : '') == 7) ? 'selected' : '' }}>{{ __('Anyone') }}</option>
                                            <option value="8" {{ (old('aimed', isset($content) ? $content->aimed->value : '') == 8) ? 'selected' : '' }}>{{ __('Corporate') }}</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('aimed')" />
                                    </div>
                                </div>

                                <div class="col-lg-12 d-none" id="box-packages">
                                    <div class="form-group packages">
                                        <x-input-label for="price" :value="__('price *')" />
                                        <x-input-info-label>Price to be paid to access the content</x-input-info-label>
                                        <x-text-input id="price"
                                            placeholder="£"
                                            name="price"
                                            type="number"
                                            class="form-control"
                                            :value="old('price', isset($content) ? $content->price : '')" />
                                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                                    </div>
                                </div>

                                <div class="col-lg-12 d-none" id="box-lessons">
                                    <div class="form-group lessons">
                                        <button type="button" class="btn btn-primary p-2 text-uppercase fw-bold"
                                            data-handler="newinputlessons" data-ratio="lessons" data-name="lesson" >+ new lessons</button>
                                        <x-tooltip-info id='infoLessons' :info="__('Add new lessons for course')" />
                                        <x-input-info-label>Click to add new lessons</x-input-info-label>
                                    </div>
                                </div>

                                @can('viewAny', App\Models\Calendar::class)
                                <div class="col-md-12 mt-4">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input name="status" type="checkbox" id="checkforContentsPublished" class="custom-control-input" value="1">
                                            <label class="custom-control-label" for="checkforContentsPublished">..</label>
                                        </div>
                                        <label for="checkforContentsPublished" class="mb-0"><small>Published</small></label>
                                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                    </div>
                                </div>
                                @endcan

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="col-12 py-3">
                                    <div class="d-flex justify-content-center">
                                        <input class="mr-1" type="checkbox" value="1" name="terms"
                                            id="terms" required>
                                        <label for="terms">I agree with the
                                            <a href="https://wownessclub.co.uk/terms-conditions-for-practitioners" target="_blank">{{ __('Terms & Conditions') }}</a>,
                                            <a href="https://stripe.com/en-gb/legal/ssa" target="_blank">{{ __('Stripe Content Agreement') }}</a>,
                                            <a href="https://stripe.com/en-gb/legal/connect-account" target="_blank">{{ __('Stripe Connected Account Agreement') }}</a>.
                                        </label>
                                    </div>
                                </div>
                                <x-success-button>{{ __('Submit for approval') }}</x-success-button>
                                <a style="color:#333;" href="{{ route('contents.index') }}"
                                    class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Cancel') }}
                                </a>
                            </div> <!-- Final da Row -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script src="{{ asset('assets/admin/js/flatpickr.js') }}"></script>

@include('admin.scripts')

<script>

$(document).ready(function() {
    $('#cost').change(function() {
        if ($(this).val() === '2') {
            $('#box-packages').removeClass('d-none');
            $('#price').prop('required', true);
        } else {
            $('#box-packages').addClass('d-none');
            $('#price').prop('required', false);
        }
    });
});
</script>
