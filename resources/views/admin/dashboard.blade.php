<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="container-fluid page__container">
            <div class="row">
                <div class="col-12 d-flex flex-wrap mb-3">
                    <input class="rating text-center" min="3.5" max="3.5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:{{$userRequest->overall ? $userRequest->overall : 0}}" type="range" value="3.5">
                    <h4 class="px-2">{{$userRequest->overall ? $userRequest->overall : 0}}</h4>
                    <p style="font-size: 16px;" class="fw-bold mt-2 m-0 text-underline fw-light">{{$qtdReviews}} Reviews</p>
                </div>
            </div>
            
            <div class="row card-group-row">
                @can('viewAny', App\Models\User::class)
                <div class="col-lg-4 col-md-6 card-group-row__col">
                    <x-card-stat
                        title="New Practitioner"
                        :value="$usersMonth"
                        :percentage="$usersDiffPercentage"
                    />
                </div>

                <div class="col-lg-4 col-md-12 card-group-row__col">
                    <x-card-stat
                        title="Total Commission"
                        :value="$commissionsMonth"
                        :percentage="$commissionsDiffPercentage"
                        icon="attach_money"
                        type="money"
                    />
                </div>
                @endcan
                <div class="col-lg-4 col-md-6 card-group-row__col">
                    <x-card-stat
                        title="Total Net Sales"
                        :value="auth()->user()->isAdmin() || auth()->user()->isMaintainer() ? $salesMonth : $practitionerMonthSales"
                        :percentage="auth()->user()->isAdmin() || auth()->user()->isMaintainer() ? $salesDiffPercentage : $practitionerSalesDiffPercentage"
                        icon="monetization_on"
                        type="money"
                    />
                </div>

                @unlessisMaintainer(auth()->user())
                    <div class="col-lg-4 col-md-6 card-group-row__col">
                        <x-card-stat
                            title="Tickets Sold"
                            :value="$ticketsMonth"
                            :percentage="$ticketsDiffPercentage"
                            icon="view_list"
                            type="simple"
                        />
                    </div>
                @endisMaintainer
                
            </div>
            @if(!auth()->user()->isAdmin())
            <div class="row card-group-row">
                <div class="col-lg-8 col-md-6 card-group-row__col">
                    @if(auth()->user()->isPaying())
                        <div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
                            <div class="flex">
                                <div class="card-header__title text-muted">My subscription</div>
                                <p class=" text-muted mb-2"><small>Name</small></p>
                                <div class="text-amount">
                                    {{ auth()->user()->subscription->plan->name }}
                                </div>
                            </div>
                            <div><i class="material-icons icon-muted icon-40pt ml-3">attach_money</i></div>
                        </div>
                        @else
                        <div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
                            <div class="flex">
                                <div class="card-header__title text-muted">{{ 'My subscription' }}</div>
                                <p class=" text-muted mb-2"><small>Name</small></p>
                                <div class="text-amount">
                                    Free
                                </div>
                            </div>
                            <div><i class="material-icons icon-muted icon-40pt ml-3">attach_money</i></div>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    <div class="card dashboard-area-tabs" id="dashboard-area-tabs">
                        <div class="card-header p-0 bg-white nav">
                            <div class="row no-gutters flex" role="tablist">
                                <div class="col" data-toggle="chart" data-target="#earningsTrafficChart" data-prefix="" data-suffix="k">
                                    <a href="#" data-toggle="tab" role="tab" aria-selected="true" class="dashboard-area-tabs__tab card-body text-center active">
                                        <span class="card-header__title m-0">Performance by</span>
                                        <span class="text-amount">Categories</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="card-body text-muted" style="height: 280px;">
                            <div class="chart" style="height: calc(280px - 1.25rem * 2);">
                                <canvas id="earningsTrafficChart">
                                    <span style="font-size: 1rem;"><strong>Website Traffic / Earnings</strong> area chart goes here.</span>
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>

                @can('viewAny', App\Models\User::class)
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-header card-header-large bg-white d-flex align-items-center">
                                <h4 class="card-header__title flex m-0">Pending Approvals</h4>
                                <a href="{{ route('users.index') }}" class="linkSeemore">See Practitioner
                                    <i class="material-icons ">navigate_next</i>
                                </a>
                            </div>

                            <div class="list-group tab-content list-group-flush">
                                <div class="tab-pane active show fade" id="activity_all">

                                    @foreach($pendingApprovals as $pending)
                                        <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                            <div class="avatar avatar-xs mr-1">
                                                <img src="{{ $pending->photo_url }}" alt="avatar" class="avatar-img rounded-circle">
                                            </div>

                                            <div class="flex">
                                                <strong class="text-15pt mr-1">{{ $pending->name }}</strong>
                                                <small class="text-muted d-block">Created {{ $pending->created_at->format('m/d/Y') }}</small>
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <div class="ball-verified mr-1"></div>
                                                <small class="text-15pt">Not Verified</small>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>

        </div>
    </div>
</x-app-layout>

<!-- Chart.js -->
<script src="{{ asset('assets/admin/vendor/Chart.min.js')}}"></script>

<!-- App Charts JS -->
<script src="{{ asset('assets/admin/js/charts.js')}}"></script>

<!-- Chart Samples -->
<script src="{{ asset('assets/admin/js/page.dashboard.js')}}"></script>

