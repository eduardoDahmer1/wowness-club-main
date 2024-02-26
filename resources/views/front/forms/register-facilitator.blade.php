@section('title', 'JOIN WOWNESS CLUB' . ' |')

@push('header')
    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s)

        {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?

                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };

            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';

            n.queue = [];
            t = b.createElement(e);
            t.async = !0;

            t.src = v;
            s = b.getElementsByTagName(e)[0];

            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',

            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '593609789374091');

        fbq('track', 'PageView');

        function textCountDown() {
        const textInputs = document.querySelectorAll('.text-input');

        textInputs.forEach((input, index) => {
            const maxLength = input.getAttribute('maxlength');
            const countCharacter = maxLength - input.value.length;
            const totalCharacterElements = document.querySelectorAll('.total-characters');
            const contadorElement = totalCharacterElements[index];
            contadorElement.textContent = countCharacter;
            console.log(countCharacter);
        });
        }

        document.querySelectorAll('.text-input').forEach(input => {
            input.addEventListener('input', textCountDown);
        });

        textCountDown();
    </script>

    <noscript>

        <img height="1" width="1"
            src="https://www.facebook.com/tr?id=593609789374091&ev=PageView

    &noscript=1" />

    </noscript>
    <!-- End Facebook Pixel Code -->
@endpush

