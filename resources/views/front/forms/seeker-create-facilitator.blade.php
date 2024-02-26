@section('title', 'Become a practitioner' . ' |')

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
                                <!-- /top-wizard -->
                                <form id="wrapped" method="POST" action="{{ route('practitioner.dashboard', $user) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input id="website" name="website" type="text" value="">
                                    <!-- Leave for security protection, read docs for details -->
                                    <div id="middle-wizard">

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

                                        </div>
                                        <!-- /step-->

                                        <!-- Step description, headline, quote-->
                                        <div class="step submit">
                                            <h3 class="main_question">
                                                {{ __('Tell us about yourself, your work and qualifications') }}</h3>
                                            <div class="mb-4 form-group">
                                                <label class="m-0" for="headline">{{ __('Headline') }}</label>
                                                <div class="row">
                                                    <p class="label-info mb-3 col-10">
                                                        <small>{{ __('Up to 200 characters') }}</small>
                                                    </p>
                                                    <small class="total-characters col-2 fw-bold">200</small>
                                                </div>
                                                <textarea oninput="textCountDown()" style="height: 100px !important;" name="headline" id="headline" class="form-control text-input" maxlength="200" placeholder="Suggestion: Role + Niche and/or Expertise [E.g. [Mindfulness Teacher] for [female entrepreneurs] suffering from [burnout]">{{ old('headline') }}</textarea>
                                            </div>

                                            <div class="mt-3 form-group">
                                                <label class="m-0"
                                                    for="description">{{ __('Description Bio') }}</label>
                                                <div class="row">
                                                    <p class="label-info mb-3 col-10">
                                                        <small>{{ __('Up to 500 characters') }}</small>
                                                    </p>
                                                    <small class="total-characters col-2 fw-bold">500</small>
                                                </div>
                                                <textarea oninput="textCountDown()" name="bio" id="description" class="text-input form-control" maxlength="500"
                                                        placeholder="Add relevant information about your work.
• Your expertise/specialism.
• Your work style/approach.
• The services you offer.
• Your niche of clients, if any.
• Your overall experience.">{{ old('bio') }}</textarea>
                                            </div>
                                            <div class="mb-4 form-group">
                                                <label class="m-0" for="quote">{{ __('Quote') }}</label>
                                                <div class="row">
                                                    <p class="label-info mb-3 col-10">
                                                        <small>{{ __('Up to 100 characters') }}</small>
                                                    </p>
                                                    <small class="total-characters col-2 fw-bold">100</small>
                                                </div>
                                                <input oninput="textCountDown()" type="text" name="quote" value="{{ old('quote') }}"
                                                    id="quote" placeholder="Share your life motto or mission" class="form-control text-input" maxlength="100">
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
                                                    <small>{{ __('If your discipline require certificates and/or insurance, please upload here.') }}</small>
                                                </p>
                                                <input type="file" name="certificates[]" multiple>
                                            </div>
                            
                                            <div class="text-center">
                                                <div class="form-group terms">
                                                    <label class="container_check">{{ __('I agree the') }} <a class="link-policy" target="_blank" href="https://wownessclub.co.uk/terms-conditions-for-practitioners">{{ __('Terms & Conditions') }}</a>,
                                                            <a class="link-policy" target="_blank" href="https://wownessclub.co.uk/acceptable-use-policy-and-content-standards">{{ __('Acceptable Use Policy and Content Standards') }}</a>,
                                                            <a class="link-policy" target="_blank" href="https://wownessclub.co.uk/cookie-and-privacy-policy">{{ __('Cookie & Privacy Policy') }}</a>,
                                                            <a class="link-policy" target="_blank" href="https://stripe.com/en-gb/legal/connect-account">{{ __('Stripe Connected Account Agreement') }}</a>,
                                                            <a class="link-policy" target="_blank" href="https://stripe.com/en-gb/legal/ssa">{{ __('Stripe Services Agreement') }}</a>.
                                                        <input required class="link-policy" target="_blank" type="checkbox" name="terms" value="Yes">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
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