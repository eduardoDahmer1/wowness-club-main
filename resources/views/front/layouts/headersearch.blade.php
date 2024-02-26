<header class="reveal_header">
    <div class="container">
        <div class="row justify-content-center justify-content-md-between align-items-center">

             <div class="col-5 col-md-2 pb-2 pb-md-0">
                <a href="{{ route('home') }}" class="logo_normal"><img src="{{asset('assets/images/wownesslogocolorida.png')}}" width="100%" alt="Logo Wowness Club"></a>
                <a href="{{ route('home') }}" class="logo_sticky"><img src="{{asset('assets/images/wownesslogocolorida.png')}}" width="100%" alt="Logo Wowness Club"></a>
            </div>
            <div class="col-9 col-md-6">
                <div class="content-search">
                    <i class="bi bi-search"></i>
                    @if (Request::is('search-content'))
                    <form method="GET" action="{{ route('content.search') }}">
                    @elseif (Request::is('search-practitioner'))
                    <form method="GET" action="{{ route('practitioner.search') }}">
                    @else
                    <form method="GET" action="{{ route('service.search') }}">
                    @endif
                        <input id="filter_name" name="q" type="text" class="form-control" placeholder="{{ __('Search by name') }}"
                        value="{{ request('q', '') }}">
                    </form>
                </div>
            </div>

            <div class="col-2 col-md-3">
                <nav>
                    <ul>

                        @if (Auth::check())
                            @if (Auth::user()->role->value == \App\Enums\Role::CommonUser->value)
                            <li><a href="{{ route('orders.indexSeeker')}}" class="btn_1 d-none d-md-block">My Orders</a></li>
                            @else
                            <li><a href="{{ route('onboarding')}}" class="btn_1 d-none d-md-block">My Account</a></li>
                            @endif
                            <li><div id="AlertMessages" class="d-none d-md-block"></div></li>
                        @else
                        <li><a href="{{ route('login')}}" class="btn_1 d-none d-md-block">Login</a></li>
                        @endif

                        <li>
                           <div class="hamburger_2 open_close_nav_panel">
                                <div class="hamburger__box">
                                    <div class="hamburger__inner"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div><!-- /container -->
</header><!-- /Header -->
<div class="nav_panel">
    <a href="#" class="closebt open_close_nav_panel"><i class="bi bi-x"></i></a>
    <div class="logo_panel"><img src="{{asset('assets/images/wownesslogocolorida.png')}}" width="135"  alt=""></div>
    <div class="sidebar-navigation">
        <nav>
            <ul class="level-1">
                {{-- <li class="parent"><a href="#0">Home</a>
                     <ul class="level-2">
                        <li class="back"><a href="#0">Back</a></li>
                        <li><a href="index.html">Home Video Bg</a></li>
                        <li><a href="index-2.html">Home Carousel</a></li>
                        <li><a href="index-3.html">Home FlexSlider</a></li>
                        <li><a href="index-4.html">Home Youtube/Vimeo</a></li>
                        <li><a href="index-5.html">Home Parallax</a></li>
                        <li><a href="index-6.html">Home Parallax 2</a></li>
                    </ul>
                </li> --}}

                <li><a href="{{route('home')}}">Home</a></li>
                @if (Auth::check())
                    <li>
                        <a href="{{ route('chatamity') }}">Chat</a>
                    </li>
                    @isPractitioner(auth()->user())
                    <li>
                        <a href="{{ route('orders.indexSeeker', Auth::user()->id) }}">My Seeker Account</a>
                    </li>
                    <li>
                        <a href="{{route('upgrade')}}">Upgrade</a>
                    </li>
                    <li>
                        <a target="_blank" href="https://billing.stripe.com/p/login/8wM4kb9yb0KVbHGbII">My subscription</a>
                    </li>
                    <li style="border-top: 1px solid #d9e1e6;padding-top: 10px;">
                        <a href="{{ route('onboarding') }}">Practitioner Dashboard</a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('orders.indexSeeker', Auth::user()->id) }}">My Seeker Account</a>
                    </li>
                    <li style="border-top: 1px solid #d9e1e6;padding-top: 10px;">
                        <a href="{{ route('form.practitioner', Auth::user()->id)}}" class="d-none d-md-block">Become a Practitioner</a>
                    </li>
                    @endisPractitioner
                @else
                    <li><a href="{{route('login')}}">Login</a></li>
                    <li><a href="{{route('preregister')}}">Register</a></li>
                    <li><a href="https://practitioners-application.wownessclub.com/" target="_blank">Become a Practitioner</a></li>
                @endif

                @if (Auth::check())
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" id="logout-button">{{__("Logout")}}</button>
                        </form>
                    </li>
                @endif
            </ul>
            <div class="panel_footer">
                <div class="phone_element"><a href="mailto:info@wownessclub.com"><i class="bi bi-envelope-paper"></i><span><em>help and doubts</em>info@wownessclub.com</span></a></div>
            </div>
            <!-- /panel_footer -->
        </nav>
    </div>
    <!-- /sidebar-navigation -->
</div>
<!-- /nav_panel -->

<style>

    body {
        background-color: #FAFAFA;
    }
    #logout-button {
        border: none;
        background: none;
        margin-bottom: 10px;
        padding: 0.35rem 0.65rem;
        display: block;
        position: relative;
        -webkit-transition: all .2s;
        -moz-transition: all .2s;
        transition: all .2s;
        font-size: 0.875rem;
        color: #333;
        text-decoration: none;
        font-weight: 600;
        text-transform: uppercase;
    }
    #logout-button:hover {
        color: #978667;
    }

    .hamburger_2 .hamburger__inner,
    .hamburger_2 .hamburger__inner::before,
    .hamburger_2 .hamburger__inner::after {
        background-color: #333;
    }

    header {
        background-color: #fff;
        box-shadow: 0 0 30px #00000017;
    }

    main {
        padding-top: 135px;
        background-color: #fafafa;
    }

    @media (max-width: 767px) {
        header {
            padding: 5px 0;
        }
        header nav ul li {
            margin-left: 0;
        }
    }
</style>