<x-form-steps-layout>
    <div class="container-fluid">
        <div class="row row-height">
            <div class="col-lg-4 background-image p-0"
                data-background="url({{ asset('assets/images/bg-facilitator.png') }})">
            </div>
            <div class="col-lg-6 d-flex flex-column content-right">
                <div class="container my-auto py-5">
                    <div class="row">
                        <div class="col-lg-9 col-xl-7 mx-auto">
                            <div id="wizard_container">
                                <img src="{{ asset('assets/images/wownesslogocolorida.png') }}" alt="Logo Wowness Club"
                                    class="img-fluid px-4">
                                <div id="top-wizard">
                                    <span id="location"></span>
                                    <div id="progressbar"></div>
                                </div>

                                @if (!session()->has('practitioner'))
                                    <div id="top-wizard">
                                        <a href="{{ url('/auth/google/practitioner') }}" style="margin-top: 0px !important;background: #ffffff;color: #000000;padding: 8px;border-radius:6px; border:solid rgba(128, 128, 128, 0.349) 1px;" class="ml-2 w-100 d-flex justify-content-center">
                                            <img class="mr-5 mr-5" src="{{ asset('assets/images/google.png') }}">&nbsp&nbsp&nbsp&nbsp
                                            {{__('Sign Up with Google')}}
                                        </a>
                                    </div>
                                @endif
                                <!-- /top-wizard -->
                                <form id="wrapped" method="POST" action="{{ route('facilitators.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input id="website" name="website" type="text" value="">
                                    <input id="selected_plan" name="selected_plan" type="hidden" value="{{ Request::get('plan') ?? 'free' }}">
                                    <!-- Leave for security protection, read docs for details -->
                                    <div id="middle-wizard">

                                        @if(!session()->has('practitioner'))
                                            <!-- First step-->
                                            <div class="step">
                                                <h3 class="main_question">{{ __('Welcome! Apply to become a practitioner.') }}</h3>
                                                <h3 class="main_question m-0">{{ __('Create your login') }}</h3>
                                                <p style="font-size: 14px;" class="pt-1"><i style="font-size: 12px;" class="bi bi-clock-fill"></i><span class="px-1">Takes 8-10 minutes</span></p>
                                                    <div class="mb-4 form-group">
                                                        <label for="email">{{ __('Email *') }}</label>
                                                        <input type="email" name="email" id="email"
                                                            class="form-control required" value="{{ old('email') }}" />
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label for="password">{{ __('Password *') }}</label>
                                                        <input type="password" name="password" id="password"
                                                            class="form-control required" minlength="8" />
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label for="confirm_password">{{ __('Confirm Password *') }}</label>
                                                        <input type="password" name="confirm_password" id="confirm_password"
                                                            class="form-control required" />
                                                    </div>
                                                    @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    @endif
                                            </div>
                                        @else
                                            <div class="mb-4 form-group">
                                                <input type="hidden" name="email" id="email"
                                                    class="form-control required" value="{{$practitioner->email}}" />
                                            </div>
                                            <div class="mb-4 form-group">
                                                <input type="hidden" name="google_id" id="google_id"
                                                    class="form-control required" value="{{$practitioner->id}}" />
                                            </div>
                                            <div class="mb-4 form-group">
                                                <input type="hidden" name="google_token" id="google_token"
                                                    class="form-control required" value="{{$practitioner->token}}" />
                                            </div>
                                            <div class="form-group mb-4">
                                                <input type="hidden" name="password" id="password"
                                                    class="form-control required" value="{{$practitioner->token}}" minlength="8" />
                                            </div>

                                        @endif
                                                <!-- /step-->

                                        <!-- Step Main Detals -->
                                        @if(!session()->has('practitioner'))
                                            <div class="step">
                                                    <h3 class="main_question">{{ __('Your main details') }}</h3>
                                                    <div class="mb-4 form-group">
                                                        <label class="m-0" for="fullname">{{ __('Full Name *') }}</label>
                                                        <p class="label-info"><small>{{ __('Your real name') }}</small></p>
                                                        <input type="text" name="name" id="fullname"
                                                            value="{{ old('name') }}" class="form-control required"
                                                            minlength="3" />
                                                    </div>
                                                    <div class="mb-4 form-group">
                                                        <label class="m-0"
                                                            for="profilename">{{ __('Profile Name *') }}</label>
                                                        <p class="label-info">
                                                            <small>{{ __('How you would like your name to be displayed on your profile.') }}</small>
                                                        </p>
                                                        <input type="text" name="alias" id="profilename"
                                                            value="{{ old('alias') }}" class="form-control required"
                                                            minlength="3" />
                                                    </div>
                                                    <div class="mb-4 form-group">
                                                        <label class="m-0" for="phone">{{ __('Phone *') }}</label>
                                                        <p class="label-info">
                                                            <small>{{ __('Your phone will not be shown on your profile.') }}</small>
                                                        </p>
                                                        <input type="text" name="phone" id="phone" value="+" oninput="this.value = '+' + this.value.replace('+', '')" class="form-control required" />
                                                    </div>
                                                    <div class="mb-4 form-group">
                                                        <label class="m-0">{{ __('Profile Picture *') }}</label>
                                                        <p class="label-info">
                                                            <small>{{ __('Your best photo, only you, good lighting and quality, showing your face.') }}</small>
                                                        </p>
                                                        <input type="file" name="photo" accept="image/*" required />
                                                    </div>
                                                    <p>Read <a class="link-policy" target="_blank"
                                                        href="https://wownessclub.com/acceptable-use-policy-content-standards-guidelines">
                                                        {{ __('Acceptable Use Policy and Content Standards') }}
                                                    </a></p>
                                            </div>
                                        @else
                                            <div class="step">
                                                <div class="mb-4 form-group">
                                                    <input type="hidden" name="name" id="fullname"
                                                                value="{{ $practitioner->name}}" class="form-control required"
                                                                minlength="3" />
                                                </div>
                                                <div class="mb-4 form-group">
                                                    <label class="m-0"
                                                        for="profilename">{{ __('Profile Name *') }}</label>
                                                    <p class="label-info">
                                                        <small>{{ __('How you would like your name to be displayed on your profile.') }}</small>
                                                    </p>
                                                    <input type="text" name="alias" id="profilename"
                                                        value="{{ old('alias') }}" class="form-control required"
                                                        minlength="3" />
                                                </div>
                                                <div class="mb-4 form-group">
                                                    <label class="m-0" for="phone">{{ __('Phone *') }}</label>
                                                    <p class="label-info">
                                                        <small>{{ __('Your phone will not be shown on your profile.') }}</small>
                                                    </p>
                                                    <input type="text" name="phone" id="phone" value="+" oninput="this.value = '+' + this.value.replace('+', '')" class="form-control required" />
                                                </div>
                                                <div class="mb-4 form-group">
                                                    <label class="m-0">{{ __('Profile Picture *') }}</label>
                                                    <p class="label-info">
                                                        <small>{{ __('Your best photo, only you, good lighting and quality, showing your face.') }}</small>
                                                    </p>
                                                    <input type="file" name="photo" accept="image/*" required />
                                                </div>
                                                <p>Read <a class="link-policy" target="_blank"
                                                    href="https://wownessclub.co.uk/acceptable-use-policy-and-content-standards">
                                                    {{ __('Acceptable Use Policy and Content Standards') }}
                                                </a></p>
                                            </div>

                                            <!-- /step-->
                                        @endif

                                        <!-- Step your address -->
                                        <div class="step">
                                            <h3 class="main_question m-0">{{__("Your Address")}}</h3>
                                            <p class="label-info mb-3"><small>{{__("Don't worry, users will not have access to your address. You can add service specific address when creating a service listing later.")}}</small></p>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="mb-4 form-group">
                                                        <label for="street">{{__("Street")}}</label>
                                                        <input type="text" name="street" value="{{ old('street') }}" id="street" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-4 form-group">
                                                        <label for="number">{{__("Number")}}</label>
                                                        <input type="text" name="number" value="{{ old('number') }}" id="number" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4 form-group">
                                                <label for="city">{{__("City *")}}</label>
                                                <input type="text" name="city" value="{{ old('city') }}" id="city" class="form-control required">
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label for="complement">{{__("State")}}</label>
                                                <input type="text" name="complement" value="{{ old('complement') }}" id="complement" class="form-control">
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label for="zipcode">{{__("ZIP Code")}}</label>
                                                <input type="text" name="zipcode" value="{{ old('zipcode') }}" id="zipcode" class="form-control">
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label for="country">{{__("Country *")}}</label>
                                                <select name="country_id" id="country" class="form-select" data-toggle="select" required>
                                                    <option selected disabled>{{ __('Select your country') }}</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <!-- /step-->

                                        <!-- Step Headline-->
                                        <div class="step">
                                            <h3 class="main_question">{{ __('Your Profile') }}</h3>
                                            <div class="mb-4 form-group">
                                                <label class="m-0" for="headline">{{ __('Headline/Title') }}</label>
                                                <div class="row">
                                                    <p class="label-info mb-3 col-10">
                                                        <small>{{ __('(Be clear and specific. Write short title of what you do)') }}</small>
                                                    </p>
                                                    <small class="total-characters col-2 fw-bold">70</small>
                                                </div>
                                                <textarea oninput="textCountDown()" style="height: 70px !important;" name="headline" id="headline" class="form-control text-input" maxlength="70"
                                                placeholder="Eg. Yoga Teacher & Breathwork Coach">{{ old('headline') }}</textarea>
                                            </div>
                                            <div class="mb-4 form-group">
                                                <label class="m-0"
                                                    for="description">{{ __('Description Bio') }}</label>
                                                <div class="row">
                                                    <p class="label-info mb-3 col-10">
                                                        <small>{{ __('Up to 500 characters') }}</small>
                                                    </p>
                                                    <small class="total-characters col-2 fw-bold">500</small>
                                                </div>
                                                <textarea oninput="textCountDown()" name="bio" id="description" class="text-input form-control" maxlength="500"
                                                        placeholder="Hint: What led you to this work? What are your super powers? What is your experience? Who do you help? What results or transformation can you offer? Why you and your services?">{{ old('bio') }}</textarea>
                                            </div>
                                            <div class="mb-4 form-group">
                                                <label class="m-0" for="spokenlanguage">{{ __('Spoken Languages') }}</label>
                                                <div class="row">
                                                @foreach ($languages as $language)
                                                    <div class="col-lg-6 py-1">
                                                        <input type="checkbox" name="languages[{{ $language->id }}][id]"
                                                            id="language_{{ $language->id }}"
                                                            value="{{ $language->id }}" />
                                                        <label for="language_{{ $language->id }}"
                                                            class="check-styles">{{ $language->name }}</label>
                                                    </div>
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Categories step -->
                                        <div class="step">
                                            <h3 class="main_question m-0">{{ __('Categories') }}</h3>
                                            <p class="label-info mb-3"><small>{{__("Choose categories that make sense with what you offer.")}}</small></p>
                                            <div class="mb-4 form-group">
                                                <div class="row">
                                                    @foreach ($categories as $category)
                                                        <div class="col-md-6 py-1">

                                                            <div class="d-flex align-items-center">
                                                                <div class="checkbox-wrapper-31">
                                                                    <input type="checkbox"
                                                                    name="categories[{{ $category->id }}][id]"
                                                                    data-handle-name="{{ $category->name }}"
                                                                    data-handle-id="category_{{ $category->id }}"
                                                                    id="category_{{ $category->id }}"
                                                                    value="{{ $category->id }}">
                                                                    <svg viewBox="0 0 35.6 35.6">
                                                                        <circle class="background" cx="17.8" cy="17.8" r="17.8"></circle>
                                                                        <circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle>
                                                                        <polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline>
                                                                    </svg>
                                                                </div>
                                                                <label for="category_{{ $category->id }}" style="font-size: 1.1rem;">
                                                                    {{ $category->name }}
                                                                </label>

                                                            </div>

                                                            @if($category->subcategories->count() > 0)
                                                            <ul style="list-style: none;padding-left: 15px;">
                                                                @foreach ($category->subcategories as $subcategory)
                                                                <li>
                                                                    <div class="checkbox-wrapper-31">
                                                                        <input type="checkbox"
                                                                        name="subcategories[{{ $subcategory->id }}][id]"
                                                                        data-handle-name="{{ $subcategory->name }}"
                                                                        data-handle-id="subcategory_{{ $subcategory->id }}"
                                                                        id="subcategory_{{ $subcategory->id }}"
                                                                        value="{{ $subcategory->id }}">
                                                                        <svg viewBox="0 0 35.6 35.6">
                                                                            <circle class="background" cx="17.8" cy="17.8" r="17.8"></circle>
                                                                            <circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle>
                                                                            <polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline>
                                                                        </svg>
                                                                    </div>

                                                                    <label style="font-size: 13px;" for="subcategory_{{ $subcategory->id }}">
                                                                        {{ $subcategory->name }}
                                                                    </label>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step what do offer -->
                                        <div class="step">
                                            <h3 class="main_question">{{ __('Your Profile') }}</h3>

                                            <div class="mb-4 form-group">
                                                <label class="m-0" for="offer">{{ __('What do you offer?') }}</label>
                                                <div class="row">
                                                    <p class="label-info mb-3 col-10">
                                                        <small>{{ __('(List the health conditions, issues or objectives you help your clients overcome. Use key terms and separate them by coma.)') }}</small>
                                                    </p>
                                                </div>
                                                <textarea style="height: 70px !important;" name="offer" id="offer" class="form-control text-input" maxlength="100"
                                                placeholder="E.g. PTSD, Hormones, Hair Loss.">{{ old('offer') }}</textarea>
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label class="m-0" for="help">{{ __('Who do you help?') }}</label>
                                                <div class="row">
                                                    <p class="label-info mb-3 col-10">
                                                        <small>{{ __('(Your Ideal Client....)') }}</small>
                                                    </p>
                                                </div>
                                                <textarea style="height: 70px !important;" name="help" id="help" class="form-control text-input" maxlength="100"
                                                placeholder="E.g. Single mums in their late 40s.">{{ old('help') }}</textarea>
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label class="m-0" for="quote">{{ __('Elevator Pitch') }}</label>
                                                <div class="row">
                                                    <p class="label-info mb-3 col-10">
                                                        <small>{{ __('Up to 100 characters') }}</small>
                                                    </p>
                                                    <small class="total-characters col-2 fw-bold">100</small>
                                                </div>
                                                <textarea oninput="textCountDown()" style="height: 80px !important;" name="quote" id="quote" class="form-control text-input" maxlength="100"
                                                placeholder="E.g. I help [INSERT Gender + Age) suffering from [INSERT condition) to get {INSERT result/benefit) through [INSERT method/expertise].">{{ old('quote') }}</textarea>
                                            </div>

                                        </div>

                                        <!-- Step description, headline, quote-->
                                        <div class="step">
                                            <h3 class="main_question">
                                                {{ __('Qualifications,Specialisation & Experience') }}</h3>

                                            <div class="mb-4 form-group">
                                                <div class="specialisations">
                                                    <label for="specialisations">{{__("Add your specialisations")}}</label>
                                                    <div class="specialisations">
                                                        <button type="button" class="btn btn-form-pract p-1"
                                                            data-handler="newinputformpractitioner" data-ratio="specialisations" data-name="name"
                                                            data-placeholder="E.g. 500 Hours Yoga Teacher Training">+</button>
                                                        <div class="d-flex align-item-center remove-extras box-inputs-dinamic">
                                                            <x-text-input id="specialisations_0"
                                                                name="specialisations[0][name]" type="text"
                                                                class="form-control"
                                                                placeholder="E.g. 500 Hours Yoga Teacher Training" required/>
                                                            <x-input-error class="mt-2" :messages="$errors->get('specialisations.0.name')" />
                                                            <div class="p-1">
                                                            <i onclick="removeExtras()" class="bi bi-trash3-fill btn-extras"></i>
                                                            </div>
                                                        </div>
                                                    @if(isset($user))
                                                        @foreach ($user->specialisations as $specialisation)
                                                            <div class="d-flex align-item-center remove-extras box-inputs-dinamic">
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
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label for="years_experience">{{__("Years of Experience")}}</label>
                                                <select name="years_experience" id="years_experience" class="form-select" data-toggle="select" required>
                                                    <option selected disabled>{{ __('Select your experience') }}</option>
                                                    <option value="< 1 year of experience"> < 1 year of experience </option>
                                                    <option value="1-2 years of experience"> 1-2 years of experience</option>
                                                    <option value="2-5 years of experience"> 2-5 years of experience</option>
                                                    <option value="5+ years of experience"> 5+ years of experience</option>
                                                </select>
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label class="m-0">{{ __('Qualifications/Insurance') }}</label>
                                                <button class="info-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#Qualifications"
                                                    aria-controls="Qualifications">
                                                    <i class="bi bi-info-circle-fill"></i>
                                                </button>
                                                <div id="Qualifications"
                                                    class="accordionInfo accordion-collapse collapse">
                                                    {{ __('This is an optional feature. We recommend this if you work in technical fields to increase your credibility and strengthen your profile.') }}
                                                </div>
                                                <p class="label-info">
                                                    <small>{{ __('Please upload certificates and/or insurance if you work with technical fields.') }}</small>
                                                </p>
                                                <input type="file" name="certificates[]" multiple>
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label for="testimonials">{{__("Testimonials (OPTIONAL)")}}</label>
                                                <div class="testimonials">
                                                    <button type="button" class="btn btn-form-pract p-1"
                                                        data-handler="newinputformpractitioner" data-ratio="testimonials" data-name="name"
                                                        data-placeholder="https://">+</button>
                                                    <div class="d-flex align-item-center remove-extras box-inputs-dinamic">
                                                        <x-text-input id="testimonials_0"
                                                            name="testimonials[0][name]" type="text"
                                                            class="form-control"
                                                            required
                                                            placeholder="https://" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('testimonials.0.name')" />
                                                        <div class="p-1">
                                                        <i onclick="removeExtras()" class="bi bi-trash3-fill btn-extras"></i>
                                                        </div>
                                                    </div>
                                                    @if(isset($user))
                                                        @foreach ($user->testimonials as $testimonial)
                                                            <div class="d-flex align-item-center remove-extras box-inputs-dinamic">
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
                                        </div>
                                        <!-- /step-->

                                        <!-- Step Redes Sociais-->
                                        <div class="step">
                                            <h3 class="main_question">{{__("Leave any socials you wish to share.")}}</h3>
                                            <div class="mb-4 form-group">
                                                <label for="facebook">{{__("Facebook link")}}</label>
                                                <input type="text" name="facebook" value="{{ old('facebook') }}" id="facebook" class="form-control" placeholder="https://facebook.com">
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label for="instagram">{{__("Instagram link")}}</label>
                                                <input type="text" name="instagram" id="instagram" value="{{ old('instagram') }}" class="form-control" placeholder="https://instagram.com">
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label for="linkedin">{{__("Linkedin link")}}</label>
                                                <input type="text" name="linkedin" value="{{ old('linkedin') }}" id="linkedin" class="form-control" placeholder="https://linkedin.com">
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label for="youtube">{{__("Youtube link")}}</label>
                                                <input type="text" name="youtube" value="{{ old('youtube') }}" id="youtube" class="form-control" placeholder="https://youtube.com">
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label for="tiktok">{{__("Tiktok link")}}</label>
                                                <input type="text" name="tiktok" value="{{ old('tiktok') }}" id="tiktok" class="form-control" placeholder="https://tiktok.com">
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label for="twitter">{{__("Twitter link")}}</label>
                                                <input type="text" name="twitter" value="{{ old('twitter') }}" id="twitter" class="form-control" placeholder="https://twitter.com">
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label for="site">{{__("Website link")}}</label>
                                                <input type="text" name="site" value="{{ old('site') }}" id="site" class="form-control" placeholder="https://website.com">
                                            </div>

                                        </div>
                                        <!-- /step-->

                                        <!-- Step submit, terms-->
                                        <div class="step submit">
                                            <h3 class="main_question">
                                                {{ __('Please review and confirm you agree with the following:') }}</h3>

                                            <div class="mb-4 form-group">
                                                    <ul>
                                                        <li><a class="link-policy" href="https://wownessclub.com/terms-and-conditions-practitioners">Terms & Conditions</a></li>
                                                        <li><a class="link-policy" href="https://wownessclub.com/acceptable-use-policy-content-standards-guidelines">Acceptable Use Policy & Content Standards</a></li>
                                                        <li><a class="link-policy" href="https://stripe.com/en-gb/legal/connect-account">Stripe Connected Account Agreement</a></li>
                                                        <li><a class="link-policy" href="https://stripe.com/en-gb/legal/ssa">Stripe Services Agreement </a></li>
                                                        <li><a class="link-policy" href="https://wownessclub.com/privacy-policy">Privacy Policy</a></li>
                                                        <li><a class="link-policy" href="https://wownessclub.com/cookie-policy">Cookie Policy</a></li>
                                                    </ul>

                                            </div>

                                            <div class="form-group terms">
                                                <label class="container_check">{{ __('I agree I have read, consent and agree to the terms above.') }}
                                                    <input required class="link-policy" target="_blank" type="checkbox" name="terms" value="Yes">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                            <div class="form-group terms">
                                                <label class="container_check">{{ __('I agree to stay updated with Wowness Club and subscribe to the newsletter. You can unsubscribe at any time.') }}
                                                    <input class="link-policy" target="_blank" type="checkbox" name="terms" value="Yes">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                        </div>
                                        <!-- /step-->

                                        <!-- bottom-wizard -->
                                        <div id="bottom-wizard">
                                            <button type="button" name="backward"
                                                class="backward">{{ __('Prev') }}</button>
                                            <button type="button" name="forward"
                                                class="forward">{{ __('Next') }}</button>
                                            <button type="submit" name="process"
                                                class="submit">{{ __('Register') }}</button>
                                            <a class="btn btn-primary py-2" href="{{route('login')}}">{{ __('Cancel')}}</a>
                                        </div>
                                        <!-- /bottom-wizard -->
                                    </div>
                                    <!-- /middle-wizard -->
                                </form>
                            </div>
                            <!-- /Wizard container -->
                        </div>
                    </div>
                </div>
                <div class="container pb-4 copy">
                    <span class="float-start">© Wowness Club</span>
                    <!-- <a class="btn_help float-end" href="#modal-help" id="modal_h"><i class="bi bi-question-circle"></i> Help</a><br> -->
                    <a class="btn_help float-end" href="https://practitioners-application.wownessclub.com/"><i
                            class="bi bi-question-circle"></i> {{ __('Help') }}</a><br>
                    <div class="social mobile ">
                        <ul>
                            <li><a href="https://www.facebook.com/wownessclub"><i class="bi bi-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/wownessclub/"><i class="bi bi-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!-- /social -->
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

