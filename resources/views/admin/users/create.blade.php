@section('title', 'New Practitioner')

<x-app-layout>
    <div class="mdk-drawer-layout__content page">

        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Practitioner</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">New Agent</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">

            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col-12 card-form__body card-body">
                        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <x-input-label for="photo" :value="__('profile pic *')" />
                                        <x-input-info-label>Size: 1080x1080 | JPG, PNG, JPEG</x-input-info-label>
                                        <input required type="file" name="photo" accept="image/png, image/jpeg, image/jpg">
                                        <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="name" :value="__('Name *')" />
                                                <x-text-input id="name" name="name" type="text"
                                                    class="form-control" :value="old('name')" required />
                                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="alias" :value="__('Profile Name *')" />
                                                <x-input-info-label>Name you would like to display on your profile
                                                </x-input-info-label>
                                                <x-text-input id="alias" name="alias" type="text"
                                                    class="form-control" :value="old('alias')" required />
                                                <x-input-error class="mt-2" :messages="$errors->get('alias')" />
                                            </div>
                                        </div>

                                        @isMaintainer(auth()->user())
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <x-input-label for="position" :value="__('Presentation position *')" />
                                                    <x-text-input id="position" min="0" max="16" name="position" type="number"
                                                        class="form-control" :value="old('position')" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('position')" />
                                                </div>
                                            </div>
                                        @endisMaintainer

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="phone" :value="__('Phone Number *')"/>
                                                <x-text-input id="phone" name="phone" type="text"
                                                    class="form-control" value="+" oninput="this.value = '+' + this.value.replace('+', '')" required />
                                                <x-input-error class="mt-2" :messages="$errors->get('phone')"/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="email" :value="__('Email *')" />
                                                <x-text-input id="email" name="email" type="email"
                                                    class="form-control" :value="old('email')" required />
                                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="password" :value="__('Password')" />
                                                <x-text-input id="password" name="password" type="password"
                                                    class="form-control" :value="old('password')" />
                                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                            </div>
                                        </div>

                                        @isMaintainer(auth()->user())
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                                        <input name="status" type="checkbox" id="checkforUserVerified" class="custom-control-input" value="1">
                                                        <label class="custom-control-label" for="checkforUserVerified">..</label>
                                                    </div>
                                                    <label for="checkforUserVerified" class="mb-0"><small>Verified</small></label>
                                                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                                </div>
                                            </div>
                                        @endisMaintainer


                                        <div class="col-12">
                                            <div class="form-group multiple-files">
                                                <div>
                                                    <input type="checkbox" name="show_certificates"
                                                        id="show_certificates" value="1" >
                                                    <label for="show_certificates"
                                                        class="check-styles">{{__('Show on profile')}}</label>
                                                </div>
                                                <x-input-label for="certificates" :value="__('Qualifications/insurance')" />
                                                <x-input-info-label>This is an optional feature. We recommend this if you work in technical fields to increase your credibility and strengthen your profile.</x-input-info-label>
                                                <input type="file" name="certificates[]" multiple >
                                                <x-input-error class="mt-2" :messages="$errors->get('certificates')" />
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <x-input-label for="headline" :value="__('Headline/Title *')" />
                                        <x-input-info-label>(Be clear and specific. Write short title of what you do).</x-input-info-label>
                                        <x-text-input id="headline" name="headline" type="text" :value="old('headline')"
                                            placeholder="Eg. Yoga Teacher & Breathwork Coach" />

                                        <x-input-error class="mt-2" :messages="$errors->get('headline')" />
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="form-group">
                                        <x-input-label for="bio" :value="__('Description Bio *')" />
                                        <x-input-info-label>Up to 500 characters</x-input-info-label>
                                        <textarea id="bio" name="bio" type="text" class="form-control" rows="4"
                                            placeholder="Hint: What led you to this work? What are your super powers? What is your experience? Who do you help? What results or transformation can you offer? Why you and your services?"
                                            :value="old('bio')"></textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <x-input-label for="offer" :value="__('What do you offer? *')" />
                                        <x-input-info-label>List the health conditions, issues or objectives you help your clients overcome. Use key terms and separate them by coma.</x-input-info-label>
                                        <x-text-input id="offer" name="offer" type="text" :value="old('offer')"
                                            placeholder="E.g. PTSD, Hormones, Hair Loss." />

                                        <x-input-error class="mt-2" :messages="$errors->get('offer')" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <x-input-label for="help" :value="__('Who do you help? *')" />
                                        <x-input-info-label>Your Ideal Client....</x-input-info-label>
                                        <x-text-input id="help" name="help" type="text" :value="old('help')"
                                            placeholder="E.g. Single mums in their late 40s." />

                                        <x-input-error class="mt-2" :messages="$errors->get('help')" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <x-input-label for="quote" :value="__('Elevator Pitch')" />
                                        <x-input-info-label>Up to 100 characters</x-input-info-label>
                                        <x-text-input id="quote" name="quote" type="text" :value="old('quote')"
                                        placeholder="E.g. I help [INSERT Gender + Age) suffering from [INSERT condition) to get {INSERT result/benefit) through [INSERT method/expertise]." maxlength="100"/>

                                        <x-input-error class="mt-2" :messages="$errors->get('quote')" />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <x-input-label :value="__('Spoke Language')" />
                                        <x-input-info-label>Select more than 1 if you offer simultaneous translation
                                        </x-input-info-label>
                                        <div class="row">
                                            @foreach ($languages as $language)
                                                <div class="col-lg-6 py-1">
                                                    <input type="checkbox" name="languages[{{ $language->id }}][id]"
                                                        id="language_{{ $language->id }}"
                                                        value="{{ $language->id }}" {{ isset($user) && $user->languages->contains('id', $language->id) ? 'checked' : '' }}
                                                        @checked(old('languages.'.$language->id.'.id'))/>
                                                    <label for="language_{{ $language->id }}"
                                                        class="check-styles">{{ $language->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

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
                                                            {{ isset($user) && $user->categoriesuser->contains('id', $category->id) ? 'checked' : '' }}/>
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
                                                                    value="{{ $subcategory->id }}" {{ isset($user) && $user->subcategoriesuser->contains('id', $subcategory->id) ? 'checked' : '' }}/>
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

                                <div class="col-lg-6">
                                    <div class="form-group specialisations">
                                        <button type="button" class="btn btn-primary p-2 text-uppercase fw-bold"
                                            data-handler="newinput" data-ratio="specialisations" data-name="name"
                                            data-placeholder="E.g. 500 Hours Yoga Teacher Training">+ new specialisation</button>
                                        <x-tooltip-info id='infospecialisations' :info="__(
                                            'Qualifications, Specialisations or Experience',
                                        )" />
                                        <x-input-info-label>Click to add new specialisations</x-input-info-label>
                                        @if(isset($user))
                                            @foreach ($user->specialisations as $specialisation)
                                                <div class="box-inputs-dinamic d-flex align-items-center">
                                                    <x-text-input id="specialisations_{{ $loop->index }}"
                                                        name="specialisations[{{ $loop->index }}][name]" type="text"
                                                        class="form-control" :value="old('specialisations.' . $loop->index . '.name', $specialisation->name)"
                                                        placeholder="Insert text here" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('specialisations.' . $loop->index . '.name')" />
                                                    <div class="p-1">
                                                        <i onclick="removeExtras()" class="material-icons icon-delete btn-extras" data-ratio="specialisations">delete</i>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group testimonials">
                                        <button type="button" class="btn btn-primary p-2 text-uppercase fw-bold"
                                            data-handler="newinput" data-ratio="testimonials" data-name="name"
                                            data-placeholder="https://">+ new testimonial</button>
                                        <x-tooltip-info id='infotestimonials' :info="__(
                                            'Add testimonials link for youtube',
                                        )" />
                                        <x-input-info-label>Click to add new testimonials</x-input-info-label>
                                        @if(isset($user))
                                            @foreach ($user->testimonials as $testimonial)
                                                <div class="box-inputs-dinamic d-flex align-items-center">
                                                    <x-text-input id="testimonials_{{ $loop->index }}"
                                                        name="testimonials[{{ $loop->index }}][name]" type="text"
                                                        class="form-control" :value="old('testimonials.' . $loop->index . '.name', $testimonial->name)"
                                                        placeholder="Insert text here" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('testimonials.' . $loop->index . '.name')" />
                                                    <div class="p-1">
                                                        <i onclick="removeExtras()" class="material-icons icon-delete btn-extras" data-ratio="testimonials">delete</i>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="years_experience" :value="__('Years of Experience *')" />
                                        <select name="years_experience" id="years_experience" data-toggle="select">
                                            <option selected disabled value="">Select your experience</option>
                                            <option value="<1 year of experience">< 1 year of experience</option>
                                            <option value="1-2 years of experience">1-2 years of experience</option>
                                            <option value="2-5 years of experience">2-5 years of experience</option>
                                            <option value="5+ years of experience">5+ years of experience</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('years_experience')" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="title-forms-defaults">
                                        <h3>Social Links</h3>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-input-label for="instagram" :value="__('Instagram')" />
                                        <x-text-input id="instagram" name="instagram" type="text"
                                            class="form-control" :value="old('instagram')" placeholder="https://instagram.com"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-input-label for="youtube" :value="__('Youtube')" />
                                        <x-text-input id="youtube" name="youtube" type="text"
                                            class="form-control" :value="old('youtube')" placeholder="https://youtube.com"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('youtube')" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-input-label for="tiktok" :value="__('Tiktok')" />
                                        <x-text-input id="tiktok" name="tiktok" type="text"
                                            class="form-control" :value="old('tiktok')" placeholder="https://tiktok.com"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('tiktok')" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-input-label for="facebook" :value="__('Facebook')" />
                                        <x-text-input id="facebook" name="facebook" type="text"
                                            class="form-control" :value="old('facebook')" placeholder="https://facebook.com"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="linkedin" :value="__('Linkedin')" />
                                        <x-text-input id="linkedin" name="linkedin" type="text"
                                            class="form-control" :value="old('linkedin')" placeholder="https://linkedin.com" />
                                        <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="twitter" :value="__('Twitter')" />
                                        <x-text-input id="twitter" name="twitter" type="text"
                                            class="form-control" :value="old('twitter')" placeholder="https://twitter.com" />
                                        <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="site" :value="__('Website')" />
                                        <x-text-input id="site" name="site" type="text"
                                            class="form-control" :value="old('site')" placeholder="https://website.com" />
                                        <x-input-error class="mt-2" :messages="$errors->get('site')" />
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="title-forms-defaults">
                                        <h3>Address</h3>
                                        <x-input-info-label>Don't worry, users will not have access to your address.
                                        </x-input-info-label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="street" :value="__('Street *')" />
                                        <x-text-input id="street" name="street" type="text"
                                            class="form-control" :value="old('street')"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('street')"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="number" :value="__('Number *')" />
                                        <x-text-input id="number" name="number" type="text"
                                            class="form-control" :value="old('number')"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('number')" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="city" :value="__('City *')" />
                                        <x-text-input id="city" name="city" type="text"
                                            class="form-control" :value="old('city')" required/>
                                        <x-input-error class="mt-2" :messages="$errors->get('city')" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="complement" :value="__('State *')" />
                                        <x-text-input id="complement" name="complement" type="text" required
                                            class="form-control" :value="old('complement')" />
                                        <x-input-error class="mt-2" :messages="$errors->get('complement')" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="zipcode" :value="__('Zipcode *')" />
                                        <x-text-input id="zipcode" name="zipcode" type="text"
                                            class="form-control" :value="old('zipcode')"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('zipcode')" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="country_id" :value="__('Country *')" />
                                        <select name="country_id" id="country_id" data-toggle="select" required>
                                            <option value="" selected disabled>Select your country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('country_id')" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row justify-content-center">
                                        <x-success-button>{{ __('Save') }}</x-success-button>
                                        <a style="color:#333;" href="{{ route('users.index') }}"
                                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                            {{ __('Cancel') }}
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
@include('admin.scripts')
