@section('specificmetatags')
<!-- title -->
<title>{{str($service->name)->limit(35,'...')}} | Wowness Club</title>
<meta property='og:title' content="{{str($service->name)->limit(35,'...')}} - Services Wowness Club">
<meta name='twitter:title' content="{{str($service->name)->limit(35,'...')}} - Services Wowness Club">

<!-- description -->
<meta name='description' content='{{$service->name}} in {{ str($service->city . ', ' . $service->state) }}, Date: {{$service->start && $service->start->format('d M, Y') }} - {{$service->end && $service->end->format('d M, Y') }}'>
<meta property='og:description' content='{{$service->name}} in {{ str($service->city . ', ' . $service->state) }}, Date: {{$service->start && $service->start->format('d M, Y') }} - {{$service->end && $service->end->format('d M, Y') }}'>
<meta name='twitter:description' content='{{$service->name}} in {{ str($service->city . ', ' . $service->state) }}, Date: {{$service->start && $service->start->format('d M, Y') }} - {{$service->end && $service->end->format('d M, Y') }}'>

<!-- image -->
<meta property="og:image" content="{{asset($service->photo_url)}}">
<meta name="twitter:image" content="{{asset($service->photo_url)}}">

<meta property="og:image:width" content="400" />
<meta property="og:image:height" content="400" />
@endsection