</x-form-steps-layout>

<style>

.specialisations, .testimonials {
    position: relative;
    padding-top: 10px;
}

.btn-form-pract {
    position: absolute;
    right: 0;
    top: -35px;
    font-size: 1.4rem;
}

.btn-extras {
    position: relative;
    top: 8px;
    color: #f02424;
}


.checkbox-wrapper-31:hover .check {
  stroke-dashoffset: 0;
}

.checkbox-wrapper-31 {
  position: relative;
  display: inline-block;
  width: 20px;
  height: 30px;
  margin-right: 5px;
}

.checkbox-wrapper-31 .background {
  fill: #ccc;
  transition: ease all 0.6s;
  -webkit-transition: ease all 0.6s;
}

.checkbox-wrapper-31 .stroke {
  fill: none;
  stroke: #fff;
  stroke-miterlimit: 10;
  stroke-width: 2px;
  stroke-dashoffset: 100;
  stroke-dasharray: 100;
  transition: ease all 0.6s;
  -webkit-transition: ease all 0.6s;
}

.checkbox-wrapper-31 .check {
  fill: none;
  stroke: #fff;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-width: 2px;
  stroke-dashoffset: 22;
  stroke-dasharray: 22;
  transition: ease all 0.6s;
  -webkit-transition: ease all 0.6s;
}

.checkbox-wrapper-31 input[type=checkbox] {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  margin: 0;
  opacity: 0;
  -appearance: none;
  -webkit-appearance: none;
}

.checkbox-wrapper-31 input[type=checkbox]:hover {
  cursor: pointer;
}

.checkbox-wrapper-31 input[type=checkbox]:checked + svg .background {
  fill: #6cbe45;
}

.checkbox-wrapper-31 input[type=checkbox]:checked + svg .stroke {
  stroke-dashoffset: 0;
}

.checkbox-wrapper-31 input[type=checkbox]:checked + svg .check {
  stroke-dashoffset: 0;
}

</style>

@include('admin.scripts')

<script>

    var email  = document.getElementById("email");
    email.focus();


    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
    history.pushState(null, null, document.URL);
    });

</script>
