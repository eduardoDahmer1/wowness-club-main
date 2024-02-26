<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('specificmetatags', \View::make('front.layouts.defaultmetatags'))
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel='icon' type='image/png' href="{{asset('assets/images/iconwowness.png')}}">
    <link rel='icon' sizes='192x192' href="{{asset('assets/images/iconwowness.png')}}">
    <link rel='apple-touch-icon' href="{{asset('assets/images/iconwowness.png')}}">
    <meta name='msapplication-square310x310logo' content="{{asset('assets/images/iconwowness.png')}}">

    <!-- GOOGLE WEB FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('assets/front/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/style.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/front/css/vendors.min.css')}}" rel="stylesheet">

    <!-- SEPCIFIC CSS -->
    <link href="{{ asset('assets/front/css/flex_slider.css')}}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('assets/front/css/custom.css')}}" rel="stylesheet">

    <!--Flatpickr-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- SimpleLightBox -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/simple-lightbox.min.css')}}">
    <script src="{{ asset('assets/front/js/simple-lightbox.min.js')}}"></script>

    <!-- Filepond -->
    <link href="{{ asset('assets/admin/css/filepond.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/filepond-plugin-image-preview.min.css') }}" rel="stylesheet" />

    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        const userWowness = {!! Auth::check() ? Auth::user() : 0 !!};
        const userMember = false
    </script>

    @stack('head')

    @include('new-calendar.scripts-calendar-modal')

    <!-- Disable Analytic Cookies -->
    <script>window['ga-disable-G-XFH5YHST2Q'] = true; </script>


</head>

