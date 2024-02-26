@section('title', 'Wowness Seeker Sign Up')

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
                                        <a href="{{ url('auth/google/seeker') }}" style="margin-top: 0px !important;background: #ffffff;color: #000000;padding: 8px;border-radius:6px; border:solid rgba(128, 128, 128, 0.445) 1px;" class="ml-2 w-100 d-flex justify-content-center">
                                            <img class="mr-5" src="{{ asset('assets/images/google.png') }}">&nbsp&nbsp&nbsp&nbsp
                                                {{__('Sign Up with Google')}}
                                        </a>
                                    </div>
                                @endif
                                
                                <!-- /top-wizard -->
                                <form id="wrapped" method="POST" action="{{ route('seeker.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input id="website" name="website" type="text" value="">
                                    <!-- Leave for security protection, read docs for details -->
                                    <div id="middle-wizard">
                                        <div>
                                            <h3 class="main_question">
                                                {{ __("Welcome! To start, let's create your login.") }}</h3>
                                            @if (!session()->has('practitioner'))
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
                                                    <label
                                                        for="password_confirmation">{{ __('Confirm Password *') }}</label>
                                                    <input type="password" name="password_confirmation"
                                                        id="password_confirmation" class="form-control required" />
                                                </div>
                                                <div class="mb-4 form-group">
                                                    <label class="m-0" for="fullname">{{ __('Full Name *') }}</label>
                                                    <p class="label-info"><small>{{ __('Your real name') }}</small></p>
                                                    <input type="text" name="name" id="fullname"
                                                        value="{{ old('name') }}" class="form-control required"
                                                        minlength="3" />
                                                </div>
                                            @else  
                                                <div class="mb-4 form-group">
                                                    <input type="hidden" name="email" id="email"
                                                        class="form-control required" value="{{$seeker->email}}" />
                                                </div>
                                                <div class="form-group mb-4">
                                                    <input type="hidden" name="password" id="password"
                                                        class="form-control required" value="{{$seeker->token}}" minlength="8" />
                                                </div>
                                                <div class="mb-4 form-group">
                                                    <input type="hidden" name="name" id="fullname"
                                                        value="{{$seeker->name}}" class="form-control required" minlength="3" />
                                                </div>
                                                <div class="mb-4 form-group">
                                                    <input type="hidden" name="google_id" id="google_id"
                                                        class="form-control required" value="{{$seeker->id}}" />
                                                </div>
                                                <div class="mb-4 form-group">
                                                    <input type="hidden" name="google_token" id="google_token"
                                                        class="form-control required" value="{{$seeker->token}}" />
                                                </div>
                                                <div class="mb-4 form-group">
                                                    <input type="hidden" name="password_confirmation"
                                                            id="password_confirmation" value="{{$seeker->token}}" class="form-control required" />
                                                </div>
                                                
                                            @endif
                                            <div class="mb-4 form-group">
                                                <label class="m-0" for="phone">{{ __('Phone') }}</label>
                                                <p class="label-info">
                                                    <small>{{ __('Your phone will not be shown on your profile.') }}</small>
                                                </p>
                                                <input type="text" name="phone" id="phone" value="+" oninput="this.value = '+' + this.value.replace('+', '')" class="form-control" />
                                            </div>
                                            <div class="mb-4 form-group">
                                                <label for="city">{{__("City")}}</label>
                                                <input type="text" name="city" value="{{ old('city') }}" id="city" class="form-control">
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
                                                <label class="m-0">{{ __('Profile Picture') }}</label>
                                                <p class="label-info">
                                                    <small>{{ __('Your best photo, only you, good lighting and quality, showing your face.') }}</small>
                                                </p>
                                                <input type="file" name="photo" accept="image/*" />
                                            </div>
                                            <div class="submit">    
                                                <div class="text-center">
                                                    <div class="form-group terms">
                                                        <label class="container_check">{{ __('I agree the') }} <a
                                                                class="link-policy" target="_blank"
                                                                href="https://wownessclub.co.uk/terms-conditions-for-users-customers">{{ __('Terms & Conditions') }}</a>,
                                                                <a
                                                                class="link-policy" target="_blank"
                                                                href="https://wownessclub.co.uk/cookie-and-privacy-policy">{{ __('Cookie & Privacy Policy') }}</a>,
                                                                <a
                                                                class="link-policy" target="_blank"
                                                                href="https://stripe.com/en-gb/legal/ssa">{{ __('Stripe Services Agreement') }}</a>.
                                                            <input type="checkbox" name="terms" value="Yes"
                                                                class="required">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>

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
                                        <!-- /step-->
                                    </div>
                                    <!-- /middle-wizard -->
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <!-- <button type="button" name="backward" class="backward">{{ __('Prev') }}</button> -->
                                       
                                        <button type="submit" name="process"
                                            class="submit">{{ __('Register') }}</button>

                                        <a class="btn btn-primary py-2" href="{{route('login')}}">{{ __('Cancel')}}</a>
                                    </div>
                                   
                                    <!-- /bottom-wizard -->
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
                    <div class="social mobile">
                        <ul>
                            <li><a href="#0"><i class="bi bi-facebook"></i></a></li>
                            <li><a href="#0"><i class="bi bi-twitter"></i></a></li>
                            <li><a href="#0"><i class="bi bi-instagram"></i></a></li>
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

<script>

    var email  = document.getElementById("email");
    email.focus();

    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
    history.pushState(null, null, document.URL);
    });
</script>   
