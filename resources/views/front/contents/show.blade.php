@section('specificmetatags')
<!-- title -->
<title>{{str($content->title)->limit(35,'...')}} | Wowness Club</title>
<meta property='og:title'  content="{{str($content->title)->limit(35,'...')}} - Content Wowness Club">
<meta name='twitter:title' content="{{str($content->title)->limit(35,'...')}} - Content Wowness Club">

<!-- description -->
<meta name='description' content="{{$content->title}}, Date: {{ $content->created_at->format('d M, Y') }}">
<meta property='og:description' content="{{$content->title}}, Date: {{ $content->created_at->format('d M, Y') }}">
<meta name='twitter:description' content="{{$content->title}}, Date: {{ $content->created_at->format('d M, Y') }}">

<!-- image -->
<meta property="og:image"  content="{{asset($content->thumbnail)}}">
<meta name="twitter:image" content="{{asset($content->thumbnail)}}">

<meta property="og:image:width" content="400" />
<meta property="og:image:height" content="400" />
@endsection

<x-default-layout>
    @include('front.layouts.headersearch')
    <main>
        <section class="container">
            <div class="row pb-5 justify-content-center">
                <div class="breadcrumb px-2">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>></li>
                        <li><a href="{{ route('contents.show', $content->slug) }}" class="active">@lang('Content')</a>
                        </li>
                    </ul>
                </div>
                @if ($content->type->name() == 'Course')
                <div class="col-12">
                    <div class="row my-2">
                        <div class="col-lg-8 mt-3">
                            @foreach ($content->lessons as $lesson)
                                <div id="box-video-lesson-{{$lesson->id}}" class="box-video-lesson {{$loop->first ? 'show' : ''}}">
                                    @if (Auth::check() && $content->cost->name() == 'Free')
                                        <iframe width="100%" class="iframe-video-lesson" src="https://www.youtube.com/embed/{{substr($lesson->video_url, -11)}}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen
                                        ></iframe>
                                    @elseif (Auth::check() && $content->cost->name() == 'Paid' && $isPaid)
                                        <iframe width="100%" class="iframe-video-lesson" src="https://www.youtube.com/embed/{{substr($lesson->video_url, -11)}}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen
                                        ></iframe>
                                    @elseif ($content->cost->name == 'Paid')
                                        <div class="box-video" style="background-image: url({{ asset('/storage/' . $content->thumbnail) }});">
                                            <a href="#button-booknow" class="playericon">Buy to get access<i class="bi bi-lock-fill"></i></a>
                                        </div>
                                    @else
                                        <div class="box-video" style="background-image: url({{ asset('/storage/' . $content->thumbnail) }});">
                                            <button type="button" class="btn playericon" data-bs-toggle="modal" data-bs-target="#modalLogin">Log in to access the video <i class="bi bi-lock-fill"></i></button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-4 mt-3">
                            <div class="accordion" id="accordionLessons">
                                @foreach ($content->lessons as $lesson)
                                <div class="accordion-item">
                                    <div class="accordion-header" id="lesson-{{$lesson->id}}">
                                        <button class="accordion-button {{ !$loop->first ? 'collapsed' : ''}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLesson-{{$lesson->id}}" aria-expanded="true" aria-controls="collapseLesson-{{$lesson->id}}">
                                            <div>
                                                <h6 class="m-0" style="font-weight: 600;text-decoration: underline;">{{$lesson->title}}</h6>
                                                <small class="m-0" >Lesson {{$loop->index + 1}}</small>
                                            </div>
                                        </button>
                                    </div>
                                    <div id="collapseLesson-{{$lesson->id}}" class="accordion-collapse collapse {{$loop->first ? 'show' : ''}}" aria-labelledby="lesson-{{$lesson->id}}" data-bs-parent="#accordionLessons">
                                        <div class="accordion-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="m-0"><strong><small>Lesson Description</small></strong></p>
                                                    <p class="m-0">{{$lesson->subtitle}}</p>
                                                </div>
                                                <button onclick="showVideoLesson(event)" type="button" style="padding: 0;font-size: 2rem;color: #8ebf76;border: none;margin-left: 10px;" class="btn">
                                                    <i data-box-lesson="box-video-lesson-{{$lesson->id}}" class="bi bi-play-circle-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-12 col-lg-8">
                    @if ($content->type->name() !== 'Course')
                        @if (Auth::check() && $content->cost->name() == 'Free')
                            <iframe width="100%" class="iframe-video-lesson" src="https://www.youtube.com/embed/{{substr($content->url, -11)}}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            ></iframe>
                        @elseif (Auth::check() && $content->cost->name() == 'Paid' && $isPaid)
                            <iframe width="100%" class="iframe-video-lesson" src="https://www.youtube.com/embed/{{substr($content->url, -11)}}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            ></iframe>
                        @elseif ($content->cost->name == 'Paid')
                            <div class="box-video" style="background-image: url({{ asset('/storage/' . $content->thumbnail) }});">
                                <a href="#button-booknow" class="playericon">Buy to get access<i class="bi bi-lock-fill"></i></a>
                            </div>
                        @else
                            <div class="box-video" style="background-image: url({{ asset('/storage/' . $content->thumbnail) }});">
                                <button type="button" class="btn playericon" data-bs-toggle="modal" data-bs-target="#modalLogin">Log in to access the video <i class="bi bi-lock-fill"></i></button>
                            </div>
                        @endif
                    @endif
                    <!-- section.2 -->
                    <div data-cue="slideInUp" class="bg-white p-4 rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-1">
                                {{-- <p class="fw-bold m-0">4.93 <span style="font-size: 14px;" class="text-decoration-underline fw-light">985 Reviews</span></p> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 my-2">
                                @foreach ($content->categories as $category)
                                    <span style="font-size: 14px;margin:3px;"
                                        class="bg-icons2 fw-semibold">
                                        <img src="{{ asset('storage/' . $category->icon) }}" alt="">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="col-md-2 my-2 d-flex justify-content-end">

                                <input style="padding: 0; margin: 0; width: 0; height: 0; opacity: 0;position: absolute;" id="text"
                                    type="text" value="{{ url()->current() }}">
                                <a id="copiaR" class="fw-medium d-flex align-items-center" href="#">
                                    <img style="height: 17px;" src="https://i.ibb.co/F7F6Ngb/material-symbols-share.png"
                                        alt="">Share
                                </a>

                            </div>
                        </div>
                        <div class="service-container">
                            <span class="service-title py-2 fw-semibold">{{ $content->title }}</span>
                            <h6 class="fst-italic fw-light">{{ $content->subtitle }}</h6>
                        </div>
                        <!-- icons -->
                        <div style="letter-spacing: 1px;" class="d-flex flex-wrap gap-2 py-3 py-md-2 text-uppercase">

                            <div class="bg-icons fw-semibold d-flex align-items-center">
                                <img style="max-width: 14px; "src="{{$content->type->icon()}}" loading="lazy" alt="Icon {{$content->type->name()}}">
                                <span style="font-size: 14px;">{{$content->type->name()}}</span>
                            </div>

                            <div class="bg-icons fw-semibold d-flex align-items-center">
                                <img style="max-width: 14px; "src="{{$content->cost->icon()}}" loading="lazy" alt="Icon {{$content->cost->name()}}">
                                <span style="font-size: 14px;">{{$content->cost->name()}}</span>
                            </div>

                            <div class="bg-icons fw-semibold d-flex align-items-center">
                                <img style="max-width: 14px; "src="{{ $content->target->icon() }}" loading="lazy" alt="Icon {{ $content->target->name() }}">
                                <span style="font-size: 14px;">{{ $content->target->name() }}</span>
                            </div>
                            <div class="bg-icons fw-semibold d-flex align-items-center">
                                <img style="max-width: 14px; "src="{{ $content->aimed->icon() }}" loading="lazy" alt="Icon {{ $content->aimed->name() }}">
                                <span style="font-size: 14px;">{{ $content->aimed->name() }}</span>
                            </div>
                        </div>
                        <!-- /icons -->
                        <!-- goals -->
                        @if ($content->goals->count())
                            <div class="pt-2">
                                <span style="font-size: 26px;" class="fw-semibold">Goals</span>
                                <div style="font-size: 15px;" class="row">
                                    @foreach ($content->goals as $goal)
                                        <span class="col-lg-4 col-md-6 pt-2 d-flex align-items-center gap-1">
                                            <img style="max-height: 16px;" src="{{ $goal->icon }}" alt="">
                                            {{ $goal->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <!-- /goals -->

                        <!-- infos -->
                        <div style="font-size: 15px;" class="row py-3">
                            <span style="font-size: 26px;" class="fw-semibold">Language</span>
                            <!-- linguagem -->
                            @if ($content->languages->count())
                                <div class="col-md-4 col-sm-6 pt-2">
                                    <img style="max-height: 15px;"
                                        src="https://i.ibb.co/frRsstZ/mingcute-world-2-line.png" alt="">
                                    @foreach ($content->languages as $language)
                                        <span>{{ $language->name }}{{ $loop->last ? '' : ',' }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <!-- /infos -->
                    </div>
                    <!-- section.3 -->
                    <div data-cue="slideInUp" class="bg-white p-4 rounded mt-3">
                        <!-- About this -->
                        <div>
                            <span class="fw-semibold" style="font-size: 26px;">Description</span>
                            <div id="descricao" class="esconder-text">
                                <p style="font-size: 18px;">
                                    {{ $content->description }}
                                </p>
                            </div>
                            <button id="mostrar" style="background: none; font-size: 18px; border: none;"
                                class="p-0 fw-semibold text-black text-decoration-underline">Read More...</button>

                        </div>
                        @if ($content->learns->count() > 0)
                        <div class="pt-4">
                            <span class="fw-semibold" style="font-size: 26px;">What you will learn</span>
                            <ul style="list-style: none;padding: 1rem 0;">
                                @foreach ($content->learns as $item)
                                <li>
                                    <p style="padding: 5px 0;margin: 0;font-size: 18px;">
                                        <i class="bi bi-check-lg" style="background-color: green;color: #fff;border-radius: 18px;padding: 1px 3px;margin-right: 5px;"></i>
                                        {{ $item->name }}
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </div>

                </div>

                @if ($content->cost->name() == 'Paid' && !$isPaid)
                <div id="fixo" class="d-lg-none d-md-block">
                    <div class="row px-4">
                        <div id="btn-book" style="font-size: 18px;" class="btn_1">Buy Now</div>
                    </div>
                </div>
                @endif

                <div id="booknow" class="col-12 col-lg-4 js-btn-scroll">
                    <div data-cue="slideInUp" class="bg-white p-4 mt-3 mt-lg-0 rounded">
                        <div class="pb-2">
                            <span style="font-size: 22px;"
                                class="d-block fw-semibold pb-2 border-bottom border-light-subtle">Practitioner</span>
                        </div>

                        <div class="d-flex py-2">
                            <div style="background: url('{{ asset('storage/' . $content->user->photo) }}') center center;
                            background-size: cover;
                            background-repeat: no-repeat;
                            box-shadow: 0 0 6px 2px #C7C7C7;"
                                class="col-3 rounded">

                            </div>
                            <!-- <img class="col-3 rounded" style="height: 100%; padding-right: 5px;" src="{{ asset('storage/' . $content->user->photo) }}" alt=""> -->
                            <div style="padding-left: 10px;" class="col-9">
                                <div class="pb-2">
                                    <span style="font-size: 20px;"
                                        class="fw-semibold d-grid">{{ $content->user->alias }}<span
                                            class="fw-normal mb-0"
                                            style="font-size: 12px; color: #888888;">{{ $content->user->headline }}</span></span>
                                </div>
                                @if($content->user->quote)
                                <p class="fw-bold fst-italic"
                                    style="line-height: 20px; font-size: 16px; color: #7D9A6F;">
                                    “{{ $content->user->quote }}”</p>
                                @endif
                                <div>
                                    <a style="text-decoration: underline;" class="text-black fw-bold"
                                        href="{{ route('facilitators.show', $content->user->slug) }}">See Full
                                        Profile</a>
                                </div>
                            </div>
                        </div>
                        <!-- icons -->
                        <div style="letter-spacing: 1px;" class="d-flex flex-wrap gap-2 py-2">
                            @foreach ($content->categories as $index => $category)
                            @if ($index < 3)
                                <span style="font-size: 14px;"
                                    class="d-flex justify-content-center bg-icons2 fw-semibold"><img
                                        src="{{ asset('storage/' . $category->icon) }}"
                                        alt="">{{ $category->name }}</span>
                                @else
                                @break
                            @endif
                            @endforeach
                            @foreach ($content->subcategories as $index => $subcategory)
                            @if ($index < 3)
                                <span style="font-size: 14px;"
                                    class="d-flex justify-content-center bg-icons2 fw-semibold"><img
                                        src="{{ asset('storage/' . $subcategory->icon) }}"
                                        alt="">{{ $subcategory->name }}</span>
                                @else
                                @break
                            @endif
                            @endforeach
                        </div>

                        @if (Auth::check())
                        <div id="ButtonFollow"></div>
                        <div id="liveAlertPlaceholder"></div>
                        @else
                        <button type="button" class="btn_follow fw-bold" data-bs-toggle="modal" data-bs-target="#modalLogin"><i class="bi bi-person-plus-fill me-1"></i> Follow</button>
                        @endif
                    </div>

                    @if ($content->cost->name() == 'Paid' && !$isPaid)
                    <div id="button-booknow"  data-cue="slideInUp" style="font-size: 18px;" class="bg-white p-4 mt-3 rounded">
                        <form method="POST" action="{{ route('create.purchase') }}">
                            @csrf
                            <input name="content_id" type="hidden" id="content_id" value="{{$content->id}}">
                            <input name="amount_paid" type="hidden" id="amount_paid" value="{{ $content->price}}">
                            <div>
                                <h5 style="font-size: 22px;" class="pb-2 border-bottom
                                border-light-subtle">Pricing</h5>
                                <div class="check-options d-grid px-1">
                                    <div class="check-options d-flex align-items-center">
                                        <h3>£ {{ $content->price }}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4">
                                @if ($content->user->status_stripe_integration)
                                    <div class="pt-4 justify-content-center">
                                        <div class="text-center">
                                            @if ($havePurchase)
                                            <a href="{{route('purchases.checkout.index', $havePurchase->id)}}" class="btn_1 check-styles">Finalize Purchase</a>
                                            @else
                                            <div class="form-group terms">
                                                <input id="terms" type="checkbox" name="terms" value="Yes" class="required" required>
                                                </input>
                                                <span class="checkmark"></span>
                                                <label for="terms" class="container_check">To accept</label> <a class="text-decoration-underline text-black link-policy fw-semibold" target="_blank" href="https://wownessclub.co.uk/terms-conditions-for-users-customers">{{ __('Terms & Conditions') }}</a>, <a class=" fw-semibold text-decoration-underline text-black link-policy" target="_blank" href="https://stripe.com/en-gb/legal/ssa">{{ __('Stripe Services Agreement') }}</a>.
                                            </div>
                                                @if (Auth::check())
                                                <button type="submit" class="btn_1 check-styles">Buy Now</button>
                                                @else
                                                <button type="button" class="btn_1 check-styles" data-bs-toggle="modal" data-bs-target="#modalLogin">Buy Now </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </form>
                    </div>
                    @endif

                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

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
        {{-- <section style="padding-top:50px;">
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
                    @endforeach
                </div>
                <p class="text-end"><a href="{{ route('service.search') }}" class="btn_1 mt-2"
                        data-cue="slideInUp" data-delay="750">See More</a></p>
            </div>
        </section> --}}
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
        display: inline-flex;
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
    .quantity-button::before, .quantity-button::after {
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
    color:#8EBF76;
    }

    .box-video {
        height:400px; background-size: cover;
        background-position: center;
        border: 2px solid #8ebf76;
        border-radius: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        position:relative;
    }
    .box-video .playericon {
        background-color: #c4c4c4;
        font-size: 1.5rem;
        margin:1rem;
        padding: 5px 20px;
        border-radius: 100px;
        position:relative;
        z-index:1;
        color:#333;
    }
    @media (max-width:576px) {
        .box-video .playericon {
            font-size: 1rem;
        }
    }
    .box-video::after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: #00000045;
        z-index: 0;
        border-radius: 30px;
    }
    .box-video-lesson {
        display: none;
    }
    .box-video-lesson.show {
        display: block;
    }

    .iframe-video-lesson {
        border-radius: 30px;
        border: 2px solid #8ebf76;
        height: 400px;
    }

    @media (max-width:578px) {
        .iframe-video-lesson {
            height: 300px;
        }
    }

    .accordion-button:not(.collapsed) {
        color: #8ebf76;
        background-color: #51bd1c17;
        box-shadow: inset 0 1px 10px #8ebf7680;
    }

    @media (min-width:992px) {
        #accordionLessons {
            max-height: 400px;
            overflow-y: scroll;
            border: 1px solid #f2f2f2;
            border-radius: 5px;
        }
    }
</style>


<script>

    const userPractitioner = {!! $content->user !!};
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

    if (bookNow) {
        function scrollSuave (event) {
            event.preventDefault();
            window.scrollTo({
                top: topo,
                behavior: 'smooth',
            })
        }
        window.addEventListener('scroll', function (event){
            const topBtn = window.pageYOffset;
            if (topBtn >= topo) {
                return bookNow.classList.add('d-none')
            } else {
                return bookNow.classList.remove('d-none')
            }
        })
        bookNow.addEventListener('click', scrollSuave);
    }

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

    $('#mostrar-policy').on('click', function () {
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

    window.onload = function () {
        const radioBtnCheck = document.querySelector('[name="package_id"]:checked').getAttribute('data-price')
        document.querySelector('#total-price').innerHTML = radioBtnCheck;
        const inputQuantity = document.getElementById("quantity");
        const radioBtn = document.querySelectorAll('[name="package_id"]')


        function updatePrice(){
            const package = document.querySelector('[name="package_id"]:checked')
            let quantity = parseInt(document.getElementById("quantity").value)
            const stock = parseInt(package.getAttribute('data-stock'))
            inputQuantity.setAttribute("max", stock)

            if(quantity > stock){
                inputQuantity.value = stock
                quantity = stock
            }

            const price = package.getAttribute('data-price')
            const totalPrice = price*quantity;
            document.querySelector('#total-price').innerHTML = totalPrice
        }

        updatePrice()

        inputQuantity.addEventListener('change', function (event) {
            updatePrice()
        })

        radioBtn.forEach(function(element) {
            element.addEventListener('change', function (event) {
                updatePrice()
            })
        })

        // Test button quantity
        $('.quantity-button').off('click').on('click', function () {

            if ($(this).hasClass('quantity-add')) {
                var addValue = parseInt($(this).parent().find('input').val()) + 1;

                if ( $(this).parent().find('input').attr('max') >= addValue ) {
                    $(this).parent().find('input').val(addValue).trigger('change');
                }
                updatePrice()
            }

            if ($(this).hasClass('quantity-remove')) {
                var removeValue = parseInt($(this).parent().find('input').val()) - 1;
                if( removeValue == 0 ) {
                    removeValue = 1;
                }
                $(this).parent().find('input').val(removeValue).trigger('change');
                updatePrice()
            }
        });

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


    const showVideoLesson = event => {
        const videosLessons = document.querySelectorAll('.box-video-lesson')
        videosLessons.forEach( element=> {
            element.classList.remove('show')
        })
        const boxLessonSelected = event.target.getAttribute('data-box-lesson');
        document.getElementById(boxLessonSelected).classList.add('show')
    }
</script>
