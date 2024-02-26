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

        <!-- Filepond -->
        <link href="{{ asset('assets/admin/css/filepond.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/admin/css/filepond-plugin-image-preview.min.css') }}" rel="stylesheet" />

        <!-- App CSS -->
        <link type="text/css" href="{{ asset('assets/admin/css/app.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/admin/css/app.rtl.css')}}" rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-material-icons.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-material-icons.rtl.css')}}" rel="stylesheet">

        <!-- Font Awesome FREE Icons -->
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-fontawesome-free.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-fontawesome-free.rtl.css')}}" rel="stylesheet">

        <!-- Flatpickr -->
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-flatpickr.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-flatpickr.rtl.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-flatpickr-airbnb.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-flatpickr-airbnb.rtl.css')}}" rel="stylesheet">

        <!-- Select2 -->
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-select2.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/admin/css/vendor-select2.rtl.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/admin/vendor/select2/select2.min.css')}}" rel="stylesheet">

        <!--  Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        
        <!--  Stars Styles -->
        <link href="{{ asset('assets/front/css/stars.css')}}" rel="stylesheet">
        
        <!-- DateRangePicker -->
        <link type="text/css" href="{{ asset('assets/admin/vendor/daterangepicker.css')}}" rel="stylesheet">

        <script src="{{ asset('js/app.js') }}" defer></script>

        <script>
            const userWowness = {!! Auth::check() ? Auth::user() : 0 !!};
        </script>

        <!-- Disable Analytic Cookies -->
        <script>window['ga-disable-G-XFH5YHST2Q'] = true; </script>

        <!-- feedback widget for the practitioner -->
    <script type="text/javascript">window.$sleek=[];window.SLEEK_PRODUCT_ID=383413004;(function(){d=document;s=d.createElement("script");s.src="https://client.sleekplan.com/sdk/e.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    </head>
    <body class="layout-default">
        <div class="preloader"></div>

        @if(Auth::check())
        <!-- React Authentication -->
        <div id="Authentication" class="d-none"></div>
        @endif

        <!-- Conteudo -->
        <div class="mdk-header-layout js-mdk-header-layout">

            @include('admin.layouts.menu')

            <!-- Conteudo + Menu Lateral -->
            <div class="mdk-header-layout__content">
                <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">

                    <!-- Conteudo da página -->
                    {{ $slot }}
                    <!-- // END Conteudo da página -->

                    <!-- Menu Lateral -->
                    @include('admin.layouts.navigation')
                    <!-- // END Lateral -->
                </div>

            </div>
            <!-- // END Conteudo + Menu Lateral -->
        </div>



        {{-- <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>

            </main>
        </div> --}}


        <!-- App Settings FAB -->
        <div id="app-settings">
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

        <!-- Flatpickr -->
        <script src="{{ asset('assets/admin/vendor/flatpickr/flatpickr.min.js')}}"></script>

        <!-- Global Settings -->
        <script src="{{ asset('assets/admin/js/settings.js')}}"></script>

        <!-- jQuery Mask Plugin -->
        <script src="{{ asset('assets/admin/vendor/jquery.mask.min.js')}}"></script>

        <!-- Select2 -->
        <script src="{{ asset('assets/admin/vendor/select2/select2.min.js')}}"></script>
        <script src="{{ asset('assets/admin/js/select2.js')}}"></script>

        <!-- DateRangePicker -->
        <script src="{{ asset('assets/admin/vendor/moment.min.js')}}"></script>
        <script src="{{ asset('assets/admin/vendor/daterangepicker.js')}}"></script>
        <script src="{{ asset('assets/admin/js/daterangepicker.js')}}"></script>

        <!-- Global Settings -->
        <script src="{{ asset('assets/admin/js/settings.js')}}"></script>

        <!--Filepond-->
        <script src="{{ asset('assets/admin/js/filepond-plugin-file-validate-size.min.js')}}"></script>
        <script src="{{ asset('assets/admin/js/filepond-plugin-file-validate-type.min.js')}}"></script>
        <script src="{{ asset('assets/admin/js/filepond-plugin-image-preview.min.js')}}"></script>
        <script src="{{ asset('assets/admin/js/filepond.min.js')}}"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>

</html>
