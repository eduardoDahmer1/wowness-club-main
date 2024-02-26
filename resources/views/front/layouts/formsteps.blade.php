<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- title -->
    <title>@yield('title', 'Home') - Wowness Club</title>
    <meta property='og:title'  content="@yield('title', 'Dashboard') - Wowness Club">
    <meta name='twitter:title' content="@yield('title', 'Dashboard') - Wowness Club">

    <!-- description -->
    <meta name='description' content='Wowness Club - A marketplace for holistic health and wellness.'>
    <meta property='og:description' content='Wowness Club - A marketplace for holistic health and wellness.'>
    <meta name='twitter:description' content='Wowness Club - A marketplace for holistic health and wellness.'>

    <!-- image -->
    <meta property="og:image"  content="{{asset('assets/images/iconwowness.png')}}">
    <meta name="twitter:image" content="{{asset('assets/images/iconwowness.png')}}">

    <link rel='icon' type='image/png' href="{{asset('assets/images/iconwowness.png')}}">
    <link rel='icon' sizes='192x192' href="{{asset('assets/images/iconwowness.png')}}">
    <link rel='apple-touch-icon' href="{{asset('assets/images/iconwowness.png')}}">
    <meta name='msapplication-square310x310logo' content="{{asset('assets/images/iconwowness.png')}}">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link type="text/css" href="{{ asset('assets/admin/css/vendor-flatpickr-airbnb.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/front/forms_steps/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/front/forms_steps/css/menu.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/front/forms_steps/css/style_wedding.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/front/forms_steps/css/vendors.css')}}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('assets/front/forms_steps/css/custom.css')}}" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="{{ asset('assets/front/forms_steps/js/modernizr.js')}}"></script>
    
    <!-- Filepond -->
    <link href="{{ asset('assets/admin/css/filepond.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/filepond-plugin-image-preview.min.css') }}" rel="stylesheet" />

    @stack('header')

    <!-- Disable Analytic Cookies -->
    <script>window['ga-disable-G-XFH5YHST2Q'] = true; </script>
    
</head>

<body>

    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Preload -->
    
    <div id="loader_form">
        <div data-loader="circle-side-2"></div>
    </div><!-- /loader_form -->
	
    {{ $slot }}

    
    <div class="cd-overlay-nav">
        <span></span>
    </div>
    <!-- /cd-overlay-nav -->
    
    <div class="cd-overlay-content">
        <span></span>
    </div>
    <!-- /cd-overlay-content -->
    
    <!-- Help form Popup -->
    <div id="modal-help" class="custom-modal zoom-anim-dialog mfp-hide">
        <div class="small-dialog-header">
            <h3>Ask Us Anything</h3>
            <p class="mb-3">Please fill the form with your questions and<br>we will reply soon!</p>
        </div>
    </div>
    <!-- /Help form Popup -->
	
	<!-- COMMON SCRIPTS -->
	<script src="{{ asset('assets/front/forms_steps/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('assets/front/forms_steps/js/common_scripts.min.js')}}"></script>
	<script src="{{ asset('assets/front/forms_steps/js/velocity.min.js')}}"></script>
	<script src="{{ asset('assets/front/forms_steps/js/functions.js')}}"></script>   

    <!--Filepond-->
    <script src="{{ asset('assets/admin/js/filepond-plugin-file-validate-size.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/filepond-plugin-file-validate-type.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/filepond-plugin-image-preview.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/filepond.min.js')}}"></script>

    <script>

        //Add plugins to filepond plugin
        FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateSize, FilePondPluginFileValidateType);

        let inputsFilesImg = document.querySelectorAll('input[type="file"]');
        inputsFilesImg.forEach(element => {

            let labelIdle = `
            <svg width="20" height="20" viewBox="0 0 26 26" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.9165 17.3334C11.9165 17.6403 12.0205 17.8974 12.2285 18.1047C12.4358 18.3127 12.6929 18.4167 12.9998 18.4167C13.3068 18.4167 13.5643 18.3174 13.7723 18.1188C13.9795 17.9202 14.0832 17.6674 14.0832 17.3605V14.0834H16.0332C16.2859 14.0834 16.4528 13.9707 16.5337 13.7454C16.6153 13.5193 16.5748 13.325 16.4123 13.1625L13.379 10.1292C13.2707 10.0209 13.1443 9.96671 12.9998 9.96671C12.8554 9.96671 12.729 10.0209 12.6207 10.1292L9.58734 13.1625C9.42484 13.325 9.38439 13.5193 9.466 13.7454C9.54689 13.9707 9.71373 14.0834 9.9665 14.0834H11.9165V17.3334ZM4.33317 21.6667C3.73734 21.6667 3.22745 21.4547 2.8035 21.0308C2.37884 20.6061 2.1665 20.0959 2.1665 19.5V6.50004C2.1665 5.90421 2.37884 5.39432 2.8035 4.97037C3.22745 4.54571 3.73734 4.33337 4.33317 4.33337H9.93942C10.2283 4.33337 10.5038 4.38754 10.766 4.49587C11.0274 4.60421 11.2575 4.75768 11.4561 4.95629L12.9998 6.50004H21.6665C22.2623 6.50004 22.7726 6.71237 23.1973 7.13704C23.6212 7.56099 23.8332 8.07087 23.8332 8.66671V19.5C23.8332 20.0959 23.6212 20.6061 23.1973 21.0308C22.7726 21.4547 22.2623 21.6667 21.6665 21.6667H4.33317Z" />
            </svg>
            Click or Drag
            `

            FilePond.create(element, {
                labelIdle,
                credits: {
                    label: '',
                    url: ''
                },
                storeAsFile: true,
                maxFiles: 15,
                itemInsertLocation: 'after',
                allowImagePreview: true,
                allowFileSizeValidation: true,
                imagePreviewHeight: 130,
                maxFileSize: "3MB",
                fileValidateTypeDetectType: (source, type) =>
                    new Promise((resolve, reject) => {
                        resolve(type);
                    }),
                imagePreviewTransparencyIndicator: "grid",
            });

        })
    </script>

</body>
</html>