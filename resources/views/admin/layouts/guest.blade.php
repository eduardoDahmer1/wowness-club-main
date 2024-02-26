<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- title -->
        <title>Wowness Club Admin - @yield('title', 'Dashboard')</title>
        <meta property='og:title'  content="Wowness Club Admin - @yield('title', 'Dashboard')">
        <meta name='twitter:title' content="Wowness Club Admin - @yield('title', 'Dashboard')">

        <!-- description -->
        <meta name='description'         content='Wowness Club service administration system'>
        <meta property='og:description'  content='Wowness Club service administration system'>
        <meta name='twitter:description' content='Wowness Club service administration system'>
    
        <!-- image -->
        <meta property="og:image"  content="{{asset('assets/images/iconwowness.png')}}">
        <meta name="twitter:image" content="{{asset('assets/images/iconwowness.png')}}">

        <link rel='icon' type='image/png' href="{{asset('assets/images/iconwowness.png')}}">
        <link rel='icon' sizes='192x192' href="{{asset('assets/images/iconwowness.png')}}">
        <link rel='apple-touch-icon' href="{{asset('assets/images/iconwowness.png')}}">
        <meta name='msapplication-square310x310logo' content="{{asset('assets/images/iconwowness.png')}}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- News Css Layout -->
    
        <!-- Simplebar -->
        <link type="text/css" href="{{ asset('assets/admin/vendor/simplebar.min.css') }}" rel="stylesheet">
    
        <!-- App CSS -->
        <link type="text/css" href="{{ asset('assets/admin/css/app.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/admin/css/app.rtl.css')}}" rel="stylesheet">
    
        <!-- Material Design Icons -->
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-material-icons.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-material-icons.rtl.css')}}" rel="stylesheet">
    
        <!-- Font Awesome FREE Icons -->
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-fontawesome-free.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-fontawesome-free.rtl.css')}}" rel="stylesheet">

        <!-- Disable Analytic Cookies -->
        <script>window['ga-disable-G-XFH5YHST2Q'] = true; </script>
    </head>
    <body class="layout-login">

        <!-- <div class="progress-wrap cursor-pointer">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div> -->

        <div class="container-fluid">
            <div class="row position-relative">
                <div style="top:0; z-index:10;" class="d-flex justify-content-between w-100 d-md-none position-absolute">
                    <div class="col-6 position-relative text-center py-2 border-bottom border-active">
                        <label style="font-size: 18px; font-weight: 600; cursor:pointer;" class="w-100 m-0 py-3 text-uppercase" for="signin">Sign In</label>
                        <input style="opacity: 0;" class="position-absolute" id="signin" type="radio" name="login" value="1">
                    </div>

                    <div class="col-6 position-relative text-center py-2 border-bottom">
                        <label style="font-size: 18px; font-weight: 600; cursor:pointer;" class="w-100 m-0 py-3 text-uppercase" for="signup">Sign Up</label>
                        <input style="opacity: 0;" class="position-absolute" id="signup" type="radio" name="login" value="2">
                    </div>
                </div>

                <div class="d-block col-md-4 col-lg-3 p-0 div-in">
                    <div class="layout-login__form pt-5">
                        <div class="d-flex justify-content-center mt-2 mb-5 navbar-light pt-5">
                            <a href="index.html" class="navbar-brand" style="min-width: 0">
                                <a href="/">
                                    <x-application-logo/>
                                </a>
                            </a>
                        </div>
            
                        <h4 class="m-0">Welcome back!</h4>
                        <p class="mb-5">Login to access your account</p>
            
                        {{ $slot }}
                    </div>
                </div>

                <div class="d-md-flex d-none col-md-8 col-lg-9 bg-login text-center div-up">
                    <div class="box-login">
                        <h1>Create Account</h1>
                        <h3 class="p-4">Start your journey</h3>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <a href="{{ route('seeker.create') }}" class="btn_1">Sign up as seeker</a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('facilitators.create') }}" class="btn_1">Sign up a practitioner</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('assets/admin/vendor/jquery.min.js')}}"></script>

        <!-- Bootstrap -->
        <script src="{{ asset('assets/admin/vendor/popper.min.js')}}"></script>
        <script src="{{ asset('assets/admin/vendor/bootstrap.min.js')}}"></script>

        <!-- Simplebar -->
        <script src="{{ asset('assets/admin/vendor/simplebar.min.js')}}"></script>

        <!-- DOM Factory -->
        <script src="{{ asset('assets/admin/vendor/dom-factory.js')}}"></script>

        <!-- MDK -->
        <script src="{{ asset('assets/admin/vendor/material-design-kit.js')}}"></script>

        <!-- App -->
        <script src="{{ asset('assets/admin/js/toggle-check-all.js')}}"></script>
        <script src="{{ asset('assets/admin/js/check-selected-row.js')}}"></script>
        <script src="{{ asset('assets/admin/js/dropdown.js')}}"></script>
        <script src="{{ asset('assets/admin/js/sidebar-mini.js')}}"></script>
        <script src="{{ asset('assets/admin/js/app.js')}}"></script>

        <!-- App Settings (safe to remove) -->
        <script src="{{ asset('assets/admin/js/app-settings.js')}}"></script>
        
        <script>
            var inputsLogin = document.querySelectorAll('input[type="radio"][name="login"]')
            var divIn = document.querySelector('.div-in')
            var divUp = document.querySelector('.div-up')

            inputsLogin.forEach(function(input) {
                
                input.addEventListener('change', function() {
                    
                    inputsLogin.forEach(function(otherInput) {
                        otherInput.parentNode.classList.remove('border-active');
                    });
                    
                if (input.checked) {
                    if (input.value == 2) {
                        divIn.classList.replace('d-block', 'd-none');
                        divUp.classList.replace('d-none', 'd-flex');
                        divUp.style.height = '100vh';
                    }

                    if (input.value == 1) {
                        divIn.classList.replace('d-none', 'd-block');
                        divUp.classList.replace('d-flex', 'd-none');
                        divUp.style.height = ''; // Remove a altura definida
                    }
                    input.parentNode.classList.add('border-active');
                }
                });
            });
        </script>
    </body>
    
</html>