<body class="datepicker_mobile_full">

    @if(Auth::check())
    <!-- React Authentication -->
    <div id="Authentication" class="d-none"></div>
    @endif

    @if(session('msg'))
    <div id="poPup">
        <button class="bt-close"><i class="bi bi-x-lg"></i></button>
        <div class="msg-bg d-flex align-items-center">
            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_zwkm4xbs.json"  background="transparent"  speed="1"  style="width: 70px; height: 70px;"  loop autoplay></lottie-player>
            <span class="msg">{{ session('msg') }}</span>
        </div>
    </div>
    @endif
    @yield('content')

    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Page Preload -->

    <div class="layer"></div><!-- Opacity Mask -->

    {{ $slot }}

    <footer style="z-index: 1;" class="revealed">
        <div class="footer_bg">
            {{-- {{ <div class="gradient_over"></div> }} --}}
        </div>
        <div class="container">
            <div class="row move_content">
                <div class="col-lg-3 col-md-12">
                    <img src="{{asset('assets/images/wownesslogocolorida.png')}}" width="250px" class="img-fluid pb-2" alt="Logo WownessClub Colorida">
                    <p>A community of vetted practitioners offering holistic health and wellness content, services, events and retreats.</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Company</h5>
                    <div class="footer_links">
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="https://practitioners-application.wownessclub.com/">Become a Practitioner</a></li>
                            <li><a href="https://open.spotify.com/show/5JbEIR2FinWWNSKZKJrem6?si=0342c5652aa24fa0" target="_blank">Wowness Club Podcast</a></li>
                            <li><a href="{{ route('posts.blog')}}">Blog</a></li>
                        </ul>
                    </div>

                    <h5>Contacts</h5>
                    <ul class="m-0">
                        <li><strong><a href="mailto:info@wownessclub.com">info@wownessclub.com</a></strong></li>
                    </ul>
                    <div class="social">
                        <ul>
                            <li><a target="_blank" href="https://www.instagram.com/wownessclub/"><i class="bi bi-instagram"></i></a></li>
                            <li><a target="_blank" href="https://www.youtube.com/@wownessclub"><i class="bi bi-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5>Resources</h5>
                    <div class="footer_links">
                        <ul>
                            <li><a href="https://help.wownessclub.com/practitioners-faq">FAQs (Practitioners/Supplier)</a></li>
                            <li><a href="#">FAQs (Users and Purchaser)</a></li>
                            <li><a href="#">Cancellation & Refund Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5>Legal</h5>
                    <div class="footer_links">
                        <ul>
                            <li><a target="_blank" href="{{ route('terms.of.use') }}">Terms of Use</a></li>
                            <li><a target="_blank" href="{{ route('terms.and.conditions.customers') }}">Terms & Conditions Customers</a></li>
                            <li><a target="_blank" href="{{ route('terms.and.conditions.practitioners') }}">Terms & Conditions Practitioners</a></li>
                            <li><a target="_blank" href="{{ route('acceptable.use.policy.content.standards.guidelines') }}">Acceptable Use Policy, Content Standards & Guidelines</a></li>
                            <li><a target="_blank" href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                            <li><a target="_blank" href="{{ route('cookie.policy') }}">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!--/row-->
        </div>
        <!--/container-->
        <div class="copy">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        © Wowness Club - Holistic Health and Wellness.
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /footer -->

    @if(Auth::check())
    <div id="ModalChatHandler"></div>
    @endif

    <!-- Modal Newsletter -->
    <!-- Modal -->
    <div class="modal fade" id="newsletterModal" tabindex="-1" aria-labelledby="newsletterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-0">
                <div class="box-modal-newsletter">
                    <button style="position: absolute;right: 1rem;top: 1rem;z-index: 2;"
                    type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="content">
                        <h2>Subscribe to our newsletter</h2>
                        <p>To receive updates, latest news, and content around holistic health & wellness.</p>
                        <form id="form-newsletter">
                            <div class="input-group mb-3">
                                <input id="namenewsletter" type="text" name="name" required class="form-control" placeholder="Name" aria-label="name">
                            </div>

                            <div class="input-group mb-3">
                                <input id="emailnewsletter" type="email" required name="email" class="form-control" placeholder="Email address" aria-label="email">
                            </div>

                            <div class="input-group mb-3">
                                <input id="citynewsletter" type="text" name="city" class="form-control" placeholder="City" aria-label="city">
                            </div>

                            <div class="mb-3">
                                <p class="m-0">What best describes you?</p>
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input class="form-check-input" id="practitioner" type="radio" name="best_describes" value="practitioner">
                                            <label class="form-check-label" for="practitioner">Practitioner</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input class="form-check-input" id="seeker" type="radio" name="best_describes" value="seeker">
                                            <label class="form-check-label" for="seeker">Seeker</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" id="terms" required type="checkbox" name="terms">
                                <label class="form-check-label" for="terms">I accept the <a href="#">Terms & Conditions, Privacy Policy, Cookie Policy.</a></label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" required id="occasionalupdates" type="checkbox" name="occasionalupdates">
                                <label class="form-check-label" for="occasionalupdates">I agree to receive occasional updates.</label>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn_1 my-3" id="buttonsubmitNewsletter" type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="d-flex justify-content-between w-100 mb-3">
                <div class="col-6 position-relative text-center border-bottom border-active pb-2">
                    <label style="font-size: 18px; font-weight: 600; cursor:pointer;" class="w-100 m-0 text-uppercase" for="signin">Sign In</label>
                    <input style="opacity: 0;" class="position-absolute" id="signin" type="radio" name="login" value="1">
                </div>

                <div class="col-6 position-relative text-center border-bottom pb-2">
                    <label style="font-size: 18px; font-weight: 600; cursor:pointer;" class="w-100 m-0 text-uppercase" for="signup">Sign Up</label>
                    <input style="opacity: 0;" class="position-absolute" id="signup" type="radio" name="login" value="2">
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <x-application-logo style="width: 300px;margin-bottom: 1rem;"/>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('modal.login') }}" class="form-login-modal">
                @csrf
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email Address')" />
                    <div class="input-group input-group-merge">
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="jhoe@example.com" />
                        <div class="input-group-prepend mt-2">
                            <div class="input-group-text">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('email')" />
                </div>
                <div class="form-group">
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="input-group input-group-merge">
                        <x-text-input  id="password"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" placeholder="Enter your password" />
                        <div class="input-group-prepend mt-2">
                            <div class="input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </div>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" />
                </div>
                <div class="form-group mb-5">
                    <div class="custom-control custom-checkbox">
                        <input id="remember_me" type="checkbox" name="remember" class="custom-control-input" checked >
                        <label class="custom-control-label" for="remember_me">{{ __('Remember me') }}</label>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn-block btn_1 mb-3">
                        {{ __('Login') }}
                    </button>

                    <p>Don't have an account?
                        <a style="color: #658854 !important;font-weight: bold;" class="text-body text-underline" href="{{ route('preregister') }}">Sign up!</a>
                    </p>
                </div>
            </form>
            <div class="form-group text-center">
                <a href="{{ url('auth/google') }}" style="margin-top: 0px !important;background: #ffffff;color: #000000;padding: 8px;border-radius:6px; border:solid rgba(128, 128, 128, 0.445) 1px;" class="btn-block">
                    <img class="mr-5" src="{{ asset('assets/images/google.png') }}">
                        {{__('Login with google')}}
                </a>

                <br><br>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <br>
            </div>
            <div class="div-up d-none pb-4">
                <div class="box-login">
                    <h3 class="p-4 text-center">Start your journey</h3>
                    <div class="row justify-content-center">
                        <div class="col-auto px-1">
                            <a href="{{ route('seeker.create') }}" class="btn_1">Sign up as seeker</a>
                        </div>
                        <div class="col-auto px-1">
                            <a href="{{ route('facilitators.create') }}" class="btn_1">Sign up a practitioner</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div-up d-none pb-4">
                <div class="box-login">
                    <h3 class="p-4 text-center">Start your journey</h3>
                    <div class="row justify-content-center">
                        <div class="col-auto px-1">
                            <a href="{{ route('seeker.create') }}" class="btn_1">Sign up as seeker</a>
                        </div>
                        <div class="col-auto px-1">
                            <a href="{{ route('facilitators.create') }}" class="btn_1">Sign up a practitioner</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToastErrorStartChat" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="box-shadow: none;border: none;">
            <div class="toast-body d-flex align-items-center" style="background-color: #e83a3a;border-radius: 10px;">
            <strong class="me-auto" style="color:#fff;">You cannot start a chat with yourself</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <div id="liveToastErrorFollow" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="box-shadow: none;border: none;">
            <div class="toast-body d-flex align-items-center" style="background-color: #e83a3a;border-radius: 10px;">
            <strong class="me-auto" style="color:#fff;">You can't follow yourself</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <div id="liveToastUserNotRegistered" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="box-shadow: none;border: none;">
            <div class="toast-body d-flex align-items-center" style="background-color: #e83a3a;border-radius: 10px;">
            <strong class="me-auto" style="color:#fff;">This user cannot be followed or started chat yet, please try later </strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    @include('cookie-consent::index')
    <!-- /back to top -->

    <!-- COMMON SCRIPTS -->
    <script src="{{ asset('assets/front/js/common_scripts.js')}}"></script>
    <script src="{{ asset('assets/front/js/common_functions.js')}}"></script>
    <script src="{{ asset('assets/front/js/validate.js')}}"></script>

    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('assets/front/js/jquery.flexslider.min.js')}}"></script>
    <script src="{{ asset('assets/front/js/slider_func.js')}}"></script>

    <!--Filepond-->
    <script src="{{ asset('assets/admin/js/filepond-plugin-file-validate-size.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/filepond-plugin-file-validate-type.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/filepond-plugin-image-preview.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/filepond.min.js')}}"></script>

    <!--FUNCTIONS OF APLICATION-->
    <script src="{{ asset('assets/front/js/scripts.js')}}"></script>

    <!--LOTTIE FILES-->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


    <style>

        #poPup {
            position: absolute;
        }

        .bt-close {
            background: none;
            border: none;
            position: relative;
            left: 40px;
            top: 30px;
            z-index: 10000;
            color: #7B9A6C;
            font-size: 18px;
        }

        .msg-bg {
            position: fixed;
            background: #ffffff;
            font-size: 22px;
            text-align: center;
            font-weight: 600;
            padding: 35px;
            border-radius: 6px;
            z-index: 1000;
            left: 30px;
            top: 20px;
            box-shadow: 0 0 17px 2px #8ebf76ac;
        }

        .msg {
            margin: 0;
            color: #7B9A6C;
            padding-right: 10px;
        }

        @media (max-width: 550px) {
            .msg-bg {
                font-size: 18px;
                margin: 10px;
                left: 0px;
            }
            .bt-close {
            left: 15px;
            top: 35px;
            }
        }
        .border-active {
            border-bottom: 2px solid #7B9A6C !important;
        }
        .border-active {
            border-bottom: 2px solid #7B9A6C !important;
        }
    </style>

    <script>

        const btNfechar = document.querySelector('.bt-close')

        if (btNfechar) {
            btNfechar.addEventListener('click', function (event) {
                const poPup = document.querySelector('#poPup')
                poPup.style.display = 'none';
            })
        }

        if (window.sessionStorage.getItem('subscribeNewsletter')) {
            let content = `
                <h2>You are already part of our newsletter list.</h2>
                <p>To receive updates, latest news, and content around holistic health wellness.</p>
            `
            $('.box-modal-newsletter .content').html(content)
        }

        $('#form-newsletter').on('submit', (e) => {
            e.preventDefault()

            let name = $("#namenewsletter").val();
            let email = $("#emailnewsletter").val();
            let city = $("#citynewsletter").val();
            let best_describes = $("input[name=best_describes]:checked").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '{!! route('newsletter.store') !!}',
                data: {name, email, city, best_describes},
                success:function(response)
                    {
                        window.sessionStorage.setItem('subscribeNewsletter','yes')
                        let content = `
                            <img src="https://cdn-icons-png.flaticon.com/128/5974/5974759.png" style="display:block;margin:auto;width:50px;padding-bottom:10px;" alt="Subscribe Newsletter"/>
                            <h2 class="text-center">Thank you for subscribing to our newsletter!</h2>
                            <p class="text-center">Stay up to date with Wowness news.</p>
                        `
                        $('.box-modal-newsletter .content').html(content)
                    },
                error: function(response) {
                        $('#buttonsubmitNewsletter').html('An error occurred, try again later')
                        $('#buttonsubmitNewsletter').attr('disabled', 'true')
                    }
            });

        })

    </script>
    <script>
        var inputsLogin = document.querySelectorAll('input[type="radio"][name="login"]')
        var formLogin = document.querySelector('.form-login-modal')
        var divGoogle = formLogin.nextElementSibling
        var divBtn = document.querySelector('.div-up')

        inputsLogin.forEach(function(input) {
            
            input.addEventListener('change', function() {
                
                inputsLogin.forEach(function(otherInput) {
                    otherInput.parentNode.classList.remove('border-active');
                });
                
            if (input.checked) {
                    if (input.value == 2) {
                        formLogin.classList.add('d-none');
                        divGoogle.classList.add('d-none')
                        divBtn.classList.replace('d-none', 'd-block');
                    }

                    if (input.value == 1) {
                        formLogin.classList.remove('d-none');
                        divGoogle.classList.remove('d-none');
                        divBtn.classList.replace('d-block', 'd-none');
                    }
                    input.parentNode.classList.add('border-active');
                }
            });
        });
    </script>
</body>
</html>
