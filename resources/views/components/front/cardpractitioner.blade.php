 @props(['practitioner'])

<a href="{{route('facilitators.show', $practitioner)}}" class="box_cat_rooms">
    <figure>
        <div class="background-image" data-background="url({{asset('storage/'. $practitioner->photo)}})"></div>
    </figure>
    <div class="w-100">
        <div class="px-3">
            <h3 class="m-0">{{$practitioner->alias}}</h3>
            <h6 class="fst-italic fw-light text-muted">{{ str($practitioner->headline)->limit(60,'...') }}</h6>
        </div>

        @if ($practitioner->specialisations->count() > 0)
        <div class="px-3">
            <h5 style="margin:0;">Specialisations:</h5>
            <p class="mb-1 text-clip-card">
            @foreach ($practitioner->specialisations as $specialisation)
                {{$specialisation->name}}{{ !$loop->last ? ',' : ''}}
            @endforeach
            </p>
        </div>
        @endif
        @if($practitioner->offer)
        <div class="px-3">
            <h5 style="margin:0;">Conditions:</h5>
            <p class="mb-1 text-clip-card">{{ $practitioner->offer }}</p>
        </div>
        @endif
        @if($practitioner->help)
        <div class="px-3">
            <h5 style="margin:0;">Clients:</h5>
            <p class="mb-1 text-clip-card">{{ $practitioner->help }}</p>
        </div>
        @endif
        @if($practitioner->languages->count() > 0)
        <div class="px-3">
            <h5 style="margin:0;">Spoken Languages:</h5>
            <p class="mb-1 text-clip-card">
            <img style="height: 15px;width:15px;display:inline;" src="https://i.ibb.co/frRsstZ/mingcute-world-2-line.png" alt="">
            @foreach ($practitioner->languages as $language)
                {{$language->name}}{{ !$loop->last ? ',' : ''}}
            @endforeach
            </p>
        </div>
        @endif
        @if ($practitioner->city && $practitioner->country->name)
        <div class="px-3">
            <h5 style="margin:0;">Location:</h5>
            <p class="mb-1 text-clip-card">
                <svg width="15" height="15" viewBox="0 0 14 14" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_21_171)">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.7125 9.8C2.75325 9.74566 2.80609 9.70156 2.86684 9.67119C2.92759 9.64081 2.99458 9.625 3.0625 9.625H5.25C5.36603 9.625 5.47731 9.67109 5.55936 9.75314C5.64141 9.83519 5.6875 9.94647 5.6875 10.0625C5.6875 10.1785 5.64141 10.2898 5.55936 10.3719C5.47731 10.4539 5.36603 10.5 5.25 10.5H3.28125L1.3125 13.125H12.6875L10.7188 10.5H8.75C8.63397 10.5 8.52269 10.4539 8.44064 10.3719C8.35859 10.2898 8.3125 10.1785 8.3125 10.0625C8.3125 9.94647 8.35859 9.83519 8.44064 9.75314C8.52269 9.67109 8.63397 9.625 8.75 9.625H10.9375C11.0054 9.625 11.0724 9.64081 11.1332 9.67119C11.1939 9.70156 11.2467 9.74566 11.2875 9.8L13.9125 13.3C13.9612 13.365 13.9909 13.4423 13.9982 13.5232C14.0055 13.6041 13.9901 13.6855 13.9538 13.7582C13.9175 13.8308 13.8616 13.8919 13.7925 13.9347C13.7234 13.9774 13.6437 14 13.5625 14H0.4375C0.356251 14 0.276607 13.9774 0.207493 13.9347C0.138378 13.8919 0.082524 13.8308 0.0461883 13.7582C0.00985267 13.6855 -0.00552861 13.6041 0.00176801 13.5232C0.00906462 13.4423 0.0387508 13.365 0.0875002 13.3L2.7125 9.8Z"
                            fill="#333333" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7 0.875042C6.65528 0.875042 6.31394 0.94294 5.99546 1.07486C5.67698 1.20678 5.3876 1.40013 5.14385 1.64389C4.90009 1.88764 4.70674 2.17702 4.57482 2.4955C4.4429 2.81398 4.375 3.15532 4.375 3.50004C4.375 3.84476 4.4429 4.18611 4.57482 4.50459C4.70674 4.82307 4.90009 5.11244 5.14385 5.3562C5.3876 5.59995 5.67698 5.79331 5.99546 5.92523C6.31394 6.05714 6.65528 6.12504 7 6.12504C7.69619 6.12504 8.36387 5.84848 8.85616 5.3562C9.34844 4.86391 9.625 4.19624 9.625 3.50004C9.625 2.80385 9.34844 2.13617 8.85616 1.64389C8.36387 1.1516 7.69619 0.875042 7 0.875042ZM3.5 3.50004C3.50006 2.82649 3.69448 2.16726 4.05991 1.60146C4.42534 1.03566 4.94627 0.587317 5.56019 0.310235C6.17411 0.0331532 6.85494 -0.0608999 7.52099 0.0393615C8.18704 0.139623 8.81001 0.42994 9.31516 0.875476C9.8203 1.32101 10.1862 1.90284 10.3688 2.55115C10.5515 3.19946 10.5432 3.88671 10.345 4.53043C10.1468 5.17415 9.767 5.747 9.25128 6.18025C8.73555 6.61349 8.10577 6.88872 7.4375 6.97292V11.8125C7.4375 11.9286 7.39141 12.0399 7.30936 12.1219C7.22731 12.2039 7.11603 12.25 7 12.25C6.88397 12.25 6.77269 12.2039 6.69064 12.1219C6.60859 12.0399 6.5625 11.9286 6.5625 11.8125V6.97379C5.71634 6.86719 4.93823 6.4553 4.37431 5.8155C3.8104 5.1757 3.49949 4.35289 3.5 3.50004Z"
                            fill="#333333" />
                    </g>
                    <defs>
                        <clipPath id="clip0_21_171">
                            <rect width="14" height="14" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                {{ $practitioner->city }}, {{$practitioner->country->name}}
            </p>
        </div>
        @endif
    </div>
</a>
