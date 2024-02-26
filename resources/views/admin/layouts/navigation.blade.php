<div class="mdk-drawer js-mdk-drawer" id="default-drawer" data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-left simplebar" data-simplebar>
            <div class="sidebar-block p-3 d-none d-lg-block">
                <x-application-logo />
            </div>
            <div class="d-flex align-items-center sidebar-p-a border-bottom sidebar-account">
                <a href="{{ route('users.edit', auth()->user()) }}"
                    class="flex d-flex align-items-center text-underline-0 text-body">
                    <span class="avatar mr-3">
                        @if (auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="avatar"
                                class="avatar-img rounded-circle">
                        @else
                            <img src="{{ asset('assets/images/avatar.png') }}" alt="avatar"
                                class="avatar-img rounded-circle">
                        @endif
                    </span>
                    <span class="flex d-flex flex-column">
                        <strong>{{ auth()->user()->name }}</strong>
                        <small class="text-muted">{{ auth()->user()->email }}</small>
                    </span>
                </a>
                <div class="dropdown ml-auto">
                    <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i
                            class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('users.edit', auth()->user()) }}">Edit account</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">{{ __('Logout') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="sidebar-heading sidebar-m-t">Menu</div>
            <div class="sidebar-block border-bottom p-0">
                <ul class="sidebar-menu" id="components_menu">
                    @can('practitionerViewAny', App\Models\User::class)
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('dashboard') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">home</i>
                            <span class="sidebar-menu-text">Dashboard</span>
                        </a>
                    </li>
                    @endcan
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('users.edit', auth()->user()) }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">edit</i>
                            <span class="sidebar-menu-text">Edit Profile</span>
                        </a>
                    </li>
                    @can('practitionerViewAny', App\Models\User::class)
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" target="_blank" href="https://billing.stripe.com/p/login/8wM4kb9yb0KVbHGbII">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">loyalty</i>
                            <span class="sidebar-menu-text">My subscription</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('upgrade') }}">
                            <i class="fas fa-crown mr-3 sidebar-menu-icon" style="font-size:18px;margin-right:12px;"></i>
                            <span class="sidebar-menu-text">Upgrade</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('onboarding') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">mood</i>
                            <span class="sidebar-menu-text">Onboarding</span>
                        </a>
                    </li>
                    @endcan
                    @can('update', App\Models\Category::class)
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="{{ route('categories.index') }}">
                                <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dashboard</i>
                                <span class="sidebar-menu-text">Categories</span>
                            </a>
                        </li>
                    @endcan
                    @can('viewAny', auth()->user())
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="{{ route('users.index') }}">
                                <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person_pin</i>
                                <span class="sidebar-menu-text">Practitioner</span>
                            </a>
                        </li>
                    @endcan
                    @can('seekerViewAny', auth()->user())
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('seekers.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person_pin</i>
                            <span class="sidebar-menu-text">Seeker</span>
                        </a>
                    </li>
                    @endcan
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="/admin/chat">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">chat</i>
                            <span class="sidebar-menu-text">Chat</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button collapsed" data-toggle="collapse" href="#services_menu" aria-expanded="false">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">business_center</i>
                            <span class="sidebar-menu-text">Services</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="services_menu" style="">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('services.create') }}">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">business_center</i>
                                    <span class="sidebar-menu-text">Create Services</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('services.index') }}">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">list</i>
                                    <span class="sidebar-menu-text">List Services</span>
                                </a>
                            </li>
                            @can('practitionerViewAny', App\Models\Order::class)
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('orders.index') }}">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                                    <span class="sidebar-menu-text">Service Orders</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('reviews.index') }}" aria-expanded="false">
                            <i style="font-size:20px;margin-right: 12px;" class="sidebar-menu-icon--left bi bi-star-fill"></i>
                            <span class="sidebar-menu-text">Reviews</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button collapsed" data-toggle="collapse" href="#content_menu" aria-expanded="false">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">ondemand_video</i>
                            <span class="sidebar-menu-text">Content</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="content_menu" style="">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('contents.index') }}" >
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons"  @if(!Auth::user()->isPaying()) style="opacity:0.4" @endif>ondemand_video</i>
                                    <span class="sidebar-menu-text" @if(!Auth::user()->isPaying()) style="opacity:0.4" @endif>Add Content</span>
                                    @if(!Auth::user()->isPaying())
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="padding-left: 0.75rem">lock</i>
                                    @endif
                                </a>
                            </li>
                            @can('practitionerViewAny', App\Models\Order::class)
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('purchases.index') }}">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">assignment</i>
                                        <span class="sidebar-menu-text">Content Orders</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @can('practitionerViewAny', App\Models\Order::class)
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('connections.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">settings_input_component</i>
                            <span class="sidebar-menu-text">Connections</span>
                        </a>
                    </li>
                    @endcan
                    @can('viewAny', App\Models\Post::class)
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('posts.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">book</i>
                            <span class="sidebar-menu-text">Blog</span>
                        </a>
                    </li>
                    @endcan
                    @can('viewAny', App\Models\Calendar::class)
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('calendar.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Calendar</span>
                        </a>
                    </li>

                    @can('viewAny', auth()->user())
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="{{ route('newsletter.index') }}">
                                <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">fiber_new</i>
                                <span class="sidebar-menu-text">Newsletter</span>
                            </a>
                        </li>
                    @endcan
                </ul>
                @endcan
            </div>

            <div class="sidebar-block border-bottom p-0">
                <ul class="sidebar-menu">
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('orders.indexSeeker') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person</i>
                            <span class="sidebar-menu-text">My Seeker Account</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-p-a">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-primary-button class="btn-block mb-5">
                        {{ __('Logout') }}
                    </x-primary-button>
                </form>
            </div>

        </div>
    </div>
</div>