<x-default-layout>
    @include('new-calendar.calendarModal')
    @include('new-calendar.eventUpdateModal')
    @include('front.layouts.headersearch')
    <main>
        <section class="container">
            <div class="row pb-5 justify-content-center">
                <div class="breadcrumb px-2">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>></li>
                        <li><a href="{{ route('services.show', $service->slug) }}" class="active">@lang('Service')</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-lg-8">
                    @if ($service->galleries->count() == 1)
                    <div class="wrapper gallery">
                        <div class="box box0" style="background-image: url({{ asset($service->photo_url) }});">
                            <a href="{{ asset($service->photo_url) }}"></a>
                        </div>
                        @foreach ($service->galleries as $image)
                        <div class="box-if1 box box{{ $loop->index + 1 }}" style="background-image: url({{ asset('storage/' . $image->path) }});">
                            <a href="{{ asset('storage/' . $image->path) }}"></a>
                        </div>
                        @endforeach
                    </div>
                    @elseif ($service->galleries->count() == 2)
                    <div class="wrapper gallery">
                        <div class="box box0" style="background-image: url({{ asset($service->photo_url) }});">
                            <a href="{{ asset($service->photo_url) }}"></a>
                        </div>
                        @foreach ($service->galleries as $image)
                        <div class="box-if box box{{ $loop->index + 1 }}" style="background-image: url({{ asset('storage/' . $image->path) }});">
                            <a href="{{ asset('storage/' . $image->path) }}"></a>
                        </div>
                        @endforeach
                    </div>
                    @elseif ($service->galleries->count())
                    <div class="wrapper gallery">
                        <div class="box box0" style="background-image: url({{ asset($service->photo_url) }});">
                            <a href="{{ asset($service->photo_url) }}"></a>
                        </div>
                        @foreach ($service->galleries as $image)
                        <div class="box box{{ $loop->index + 1 }}" style="background-image: url({{ asset('storage/' . $image->path) }});">
                            <a href="{{ asset('storage/' . $image->path) }}"></a>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="rounded" style="height:400px; background-size: cover; background-image: url({{ asset($service->photo_url) }}); background-position: center;">
                        <a href="{{ asset($service->photo_url) }}"></a>
                    </div>
                    @endif
                    <!-- section.2 -->
                    <div data-cue="slideInUp" class="bg-white p-4 mt-3 rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-1">
                                <input class="rating text-center size-stars" name="overall" min="{{$service->overall}}" max="{{$service->overall}}" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.01" style="--value:{{$service->overall}}" type="range">
                                <p class="fw-bold m-0">{{$service->overall}} <span style="font-size: 14px;" class="text-decoration-underline fw-light">{{$reviewsService}} Reviews</span></p>
                            </div>
                            @if(!$service->packages->sum('quantity'))
                                <div class="sold-out-cylinder">
                                    <span class="py-2 fw-semibold sold-out">SOLD OUT</span>
                                </div>
                            @else
                            <div class="d-flex">
                                <input style="padding: 0; margin: 0; whidth: 0; height: 0; opacity: 0;" id="text" type="text" value="{{ url()->current() }}">
                                <a id="copiaR" class="fw-medium d-flex align-items-center" href="#">
                                    <img style="height: 17px;" src="https://i.ibb.co/F7F6Ngb/material-symbols-share.png" alt="">Share
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="service-container">
                            <span class="service-title py-2 fw-semibold">{{ $service->name }}</span>
                        </div>
                        <!-- icons -->
                        <div style="letter-spacing: 1px;" class="d-flex flex-wrap gap-2 py-3 py-md-2 text-uppercase">
                            <div class="bg-icons fw-semibold d-flex align-items-center">
                                <img style="max-width: 14px; " src="{{ $service->method->icon() }}" loading="lazy" alt="Icon {{ $service->method->name() }}">
                                <span style="font-size: 14px;">{{ $service->method->name() }}</span>
                            </div>
                            <div class="bg-icons fw-semibold d-flex align-items-center">
                                <img style="max-width: 14px; " src="{{ $service->type->icon() }}" loading="lazy" alt="Icon {{ $service->type->name() }}">
                                <span style="font-size: 14px;">{{ $service->type->name() }}</span>
                            </div>
                            <div class="bg-icons fw-semibold d-flex align-items-center">
                                <img style="max-width: 14px; " src="{{ $service->target->icon() }}" loading="lazy" alt="Icon {{ $service->target->name() }}">
                                <span style="font-size: 14px;">{{ $service->target->name() }}</span>
                            </div>
                            <div class="bg-icons fw-semibold d-flex align-items-center">
                                <img style="max-width: 14px; " src="{{ $service->aimed->icon() }}" loading="lazy" alt="Icon {{ $service->aimed->name() }}">
                                <span style="font-size: 14px;">{{ $service->aimed->name() }}</span>
                            </div>
                        </div>
                        <!-- /icons -->
                        <!-- infos -->
                        <div style="font-size: 15px;" class="row">
                            <!-- date -->
                            @if (str($service->type->name) != 'Individual')
                            <div class="col-md-4 col-sm-6 pt-2">
                                <svg width="15" height="15" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.33333 14.6667C2.96667 14.6667 2.65267 14.5363 2.39133 14.2754C2.13044 14.014 2 13.7 2 13.3334V4.00004C2 3.63337 2.13044 3.3196 2.39133 3.05871C2.65267 2.79737 2.96667 2.66671 3.33333 2.66671H4V1.33337H5.33333V2.66671H10.6667V1.33337H12V2.66671H12.6667C13.0333 2.66671 13.3473 2.79737 13.6087 3.05871C13.8696 3.3196 14 3.63337 14 4.00004V13.3334C14 13.7 13.8696 14.014 13.6087 14.2754C13.3473 14.5363 13.0333 14.6667 12.6667 14.6667H3.33333ZM3.33333 13.3334H12.6667V6.66671H3.33333V13.3334ZM3.33333 5.33337H12.6667V4.00004H3.33333V5.33337ZM8 9.33337C7.81111 9.33337 7.65289 9.26937 7.52533 9.14137C7.39733 9.01382 7.33333 8.8556 7.33333 8.66671C7.33333 8.47782 7.39733 8.31937 7.52533 8.19137C7.65289 8.06382 7.81111 8.00004 8 8.00004C8.18889 8.00004 8.34733 8.06382 8.47533 8.19137C8.60289 8.31937 8.66667 8.47782 8.66667 8.66671C8.66667 8.8556 8.60289 9.01382 8.47533 9.14137C8.34733 9.26937 8.18889 9.33337 8 9.33337ZM5.33333 9.33337C5.14444 9.33337 4.986 9.26937 4.858 9.14137C4.73044 9.01382 4.66667 8.8556 4.66667 8.66671C4.66667 8.47782 4.73044 8.31937 4.858 8.19137C4.986 8.06382 5.14444 8.00004 5.33333 8.00004C5.52222 8.00004 5.68067 8.06382 5.80867 8.19137C5.93622 8.31937 6 8.47782 6 8.66671C6 8.8556 5.93622 9.01382 5.80867 9.14137C5.68067 9.26937 5.52222 9.33337 5.33333 9.33337ZM10.6667 9.33337C10.4778 9.33337 10.3196 9.26937 10.192 9.14137C10.064 9.01382 10 8.8556 10 8.66671C10 8.47782 10.064 8.31937 10.192 8.19137C10.3196 8.06382 10.4778 8.00004 10.6667 8.00004C10.8556 8.00004 11.0138 8.06382 11.1413 8.19137C11.2693 8.31937 11.3333 8.47782 11.3333 8.66671C11.3333 8.8556 11.2693 9.01382 11.1413 9.14137C11.0138 9.26937 10.8556 9.33337 10.6667 9.33337ZM8 12C7.81111 12 7.65289 11.936 7.52533 11.808C7.39733 11.6805 7.33333 11.5223 7.33333 11.3334C7.33333 11.1445 7.39733 10.9863 7.52533 10.8587C7.65289 10.7307 7.81111 10.6667 8 10.6667C8.18889 10.6667 8.34733 10.7307 8.47533 10.8587C8.60289 10.9863 8.66667 11.1445 8.66667 11.3334C8.66667 11.5223 8.60289 11.6805 8.47533 11.808C8.34733 11.936 8.18889 12 8 12ZM5.33333 12C5.14444 12 4.986 11.936 4.858 11.808C4.73044 11.6805 4.66667 11.5223 4.66667 11.3334C4.66667 11.1445 4.73044 10.9863 4.858 10.8587C4.986 10.7307 5.14444 10.6667 5.33333 10.6667C5.52222 10.6667 5.68067 10.7307 5.80867 10.8587C5.93622 10.9863 6 11.1445 6 11.3334C6 11.5223 5.93622 11.6805 5.80867 11.808C5.68067 11.936 5.52222 12 5.33333 12ZM10.6667 12C10.4778 12 10.3196 11.936 10.192 11.808C10.064 11.6805 10 11.5223 10 11.3334C10 11.1445 10.064 10.9863 10.192 10.8587C10.3196 10.7307 10.4778 10.6667 10.6667 10.6667C10.8556 10.6667 11.0138 10.7307 11.1413 10.8587C11.2693 10.9863 11.3333 11.1445 11.3333 11.3334C11.3333 11.5223 11.2693 11.6805 11.1413 11.808C11.0138 11.936 10.8556 12 10.6667 12Z" fill="#333333" />
                                </svg>
                                <!-- If the month and year are the same, it displays the format ex: 01 - 02 May, 2023 -->
                                @if ($service->start && $service->end && $service->start->format('m') == $service->end->format('m') && $service->start->format('Y') == $service->end->format('Y'))
                                {{ $service->start->format('d') }} - {{ $service->end->format('d M, Y') }}
                                <!-- If the year is the same, it displays the format ex: 01 April - 02 May, 2023 -->
                                @elseif ($service->start && $service->end && $service->start->format('Y') == $service->end->format('Y'))
                                {{ $service->start->format('d M') }} - {{ $service->end->format('d M, Y') }}
                                <!-- If the dates are completely different, display the format ex: 01 April, 2023 - 10 May, 2024 -->
                                @elseif($service->start && $service->end)
                                {{ $service->start->format('d M, Y') }} - {{ $service->end->format('d M, Y') }}
                                @endif
                            </div>
                            @endif
                            <!-- local -->
                            @if ($service->city || $service->state)
                            <div class="col-md-4 col-sm-6 pt-2">
                                <svg width="15" height="15" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_21_171)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.7125 9.8C2.75325 9.74566 2.80609 9.70156 2.86684 9.67119C2.92759 9.64081 2.99458 9.625 3.0625 9.625H5.25C5.36603 9.625 5.47731 9.67109 5.55936 9.75314C5.64141 9.83519 5.6875 9.94647 5.6875 10.0625C5.6875 10.1785 5.64141 10.2898 5.55936 10.3719C5.47731 10.4539 5.36603 10.5 5.25 10.5H3.28125L1.3125 13.125H12.6875L10.7188 10.5H8.75C8.63397 10.5 8.52269 10.4539 8.44064 10.3719C8.35859 10.2898 8.3125 10.1785 8.3125 10.0625C8.3125 9.94647 8.35859 9.83519 8.44064 9.75314C8.52269 9.67109 8.63397 9.625 8.75 9.625H10.9375C11.0054 9.625 11.0724 9.64081 11.1332 9.67119C11.1939 9.70156 11.2467 9.74566 11.2875 9.8L13.9125 13.3C13.9612 13.365 13.9909 13.4423 13.9982 13.5232C14.0055 13.6041 13.9901 13.6855 13.9538 13.7582C13.9175 13.8308 13.8616 13.8919 13.7925 13.9347C13.7234 13.9774 13.6437 14 13.5625 14H0.4375C0.356251 14 0.276607 13.9774 0.207493 13.9347C0.138378 13.8919 0.082524 13.8308 0.0461883 13.7582C0.00985267 13.6855 -0.00552861 13.6041 0.00176801 13.5232C0.00906462 13.4423 0.0387508 13.365 0.0875002 13.3L2.7125 9.8Z" fill="#333333" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7 0.875042C6.65528 0.875042 6.31394 0.94294 5.99546 1.07486C5.67698 1.20678 5.3876 1.40013 5.14385 1.64389C4.90009 1.88764 4.70674 2.17702 4.57482 2.4955C4.4429 2.81398 4.375 3.15532 4.375 3.50004C4.375 3.84476 4.4429 4.18611 4.57482 4.50459C4.70674 4.82307 4.90009 5.11244 5.14385 5.3562C5.3876 5.59995 5.67698 5.79331 5.99546 5.92523C6.31394 6.05714 6.65528 6.12504 7 6.12504C7.69619 6.12504 8.36387 5.84848 8.85616 5.3562C9.34844 4.86391 9.625 4.19624 9.625 3.50004C9.625 2.80385 9.34844 2.13617 8.85616 1.64389C8.36387 1.1516 7.69619 0.875042 7 0.875042ZM3.5 3.50004C3.50006 2.82649 3.69448 2.16726 4.05991 1.60146C4.42534 1.03566 4.94627 0.587317 5.56019 0.310235C6.17411 0.0331532 6.85494 -0.0608999 7.52099 0.0393615C8.18704 0.139623 8.81001 0.42994 9.31516 0.875476C9.8203 1.32101 10.1862 1.90284 10.3688 2.55115C10.5515 3.19946 10.5432 3.88671 10.345 4.53043C10.1468 5.17415 9.767 5.747 9.25128 6.18025C8.73555 6.61349 8.10577 6.88872 7.4375 6.97292V11.8125C7.4375 11.9286 7.39141 12.0399 7.30936 12.1219C7.22731 12.2039 7.11603 12.25 7 12.25C6.88397 12.25 6.77269 12.2039 6.69064 12.1219C6.60859 12.0399 6.5625 11.9286 6.5625 11.8125V6.97379C5.71634 6.86719 4.93823 6.4553 4.37431 5.8155C3.8104 5.1757 3.49949 4.35289 3.5 3.50004Z" fill="#333333" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_21_171">
                                            <rect width="14" height="14" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span>{{ str($service->city . ', ' . $service->state) }}</span>
                            </div>
                            @endif
                            <!-- group -->
                            <div class="col-md-4 col-sm-6 pt-2">
                                <img style="max-height: 15px;" src="https://i.ibb.co/HKTMsg8/Vector-3.png" alt="">
                                <span>Group size {{ $service->group_size }}</span>
                            </div>
                            <!-- linguagem -->
                            @if ($service->languages->count())
                            <div class="col-md-4 col-sm-6 pt-2">
                                <img style="max-height: 15px;" src="https://i.ibb.co/frRsstZ/mingcute-world-2-line.png" alt="">
                                @foreach ($service->languages as $language)
                                <span>{{ $language->name }}{{ $loop->last ? '' : ',' }}</span>
                                @endforeach
                            </div>
                            @endif
                            <!-- horario -->
                            <div class="col-md-4 col-sm-6 pt-2">
                                <span>
                                    <img style="max-height: 15px;"
                                        src="https://i.ibb.co/PD2TRZw/material-symbols-nest-clock-farsight-analog-outline.png"
                                        alt="">
                                    {{ str($service->timezone?->name) }}
                                </span>
                            </div>
                        </div>
                        <!-- /infos -->
                        <!-- goals -->
                        @if ($service->results->count())
                        <div>
                            <span style="font-size: 26px;" class="pt-4 fw-semibold">Goals</span>
                            <div style="font-size: 15px;" class="row">
                                @foreach ($service->results as $result)
                                <span class="col-lg-4 col-md-6 pt-2 d-flex align-items-center gap-1">
                                    <img style="max-height: 16px;" src="{{ $result->icon }}" alt="">
                                    {{ $result->name }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <!-- /goals -->
                    </div>
                    <!-- section.3 -->
                    <div data-cue="slideInUp" class="bg-white p-4 rounded mt-3">
                        <!-- About this -->
                        <div>
                            <span class="fw-semibold" style="font-size: 26px;">About this service</span>
                            <div id="descricao" class="esconder-text">
                                <p style="font-size: 18px;">
                                    {{ $service->description }}
                                </p>
                            </div>
                            <button id="mostrar" style="background: none; font-size: 18px; border: none;" class="p-0 fw-semibold text-black text-decoration-underline">Read More...</button>
                            <div class="row py-4">
                                @foreach ($service->videos as $video)
                                <div class="col-lg-6">
                                    <iframe width="100%" height="220" src="{{ $video->link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Benefits -->
                        @if ($service->benefits)
                        <div>
                            <span class="fw-semibold" style="font-size: 26px;">Benefits</span>
                            <p style="font-size: 18px;">
                                {{ $service->benefits }}
                            </p>
                        </div>
                        @endif
                        <!-- Highlights -->
                        @if ($service->highlights)
                        <div>
                            <span class="fw-semibold" style="font-size: 26px;">Highlights</span>
                            <p style="font-size: 18px;">{{ $service->highlights }}</p>
                        </div>
                        @endif
                        <!-- What’s Included -->
                        @if ($service->included)
                        <div>
                            <span class="fw-semibold" style="font-size: 26px;">What’s Included</span>
                            <p style="font-size: 18px;">
                                {{ $service->included }}
                            </p>
                        </div>
                        @endif
                        <!-- Whats Is Not Included -->
                        @if ($service->not_included)
                        <div>
                            <span class="fw-semibold" style="font-size: 26px;">Whats Is Not Included</span>
                            <p style="font-size: 18px;">
                                {{ $service->not_included }}
                            </p>
                        </div>
                        @endif
                        <!-- Schedule -->
                        @if ($service->schedule)
                        <div>
                            <span class="fw-semibold" style="font-size: 26px;">Schedule</span>
                            <p style="font-size: 18px;">
                                {{ $service->schedule }}
                            </p>
                        </div>
                        @endif
                    </div>

                    @if ($service->policy)
                    <div data-cue="slideInUp" class="bg-white p-4 rounded mt-3">
                        <div>
                            <span class="fw-semibold d-block" style="font-size: 26px;">{{__('Cancellation Policy')}}</span>
                            <div id="policy-text" class="d-none">
                                <p style="font-size: 18px;">
                                    {{ $service->policy }}
                                </p>
                            </div>
                            <button id="mostrar-policy" style="background: none; font-size: 18px; border: none;" class="py-1 px-0 fw-semibold text-black text-decoration-underline">Read More ∨</button>
                        </div>
                    </div>
                    @endif

                    <!-- section.4 -->
                    @if ($service->complement || $service->city || $service->state || $service->directions || $service->transport)
                        <div data-cue="slideInUp" class="bg-white p-4 rounded mt-3">
                            <!-- Adress -->
                            @if ($service->complement || $service->city || $service->state)
                                <div>
                                    <div>
                                        <span class="fw-semibold" style="font-size: 26px;">Address</span>
                                        <p style="font-size: 18px;"><svg width="16" height="16"
                                                viewBox="0 0 14 14" fill="none"
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
                                            <span
                                            class="text-black text-decoration-underline">{{ $service->complement . ', ' . $service->number . ' - ' . $service->city . ' - ' . $service->state. ' - ' . $service->country?->name . ' - ' . $service->zipcode}}</span>
                                        </p>
                                    </div>
                                </div>
                            @endif
                            <!-- Directions -->
                            @if ($service->directions)
                                <div>
                                    <div>
                                        <span class="fw-semibold" style="font-size: 26px;">Directions</span>
                                        <p style="font-size: 18px;">
                                            {{ $service->directions }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            <!-- Transport -->
                            @if ($service->transport)
                                <div>
                                    <div>
                                        <span class="fw-semibold" style="font-size: 26px;">Transport</span>
                                        <p style="font-size: 18px;">{{ $service->transport }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    
                    @if($service->meals->count() > 0)
                        <div data-cue="slideInUp" class="bg-white p-4 rounded mt-3">
                            <span style="font-size: 26px;" class="mb-3 fw-semibold">Meals</span>
                            <div style="font-size: 16px;" class="row">
                                @foreach ($meals as $meal)
                                    @if ($service->meals->contains($meal))
                                        <div class="col-sm-4 col-6 py-1">
                                            <span class="d-flex align-items-center gap-2">
                                                <img style="max-height: 18px;" src="{{ $meal->icon }}" alt="">
                                                {{ $meal->name }}
                                            </span>
                                        </div>
                                    @else
                                        <div class="col-sm-4 col-6 d-flex align-items-center">
                                            <img class="opacity-25" style="max-height: 18px;" src="{{ $meal->icon }}"
                                                alt="">
                                            <span class="no-select d-flex align-items-center gap-2">
                                                {{ $meal->name }}
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @if ($service->menus->count())
                                <div class="pt-4">
                                    <span style="font-size: 26px;" class="fw-semibold">Menus Options</span>
                                </div>
                                <div style="font-size: 18px;">
                                    <ul class="">
                                        @foreach ($service->menus as $menu)
                                            <li>{{ $menu->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endif

                    @if($service->amenities->count() > 0)
                        <div data-cue="slideInUp" style="font-size: 26px;" class="bg-white p-4 rounded mt-3">
                            <span class="pb-2 fw-semibold">Amenities</span>
                            <div style="font-size: 16px;" class="row">
                                @foreach ($amenities as $amenitie)
                                    @if ($service->amenities->contains($amenitie))
                                        <div class="col-xl-3 col-md-4 col-6 pt-2">
                                            <span class="d-flex align-items-center gap-2">
                                                <img style="max-height: 16px;" src="{{ $amenitie->icon }}"
                                                    alt="">
                                                {{ $amenitie->name }}
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @if ($service->disclaimer)
                                <div class="pt-4">
                                    <span style="font-size: 26px;" class="mt-4 fw-semibold">Preparation /
                                        Disclaimer</span>
                                </div>
                                <p style="font-size: 18px;">{{ $service->disclaimer }}</p>
                            @endif
                        </div>
                    @endif
                </div>
                @if ($service->end && $service->end->shiftTimezone($service->timezone->timezone) > now($service->timezone->timezone))
                <div id="fixo" class="d-lg-none d-md-block">
                    <div class="row px-4">
                        <div id="btn-book" style="font-size: 18px;" class="btn_1">Book Now</div>
                    </div>
                </div>
                @endif
                <div id="booknow" class="col-12 col-lg-4 js-btn-scroll">
                    <div data-cue="slideInUp" class="bg-white p-4 mt-3 mt-lg-0 rounded">
                        <div class="pb-2">
                            <span style="font-size: 22px;" class="d-block fw-semibold pb-2 border-bottom border-light-subtle">Practitioner</span>
                        </div>

                        <div class="d-flex py-2">
                            <div style="background: url('{{ asset('storage/' . $service->user->photo) }}') center center;
                            background-size: cover;
                            background-repeat: no-repeat;
                            box-shadow: 0 0 6px 2px #C7C7C7;" class="col-3 rounded">

                            </div>
                            <!-- <img class="col-3 rounded" style="height: 100%; padding-right: 5px;" src="{{ asset('storage/' . $service->user->photo) }}" alt=""> -->
                            <div style="padding-left: 10px;" class="col-9">
                                <div class="pb-2">
                                    <span style="font-size: 20px;" class="fw-semibold d-grid">{{ $service->user->alias }}<span class="fw-normal mb-0" style="font-size: 12px; color: #888888;">{{ $service->user->headline }}</span></span>
                                </div>
                                @if($service->user->quote)
                                <p class="fw-bold fst-italic" style="line-height: 20px; font-size: 16px; color: #7D9A6F;">
                                    “{{ $service->user->quote }}”</p>
                                @endif
                                <div>
                                    <a style="text-decoration: underline;" class="text-black fw-bold"
                                        href="{{ route('facilitators.show', $service->user->slug) }}">See Full
                                        Profile</a>
                                </div>
                            </div>
                        </div>
                        <!-- icons -->
                        <div style="letter-spacing: 1px;" class="d-flex flex-wrap gap-2 py-2">
                            @foreach ($service->categories as $index => $category)
                            @if ($index < 3) <span style="font-size: 14px;" class="d-flex justify-content-center bg-icons2 fw-semibold"><img src="{{ asset('storage/' . $category->icon) }}" alt="">{{ $category->name }}</span>
                                @else
                                @break
                                @endif
                                @endforeach
                                @foreach ($service->subcategories as $index => $subcategory)
                                @if ($index < 3) <span style="font-size: 14px;" class="d-flex justify-content-center bg-icons2 fw-semibold"><img src="{{ asset('storage/' . $subcategory->icon) }}" alt="">{{ $subcategory->name }}</span>
                                    @else
                                    @break
                                    @endif
                                    @endforeach
                        </div>

                        <script>const userPractitioner = {!! $service->user !!};</script>
                        @if (Auth::check())
                        <div id="ButtonFollow"></div>
                        <div id="liveAlertPlaceholder"></div>
                        @else
                        <button type="button" class="btn_follow fw-bold" data-bs-toggle="modal" data-bs-target="#modalLogin"><i class="bi bi-person-plus-fill me-1"></i> Follow</button>
                        @endif
                    </div>

                    <div data-cue="slideInUp" style="font-size: 18px;" class="bg-white p-4 rounded">
                        <form method="POST" action="{{ route('create.order') }}" id="booking-form">
                            @csrf
                            @if (str($service->type->name) != 'Individual' && $service->packages->sum('quantity'))
                                <div class="mt-2 mb-2">
                                    <h6 class="label-filter">{{__('Available Dates')}}</h6>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="custom_select" id='dates'>
                                                <select class="wide pl-2 pr-2" name="date_id" id="date_id" required data-toggle="select">
                                                    <option selected disabled>Select</option>
                                                    @foreach ($customDates as $customDate)
                                                        <option value="{{ $customDate['id'] }}">
                                                            {{ $customDate['start']->format('d M, Y, h:i A') }} - {{  $customDate['end']->format('d M, Y, h:i A') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (str($service->type->name) == 'Individual')
                            <div>
                                <!-- Button to trigger the modal -->
                                <button type="button" id="modal-calendar-open" class="btn_1 check-styles" data-toggle="modal">
                                    Check Availability
                                </button>
                            </div>
                            @endif

                            @if ($service->end && $service->end->shiftTimezone($service->timezone->timezone) > now($service->timezone->timezone) && $service->packages->sum('quantity'))
                            <div class="pt-4">
                                <h5 style="font-size: 22px;" class="pb-2 border-bottom
                                    border-light-subtle">Pricing Options</h5>
                                @foreach ($service->packages->where('quantity', '>', 0) as $option)
                                <div class="d-flex align-items-center pt-2 lightbox-{{ $loop->index + 1 }}">
                                    <div class="popup" id="popup-{{ $loop->index + 1 }}">
                                        <div class="popup-content">
                                            <span class="close" data-popup-index="{{ $loop->index + 1 }}">&times;</span>
                                            <h6>Description:</h6>
                                            <p>{{ $option->description }}</p>
                                        </div>
                                    </div>
                                    @if (count($option->packageGallerry) > 0)
                                    <div class="bg-package" style="background-image: url({{ asset('storage/' . $option->packageGallerry[0]->path) }});">
                                        @foreach ($option->packageGallerry as $photo)
                                        <a href="{{ asset('storage/' . $photo->path) }}"></a>
                                        @endforeach
                                    </div>
                                    @endif
                                    <div class="check-options d-grid px-1">
                                        <div class="check-options d-flex align-items-center sub-check-options">
                                            <input data-price="{{ $option->price }}" @checked($loop->first) data-stock="{{ $option->quantity }}" id="packages{{ $option->id }}" value="{{ $option->id }}" data-duration="{{ $option->duration }}" data-type="{{$option->duration_type}}" type="radio" name="package_id">
                                            <input type="hidden" name="new_package_id" id="new_package_id">
                                            <label class="px-1" for="packages{{ $option->id }}">
                                                {{ $option->name }} <span class="fw-bold">+ {{ $option->price }}</span>
                                            </label>
                                        </div>
                                        <p class="m-0 openPopup" data-popup-index="{{ $loop->index + 1 }}">View description</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                                <div data-type-service="{{$service->type->value}}" class="pt-4" id="quantityDiv">
                                    <h5 style="font-size: 22px;" class="pb-2 border-bottom
                                        border-light-subtle">Quantity</h5>
                                    <div class="quantity">
                                        <span class="quantity-remove quantity-button"></span>
                                        <input type="number" step="1" name="quantity" id="quantity" min="0" value="1">
                                        <span class="quantity-add quantity-button"></span>
                                    </div>
                        
                                    @error('quantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            <div class="pt-4">
                                <div class="d-flex justify-content-between border-top border-light-subtle pt-2">
                                    <span class="fw-semibold" style="font-size: 20px;">Total Price:</span>
                                    <span class="fw-bold" style="font-size: 20px;">&#163 <span id="total-price">0.00</span></span>
                                </div>

                                @if ($service->user->status_stripe_integration)
                                    <form>
                                        <div class="pt-4 justify-content-center">
                                            <div class="text-center">
                                                <div class="form-group terms">
                                                    <input id="terms" type="checkbox" name="terms" value="Yes" class="required" required>
                                                    </input>
                                                    <span class="checkmark"></span>
                                                    <label for="terms" class="container_check">To accept</label> <a class="text-decoration-underline text-black link-policy fw-semibold" target="_blank" href="https://wownessclub.co.uk/terms-conditions-for-users-customers">{{ __('Terms & Conditions') }}</a>, <a class=" fw-semibold text-decoration-underline text-black link-policy" target="_blank" href="https://stripe.com/en-gb/legal/ssa">{{ __('Stripe Services Agreement') }}</a>.
                                                </div>
                                                <button id="submitBookingForm" type="submit" class="btn_1 check-styles">Book Now</button>
                                                
                                                <div id="warning-book-now" class="mt-3 alert alert-warning" hidden role="alert">
                                                    It is necessary to choose an available date to book, check the available dates
                                                    <button id="type-value" value="{{$service->type}}" hidden></button>
                                                </div>
                                        
                                            </div>
                                        </div>
                                    </form>  
                                @endif

                            </div>
                            @endif
                        </form>
                    </div>
                  
                    <div data-cue="slideInUp" style="font-size: 18px;" class="bg-white p-4 pb-2 mt-3 rounded">
                        <div class="text-center">
                            <div>
                                <span class="fw-semibold" style="font-size: 28px;">Need Help?</span>
                            </div>
                            <span>
                                Reach out to our support if you have questions.
                            </span>
                        </div>
                    </div>

                    @if (Auth::check())
                        <div id="ButtonInitChat" class="p-2 pb-4" style="background-color: #fff;"></div>
                    @else
                    <div class="bg-white p-2 rounded d-flex flex-column align-items-center">
                        <button type="button" class="btn_1_bg px-5 fw-bold" data-bs-toggle="modal" data-bs-target="#modalLogin">CONTACT US</button>
                        <button type="button" class="btn_1 px-5 fw-bold text-uppercase mt-2" data-bs-toggle="modal" data-bs-target="#modalLogin">START CHAT</button>
                    </div>
                    @endif

                </div>
            </div>
        </section>
        <section style="padding-top:50px;">
            <div class="container margin_120_95" style="padding-top:0px;">
                <div class="title mb-2">
                    <small data-cue="slideInUp">Goals</small>
                    <h2 data-cue="slideInUp" data-delay="200">Similar Services</h2>
                </div>
                <div class="owl-carousel owl-theme carousel_item_4 rounded-img">
                    @foreach ($services as $service)
                    <div class="item" data-cues="slideInUp" data-delay={{ $loop->index + 3 . '00' }}>
                        <x-front.cardservice :$service />
                    </div>
                    <!-- /item-->
                    @endforeach
                </div>
                <!-- /carousel-->
                <p class="text-end"><a href="{{ route('service.search') }}" class="btn_1 mt-2" data-cue="slideInUp" data-delay="750">See More</a></p>
            </div>
        </section>
        <!-- /container-->
    </main>
</x-default-layout>
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        grid-template-rows: 200px 200px;
        grid-gap: 5px;
        background-color: #fff;
        color: #444;
    }

    .box {
        color: #fff;
        border-radius: 15px;
        background-size: cover;
        background-position: center;
    }

    .box a {
        display: block;
        width: 100%;
        height: 100%;
        position: relative;
        z-index: 2;
    }

    .box0 {
        grid-column: 1 / 3;
        grid-row: 1 / 3;
    }

    .box-if {
        grid-column: 3 / -1;
    }

    .box-if1 {
        grid-column: 3 / -1;
        grid-row: 1 / 3;
    }

    .box4 {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: inset 0 0 0 100px rgba(0, 0, 0, 0.5);
    }

    .box4::after {
        content: 'See all photos';
        display: block;
        width: auto;
        position: absolute;
        background-color: black;
        padding: 10px;
        border-radius: 15px;
    }

    .no-select {
        opacity: 25%;
        position: relative;
    }

    .no-select::after {
        content: "";
        position: absolute;
        background-color: #000;
        height: 2px;
        width: 120%;
        top: 12px;
        left: -20%;
    }

    .check-options input {
        -webkit-appearance: none;
        background: white;
        border: 1.85px solid #EBEBEB;
        border-radius: 50%;
        width: 17px;
        height: 17px;
    }

    .check-options input:checked {
        background-color: #2AACE4;
    }

    main {
        overflow: hidden auto;
    }

    .esconder-text {
        max-height: 90px;
        overflow: hidden;
    }

    #fixo {
        position: fixed;
        top: 90%;
    }

    .bg-icons2 {
        background-color: #8EBF76;
        padding: 4px 16px;
        border-radius: 30px;
        font-weight: bold;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .bg-icons2 img {
        max-height: 13px;
    }

    .bg-icons {
        background-color: #F4F4F4;
        padding: 5px 20px;
        border-radius: 30px;
        font-weight: bold;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .bg-icons img {
        max-height: 25px;
    }

    .service-title {
        font-size: 32px;
    }

    @media (max-width: 1200px) {
        .box0 {
            grid-row: 1 / 1;
        }

        .wrapper {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 200px 200px 200px;
        }
    }

    @media (max-width: 768px) {
        .service-title {
            font-size: 26px;
        }
    }

    @media (max-width: 420px) {
        .service-title {
            font-size: 24px;
        }
    }

    /* Test button quantity */
    .quantity {
        position: relative;
        display: inline-flex;
        align-items: center;
        color: #7f7f7f;
        padding: 10px 0 0;
    }

    .quantity input[type=number] {
        transition: border 0.3s ease-in-out, color 0.3s ease-in-out;
        font-size: 16px;
        line-height: 24px;
        -webkit-appearance: textfield;
        -moz-appearance: textfield;
        appearance: textfield;
        font-weight: 700;
        box-shadow: none;
        outline: none;
        width: 42px;
        height: 34px;
        text-align: center;
        float: right;
        border: 1px solid #dcdcdc;
        background-color: #fff;
        color: #342f2f;
    }

    .quantity input[type=number]:focus {
        border-color: #57b8f6 !important;
    }

    .quantity input[type=number]:hover {
        border-color: #a5a5a5;
    }

    .quantity-button {
        width: 28px;
        height: 28px;
        display: inline-block;
        float: right;
        position: relative;
        cursor: pointer;
        color: #fff;
        margin: 0 10px;
        border-radius: 100%
    }

    .quantity-button::before,
    .quantity-button::after {
        position: absolute;
        top: calc(50% - 1px);
        left: calc(50% - 7px);
        content: "";
        width: 14px;
        height: 2px;
        background-color: currentColor;
        display: block;
    }

    .quantity-remove::after {
        display: none;
    }

    .quantity-add {
        background-color: #26b326;
    }

    .quantity-remove {
        background-color: #d22626;
    }

    .quantity-add::after {
        transform: rotate(90deg);
    }

    .service-container {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }

    .sold-out-cylinder {
        background-color: #d22626;
        color: white;
        padding: 5px 10px;
        border-radius: 25px;
        margin-left: 15px;
        line-height: 1;
        font-size: 18px;
    }

    .bg-package {
        height: 80px;
        width: 80px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border-radius: 6px;
        position: relative;
    }

    .bg-package i {
        color: #fff;
        position: absolute;
        font-size: 25px;
        width: 100%;
        height: 100%;
        display: none;
        align-items: center;
        justify-content: center;
        background: #00000062;
        border-radius: 6px;
    }

    .bg-package:hover i {
        display: flex;
    }

    .bg-package a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .popup {
        display: none;
        position: fixed;
        width: 100%;
        left: 0;
        z-index: 1;
    }

    .popup-content {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        position: relative;
        box-shadow: 0px 0px 78px -2px #00000073;
    }

    .popup-content p {
        font-size: 14px;
    }

    .close {
        position: absolute;
        top: 0px;
        right: 8px;
        font-size: 20px;
        font-weight: bold;
        cursor: pointer;
    }

    .openPopup {
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        text-decoration: underline;
        padding-left: 20px;
    }

    .openPopup:hover {
        color: #8EBF76;
    }
</style>
<link href="{{ asset('assets/front/css/stars.css')}}" rel="stylesheet">
<script>
    const typeValue = $('#type-value').val();

    const saveDateLocally = (dateObj) => {
        const savedDate = localStorage.getItem('currentDate');

        if (JSON.stringify(dateObj) != savedDate) {
            localStorage.setItem('currentDate', JSON.stringify({ ...dateObj }));
        }
    }

    const handleIndividualDate = () => {
        $('.custom_select#dates .nice-select ul').on('click', (e) => {
            let previousOption = $('.custom_select#dates select option[selected]');
            const customOption = $(e.target);

            $('.custom_select#dates select.wide option').each((_, option) => {
                if (Number(customOption.data('value')) === Number($(option).val())) {
                    $(option).attr('selected', 'selected');
                    previousOption.removeAttr('selected');

                    const dates = $(option).text().replace(/\n/g, '').replace(/\s+/g, ' ').trim();
                    saveDateLocally({dates, typeValue});
                }
            });

            return;
        });
    } 

    if (typeValue != 2) {
        handleIndividualDate();
    }

    const userAdmin = {!! $admin !!};

    var lightbox = new SimpleLightbox('.gallery a');
    var lightbox2 = new SimpleLightbox('.lightbox-1 a');
    var lightbox3 = new SimpleLightbox('.lightbox-2 a');
    var lightbox4 = new SimpleLightbox('.lightbox-3 a');
    var lightbox5 = new SimpleLightbox('.lightbox-4 a');
    var lightbox6 = new SimpleLightbox('.lightbox-5 a');
    var lightbox7 = new SimpleLightbox('.lightbox-6 a');
    var lightbox8 = new SimpleLightbox('.lightbox-7 a');
    var lightbox9 = new SimpleLightbox('.lightbox-8 a');
    var lightbox10 = new SimpleLightbox('.lightbox-9 a');
    var lightbox11 = new SimpleLightbox('.lightbox-10 a');

    const bookNow = document.querySelector('#btn-book');
    const section = document.querySelector('#booknow');
    const topo = section.offsetTop;

    function scrollSuave(event) {
        event.preventDefault();
        window.scrollTo({
            top: topo,
            behavior: 'smooth',
        })
    }
    const messageDivAlert = $('#alert-book-now');
    const messageDivWarning = $('#warning-book-now');
    const btnBook = $('#submitBookingForm');
    const qtdPackage = $('#quantity').val();

    if (typeValue == 2) {
        if (qtdPackage > 1) {
            messageDivWarning.prop('hidden', true);
            btnBook.prop('hidden', false);
            $('.terms').prop('hidden', false);
        } else {
            messageDivWarning.prop('hidden', false);
            btnBook.prop('hidden', true);
            $('.terms').prop('hidden', true);
        }
    } else {
        messageDivWarning.prop('hidden', true);
        btnBook.prop('hidden', false);
    }

    $('#exampleModal').on('hide.bs.modal', function() {
        if (typeValue == 2 && $('#quantity').val() > 1) {
            messageDivWarning.prop('hidden', true);
            btnBook.prop('hidden', false);
            $('.terms').prop('hidden', false);
        } else {
            messageDivWarning.prop('hidden', false);
            btnBook.prop('hidden', true);
            $('.terms').prop('hidden', true);
        }
    });
    window.addEventListener('scroll', function(event) {
        const topBtn = window.pageYOffset;
        if (topBtn >= topo) {
            return bookNow.classList.add('d-none')
        } else {
            return bookNow.classList.remove('d-none')
        }
    })
    bookNow.addEventListener('click', scrollSuave);
    const btnMostrar = document.querySelector('#mostrar')
    const descricao = document.querySelector('#descricao')
    btnMostrar.addEventListener('click', function(event) {
        if (descricao.classList[0] === 'esconder-text') {
            descricao.classList.remove('esconder-text')
            this.innerHTML = "Read less";
        } else {
            descricao.classList.add('esconder-text')
            this.innerHTML = "Read More";
        }
    })

    $('#mostrar-policy').on('click', function() {
        $('#policy-text').toggleClass('d-none')
        if ($(this).text() == "Read More ∨") {
            $(this).text("Read less ∧")
        } else {
            $(this).text("Read More ∨")
        }
    })

    const copiaR = document.querySelector('#copiaR');
    // const url_atual = window.location.href;
    copiaR.addEventListener('click', function(event) {
        event.preventDefault();
        const textInput = document.getElementById('text');
        textInput.select();
        document.execCommand('copy');
    });
    
    window.onload = function() { 
        const radioBtnCheck = document.querySelector('[name="package_id"]:checked').getAttribute('data-price')
        document.querySelector('#total-price').innerHTML = radioBtnCheck;
        const inputQuantity = document.getElementById("quantity");
        const radioBtn = document.querySelectorAll('[name="package_id"]');

        var divQtd = document.getElementById('quantityDiv');
        var typeValue = divQtd.getAttribute('data-type-service')
        if(typeValue == 2){
            $('#quantityDiv').hide();
            function updatePriceIndividual() {
                const package = document.querySelector('[name="package_id"]:checked')
                let quantity = parseInt(document.getElementById("quantity").value)
                const stock = parseInt(package.getAttribute('data-stock'))
                inputQuantity.setAttribute("max", stock)
                inputQuantity.value = stock
                quantity = stock
                const price = package.getAttribute('data-price')
                const totalPrice = (price * quantity) - price;
                document.querySelector('#total-price').innerHTML = totalPrice
            }
    
            updatePriceIndividual()
    
            inputQuantity.addEventListener('change', function(event) {
                updatePriceIndividual()
            })
    
            radioBtn.forEach(function(element) {
                element.addEventListener('change', function(event) {
                    updatePriceIndividual()
                })
            })
        }else{
            function updatePrice() {
                const package = document.querySelector('[name="package_id"]:checked')
                let quantity = parseInt(document.getElementById("quantity").value)
                const stock = parseInt(package.getAttribute('data-stock'))
                inputQuantity.setAttribute("max", stock)
                if (quantity > stock) {
                    inputQuantity.value = stock
                    quantity = stock
                }
                const price = package.getAttribute('data-price')
                const totalPrice = price * quantity;
                document.querySelector('#total-price').innerHTML = totalPrice
            }
    
            updatePrice()
    
            inputQuantity.addEventListener('change', function(event) {
                updatePrice()
            })
    
            radioBtn.forEach(function(element) {
                element.addEventListener('change', function(event) {
                    updatePrice()
                })
            })
    
            $('.quantity-button').off('click').on('click', function() {
                if ($(this).hasClass('quantity-add')) {
                    var addValue = parseInt($(this).parent().find('input').val()) + 1;
    
                    if ($(this).parent().find('input').attr('max') >= addValue) {
                        $(this).parent().find('input').val(addValue).trigger('change');
                    }
                    updatePrice()
                }
    
                if ($(this).hasClass('quantity-remove')) {
                    var removeValue = parseInt($(this).parent().find('input').val()) - 1;
                    if (removeValue == 0) {
                        removeValue = 1;
                    }
                    $(this).parent().find('input').val(removeValue).trigger('change');
                    updatePrice()
                }
            });
        }
    }
    const openPopupButtons = document.querySelectorAll('.openPopup');
    const closePopupButtons = document.querySelectorAll('.close');
    const popups = document.querySelectorAll('.popup');

    openPopupButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const popupIndex = event.target.getAttribute('data-popup-index');
            const popup = document.getElementById(`popup-${popupIndex}`);
            popup.style.display = 'block';
        });
    });

    closePopupButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const popupIndex = event.target.getAttribute('data-popup-index');
            const popup = document.getElementById(`popup-${popupIndex}`);
            popup.style.display = 'none';
        });
    });
</script>