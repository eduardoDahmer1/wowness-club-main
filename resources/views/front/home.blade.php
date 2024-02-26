<x-default-layout>
    @include('front.layouts.headermain')
    <main>
        <section class="init-banner">
            <figure id="myVideo">
                <video autoplay muted loop playsinline>
                    <source src="{{ asset('assets/videos/BannerVideOFront.mp4') }}" type="video/mp4">
                    <p>Seu navegador não suporta o elemento video HTML5.
                </video>
            <figcaption>Video responsivo com HTML5 video</figcaption>
            </figure>

            <div class="container" style="position:relative;">
                <div class="d-flex justify-content-center">
                    <div class="meta">
                        <div class="box-home-title">
                            <h3 class="show">Health</h3>
                            <h3>Healing</h3>
                            <h3>Higher Consciousness</h3>
                        </div>
                        <p class="text-center">Find holistic health and wellness content, events, alternative therapies and retreats.</p>
                        <!-- <div class="search-button mt-3">
                            <form method="GET" action="{{ route('service.search') }}">
                                <input id="inputSearchHome" type="text" class="qty form-control" name="q"
                                    placeholder="Find the ideal service for you" value="{{ request('q', '') }}">
                                <i class="bi bi-search"></i>
                                <div class="box-helper-search">
                                    <div class="form-group">
                                        <h6>Type of Service:</h6>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($types as $type)
                                                <a href="/search?types[{{ $type }}]={{ $type }}"
                                                    class="btn_3">
                                                    <img src="{{ $type->icon() }}" height="18px" alt="">
                                                    {{ $type->name() }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h6>Categories:</h6>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($categories as $category)
                                            <a href="/search?categories[{{ $category->id }}][id]={{ $category->id }}"
                                                class="btn_3">
                                                <img src="{{ asset('storage/' . $category->icon) }}" height="18px"
                                                    alt="">
                                                {{ $category->name }}
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h6>Goals:</h6>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($results as $result)
                                                <a href="/search?results[{{ $result->id }}][id]={{ $result->id }}"
                                                    class="btn_3">
                                                    <img src="{{ $result->icon }}" height="18px" alt="">
                                                    {{ $result->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> -->
                        <div class="d-flex justify-content-center">
                            <a class="btn_1 m-1 text-center" href="{{route('service.search')}}">Browse Services</a>
                            <a class="btn_1 m-1 text-center" href="{{route('practitioner.search')}}">Browse Practitioners</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="box-slider-categories">
                <div class="container" data-cue="slideInUp" data-delay="200">
                    <div class="slider-feature-categories owl-carousel owl-theme">
                        <div class="item" data-cue="slideInUp" data-delay="300">
                            <a href="{{ route('service.search') . '?categories[' . $categories->firstWhere('name', 'Meditation')?->id . '][id]=' . $categories->firstWhere('name', 'Meditation')?->id }}"
                                class="box-feature-category"
                                style="background-image: url({{ asset('assets/images/backgrounds/meditationbg.webp') }});">
                                <div class="name-category">
                                    <img src="{{ asset('assets/images/chakra.png') }}" alt="Meditation" loading="lazy" width="35px">
                                    <h4>Meditation</h4>
                                </div>
                            </a>
                        </div>

                        <div class="item" data-cue="slideInUp" data-delay="400">
                            <a href="{{ route('service.search') . '?categories[' . $categories->firstWhere('name', 'Yoga')?->id . '][id]=' . $categories->firstWhere('name', 'Yoga')?->id }}"
                                class="box-feature-category"
                                style="background-image: url({{ asset('assets/images/backgrounds/yogabg.webp') }})">
                                <div class="name-category">
                                    <img src="{{ asset('assets/images/yoga-pose.png') }}" loading="lazy" alt="Yoga"
                                        width="35px">
                                    <h4>Yoga</h4>
                                </div>
                            </a>
                        </div>

                        <div class="item" data-cue="slideInUp" data-delay="500">
                            <a href="{{ route('service.search') . '?categories[' . $categories->firstWhere('name', 'Massage')?->id . '][id]=' . $categories->firstWhere('name', 'Massage')?->id }}"
                                class="box-feature-category"
                                style="background-image: url({{ asset('assets/images/backgrounds/massagebg.webp') }})">
                                <div class="name-category">
                                    <img src="{{ asset('assets/images/back.png') }}" alt="Massage" loading="lazy" width="35px">
                                    <h4>Massage</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div> -->
        </section>
        <!-- /slider -->

        <div class="bg-fade-search"></div>

        <section class="firts-section-home">

            <!-- <div class="container">

                <h4 class="mb-3 p-mob" style="color: #7D9A6F;" data-cue="slideInUp" data-delay="200">Search by Service Type</h4>

                <div class="row p-mob">
                    <div class="col-xl-3 col-6 p-2 p-0" data-cue="slideInUp" data-delay="300">
                        <a href="/search?types[{{ $types[1] }}]={{ $types[1] }}"
                            class="box-type-services"
                            style="background-image: url({{ asset('assets/images/typeofservice/IndividualSession-min.webp') }});">
                            <div class="type-service">
                                <img src="{{ asset('assets/images/icons-type/individual.png') }}" loading="lazy" alt="Individual Sessions" width="35px">
                                <span class="mx-2 fw-semibold text-uppercase">Individual Sessions</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-6 p-2 p-0" data-cue="slideInUp" data-delay="400">
                        <a href="/search?types[{{ $types[0] }}]={{ $types[0] }}"
                            class="box-type-services"
                            style="background-image: url({{ asset('assets/images/typeofservice/Group-min.webp') }})">
                            <div class="type-service">
                                <img src="{{ asset('assets/images/icons-type/group.png') }}" loading="lazy" alt="Group Sessions"
                                    width="35px">
                                <span class="mx-2 fw-semibold text-uppercase">Group Sessions</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-6 p-2 p-0" data-cue="slideInUp" data-delay="500">
                        <a href="/search?types[{{ $types[2] }}]={{ $types[2] }}"
                            class="box-type-services"
                            style="background-image: url({{ asset('assets/images/typeofservice/Coachingcourses-min.webp') }})">
                            <div class="type-service">
                                <img src="{{ asset('assets/images/icons-type/course.png') }}" loading="lazy" alt="Courses & Coaching" width="35px">
                                <span class="mx-2 fw-semibold text-uppercase">Courses & Coaching</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-6 p-2 p-0" data-cue="slideInUp" data-delay="600">
                        <a href="/search?types[{{ $types[3] }}]={{ $types[3] }}"
                            class="box-type-services"
                            style="background-image: url({{ asset('assets/images/typeofservice/Retreat-min.webp') }})">
                            <div class="type-service">
                                <img src="{{ asset('assets/images/icons-type/retreats.png') }}" loading="lazy" alt="Welness Retreats" width="35px">
                                <span class="mx-2 fw-semibold text-uppercase">Wellness Retreats</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div> -->

            <div class="container pt-5 pb-6" data-cue="slideInUp" data-delay="200">
                <div class="title">
                    <small>Goals</small>
                    <h4 class="pb-3" data-cue="slideInUp" data-delay="200">Mental Health</h4>
                </div>

                <div class="slider-feature-goals owl-carousel owl-theme">
                    @foreach ($services as $service)
                    <div class="item" data-cue="slideInUp" data-delay="{{ $loop->index + 1 }}00">
                        <x-front.cardservice :$service />
                    </div>
                    @endforeach
                </div>
                <!-- /carousel-->

                <!-- Carroussel antigo de Goals
                <div class="slider-feature-goals owl-carousel owl-theme">

                    <div class="item" data-cue="slideInUp" data-delay="300">
                        <a href="/search?results[{{ $results[3] ->id}}][id]={{ $results[3] ->id}}"
                            class="box-feature-category"
                            style="background-image: url({{ asset('assets/images/goals/stressanxiety-min.webp') }});">
                            <div class="type-service">
                                <img src="{{ asset('assets/images/icons-results/inner-beauty.png') }}" loading="lazy" alt="Anxiety & Stress Management" width="35px">
                                <span class="mx-2 fw-semibold text-uppercase">Anxiety & Stress<br>Management</span>
                            </div>
                        </a>
                    </div>

                    <div class="item" data-cue="slideInUp" data-delay="400">
                        <a href="/search?results[{{ $results[0]->id }}][id]={{ $results[0]->id }}"
                            class="box-feature-category"
                            style="background-image: url({{ asset('assets/images/goals/healingandemotional-min.webp') }});">
                            <div class="type-service">
                                <img src="{{ asset('assets/images/icons-results/heart.png') }}" loading="lazy" alt="Healing / Emotional Release" width="35px">
                                <span class="mx-2 fw-semibold text-uppercase">Healing & Emotional<br>Release</span>
                            </div>
                        </a>
                    </div>

                    <div class="item" data-cue="slideInUp" data-delay="500">
                        <a href="/search?results[{{ $results[1] ->id}}][id]={{ $results[1] ->id}}"
                            class="box-feature-category"
                            style="background-image: url({{ asset('assets/images/goals/mentalhealth-min.webp') }});">
                            <div class="type-service">
                                <img src="{{ asset('assets/images/icons-results/mental-health.png') }}" loading="lazy" alt="Mental Health" width="35px">
                                <span class="mx-2 fw-semibold text-uppercase">Mental Health</span>
                            </div>
                        </a>
                    </div>

                    <div class="item">
                        <a href="/search?results[{{ $results[2] ->id}}][id]={{ $results[2] ->id}}"
                        class="box-feature-category"
                        style="background-image: url({{ asset('assets/images/goals/hightperformance-min.jpg') }});">
                        <div class="type-service">
                            <img src="{{ asset('assets/images/icons-results/meter.png') }}" loading="lazy" alt="High Performance" width="35px">
                            <span class="mx-2 fw-semibold text-uppercase">High Performance</span>
                        </div>
                        </a>
                    </div>

                    <div class="item">
                        <a href="/search?results[{{ $results[4] ->id}}][id]={{ $results[4] ->id}}"
                        class="box-feature-category"
                        style="background-image: url({{ asset('assets/images/goals/loveandrelation-min.webp') }});">
                        <div class="type-service">
                            <img src="{{ asset('assets/images/icons-results/talk.png') }}" loading="lazy" alt="Love & Relationships" width="35px">
                            <span class="mx-2 fw-semibold text-uppercase">Love & Relationships</span>
                        </div>
                        </a>
                    </div>

                    <div class="item">
                        <a href="/search?results[{{ $results[5] ->id}}][id]={{ $results[5] ->id}}"
                        class="box-feature-category"
                        style="background-image: url({{ asset('assets/images/goals/happinessfun-min.jpg') }});">
                        <div class="type-service">
                            <img src="{{ asset('assets/images/icons-results/laugh.png') }}" loading="lazy" alt="Happiness & Fun" width="35px">
                            <span class="mx-2 fw-semibold text-uppercase">Happiness & Fun</span>
                        </div>
                        </a>
                    </div>

                    <div class="item">
                        <a href="/search?results[{{ $results[6] ->id}}][id]={{ $results[6] ->id}}"
                        class="box-feature-category"
                        style="background-image: url({{ asset('assets/images/goals/humanconection-min.webp') }});">
                        <div class="type-service">
                            <img src="{{ asset('assets/images/icons-results/business-people.png') }}" loading="lazy" alt="Human Connection" width="35px">
                            <span class="mx-2 fw-semibold text-uppercase">Human Connection</span>
                        </div>
                        </a>
                    </div>

                    <div class="item">
                        <a href="/search?results[{{ $results[7] ->id}}][id]={{ $results[7] ->id}}"
                        class="box-feature-category"
                        style="background-image: url({{ asset('assets/images/goals/balanceandrelaxation-min.webp') }});">
                        <div class="type-service">
                            <img src="{{ asset('assets/images/icons-results/sunbathing.png') }}" loading="lazy" alt="Balance & Relaxation" width="35px">
                            <span class="mx-2 fw-semibold text-uppercase">Balance & Relaxation</span>
                        </div>
                        </a>
                    </div>

                    <div class="item">
                        <a href="/search?results[{{ $results[8] ->id}}][id]={{ $results[8] ->id}}"
                        class="box-feature-category"
                        style="background-image: url({{ asset('assets/images/goals/emotionalint-min.jpg') }});">
                        <div class="type-service">
                            <img src="{{ asset('assets/images/icons-results/emotional-intelligence.png') }}" loading="lazy" alt="Emotional Intelligence" width="35px">
                            <span class="mx-2 fw-semibold text-uppercase">Emotional Intelligence</span>
                        </div>
                        </a>
                    </div>

                    <div class="item">
                        <a href="/search?results[{{ $results[9] ->id}}][id]={{ $results[9] ->id}}"
                        class="box-feature-category"
                        style="background-image: url({{ asset('assets/images/goals/physical-min.webp') }});">
                        <div class="type-service">
                            <img src="{{ asset('assets/images/icons-results/muscle.png') }}" loading="lazy" alt="Physical Health" width="35px">
                            <span class="mx-2 fw-semibold text-uppercase">Physical Health</span>
                        </div>
                        </a>
                    </div>

                    <div class="item">
                        <a href="/search?results[{{ $results[10]->id }}][id]={{ $results[10]->id }}"
                        class="box-feature-category"
                        style="background-image: url({{ asset('assets/images/goals/weightloss.webp') }});">
                        <div class="type-service">
                            <img src="{{ asset('assets/images/icons-results/apple.png') }}" loading="lazy" alt="Weight Loss" width="35px">
                            <span class="mx-2 fw-semibold text-uppercase">Weight Loss</span>
                        </div>
                        </a>
                    </div>

                    <div class="item">
                        <a href="/search?results[{{ $results[11]->id }}][id]={{ $results[11]->id }}"
                        class="box-feature-category"
                        style="background-image: url({{ asset('assets/images/goals/money-min.jpg') }});">
                        <div class="type-service">
                            <img src="{{ asset('assets/images/icons-results/apple.png') }}" loading="lazy" alt="Weight Loss" width="35px">
                            <span class="mx-2 fw-semibold text-uppercase">Money Energy & Wealth</span>
                        </div>
                        </a>
                    </div>

                </div>
                carousel-->

            </div>

            <!-- Sliders free content -->
            @if ($freecontents->count() > 0)
            <div class="container pt-5 pb-5" data-cue="slideInUp" data-delay="200">
                <div class="title">
                    <small>Free Content</small>
                    <h4 class="pb-3" data-cue="slideInUp" data-delay="200">Anxiety & Stress Management</h4>
                </div>

                <div class="slider-contents owl-carousel owl-theme">
                    @foreach ($freecontents as $content)
                    <div class="item" data-cue="slideInUp" data-delay="{{$loop->index + 1}}00">
                        <x-front.cardcontent :$content />
                    </div>
                    @endforeach
                </div>
                <!-- /carousel-->
            </div>
            @endif

            @if ($paidcontents->count() > 0)
            <!-- Sliders paid content -->
            <div class="container pt-5 pb-5" data-cue="slideInUp" data-delay="200">
                <div class="title">
                    <small>Paid Content</small>
                    <h4 class="pb-3" data-cue="slideInUp" data-delay="200">Healing and Emotional Release</h4>
                </div>

                <div class="slider-contents owl-carousel owl-theme">

                    @foreach ($paidcontents as $content)
                    <div class="item" data-cue="slideInUp" data-delay="{{$loop->index + 1}}00">
                        <x-front.cardcontent :$content />
                    </div>
                    @endforeach
                </div>
                <!-- /carousel-->
            </div>
            @endif

        </section>
        <!-- /container-->

        <div class="marquee">
            <div class="track">
                <div class="content">&nbsp;Have Unforgettable Experiences... Have Unforgettable Experiences... Have
                    Unforgettable Experiences... Have Unforgettable Experiences... Have Unforgettable Experiences</div>
            </div>
        </div>
        <!-- /marquee-->

        <section class="margin_120_95" style="background-color: #fff;">
            <div class="title text-center pb-5">
                <small data-cue="slideInUp" data-delay="200">meet</small>
                <h2 data-cue="slideInUp" data-delay="300">The Practitioners</h2>
            </div>
            <div class="container" data-cue="slideInUp" data-delay="200">
                <div class="owl-practitioners owl-carousel owl-theme cardpractitioners">
                    @foreach ($facilitators as $practitioner)
                        <div class="item">
                            <x-front.cardpractitioner :$practitioner />
                        </div>
                    <!-- Iteem -->
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Newsletter -->
        <section class="wrappernewsletter home">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <div class="box-content">
                            <h1>Subscribe to our Newsletter</h1>
                            <h5 style="color: #7b9a70;" class="fw-light">We are growing our database of practitioners, services and content. Join our mailing list to receive updates, latest news, and content around holistic health & wellness.</h5>
                            <div>
                                <button type="button" class="btn_1 my-3" data-bs-toggle="modal" data-bs-target="#newsletterModal">
                                Subscribe to our newsletter
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Newsletter -->

        <div class="bg_white" style="padding-top:6rem;">
            <div class="container pb-4 px-3">
                <div class="row justify-content-between d-flex align-items-center add_bottom_90">
                    <div class="col-lg-5 order-2 order-lg-1">
                        <img src="{{ asset('assets/images/missionimage.jpeg') }}" loading="lazy" alt="Our mission" class="img-fluid rounded mb-2">
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="title">
                            <small>about us</small>
                            <h3>Our Mission</h3>
                            <p>To make health, healing and higher consciousness more accessible through a global community of practitioners offering holistic health and wellness educational content, events, alternative therapies, and retreats.</p>
                            {{-- <p><a href="#" class="btn_1 mt-1 outline">More About Us</a></p> --}}
                        </div>
                    </div>
                </div>
                <!-- /row-->
                <div class="row justify-content-between d-flex align-items-center">
                    <div class="col-lg-6 ">
                        <div class="title">
                            <small>How we define</small>
                            <h3>Wowness</h3>
                            <p>Wowness is a state of being we can achieve throughout the healing journey. When we start peeling the layers of our traumas, fears, and conditioning and connecting with a higher frequency and our essence, LOVE. In this frequency, we find joy, acceptance, abundance, gratitude and connection with ourselves, nature and others.</p>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <img src="{{ asset('assets/images/lovefrequencysmall.png') }}" loading="lazy" alt="How we define Wowness" class="w-100 mb-2 rounded">
                    </div>
                </div>
                <!-- /row-->

                <!-- /row-->
                <div class="row justify-content-between d-flex align-items-center">
                    <div class="col-lg-5">
                        <img src="{{ asset('assets/images/becomeapractitioner.png') }}" loading="lazy" alt="Become a practitioner" class="w-100 mb-2 rounded">
                    </div>
                    <div class="col-lg-6 ">
                        <div class="title">
                            <small>join us</small>
                            <h3>Become a Practitioner</h3>
                            <p>Are you a professional in the health and wellness industry? Register as a practitioner and join our community.</p>
                            @if (!Auth::check() || Auth::user()->isCommonUser())
                            <p><a href="https://practitioners-application.wownessclub.com/" target="blank" class="btn_1 mt-1 outline">Partner With Us</a></p>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /row-->
            </div>
        </div>
        <!-- /bg_white -->

        <div class="parallax_section_1 jarallax" data-jarallax data-speed="0.2">
            <img class="jarallax-img kenburns-2" src="{{ asset('assets/images/backgrounds/bg-depos.jpeg') }}"
                alt="Woman meditating" loading="lazy">
            <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center"
                data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="title white">
                                <small class="mb-1">Testimonials</small>
                                <h2>What Clients Says</h2>
                            </div>
                            <div class="carousel_testimonials owl-carousel owl-theme nav-dots-orizontal">
                                <div>
                                    <div class="box_overlay">
                                        <div class="pic">
                                            <h4>Janine<small>25 April</small></h4>
                                        </div>
                                        <div class="comment">
                                            “Wow! The platform is so clean and intuitive. It gives a very welcoming
                                            feeling of a community. I can find different experiences depending on my
                                            mood hehehe.”
                                        </div>
                                    </div>
                                    <!-- End box_overlay -->
                                </div>
                                <div>
                                    <div class="box_overlay">
                                        <div class="pic">
                                            <h4>Paul<small>29 April Nov</small></h4>
                                        </div>
                                        <div class="comment">
                                            "As a practitioner in the health and wellness industry, sales and marketing
                                            has always been a struggle, attracting clients, managing and selling all the
                                            different services I have through different platforms. WOWness Club offers
                                            an all-in-one solution."
                                        </div>
                                    </div>
                                    <!-- End box_overlay -->
                                </div>
                                <div>
                                    <div class="box_overlay">
                                        <div class="pic">
                                            <h4>Clover<small>30 April</small></h4>
                                        </div>
                                        <div class="comment">
                                            "I love how the platform offers a WIN-WIN solution for the health and
                                            wellness industry. It is easy to find new clients, but also for clients to
                                            find professionals."
                                        </div>
                                    </div>
                                    <!-- End box_overlay -->
                                </div>

                                <div>
                                    <div class="box_overlay">
                                        <div class="pic">
                                            <h4>Andrew<small>5 May</small></h4>
                                        </div>
                                        <div class="comment">
                                            "I loved the idea to have a platform that helps to attract new clients,
                                            strengthen my personal brand and credibility without relying on social media
                                            or paying for ads."
                                        </div>
                                    </div>
                                    <!-- End box_overlay -->
                                </div>

                            </div>
                            <!-- End carousel_testimonials -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /parallax_section_1-->

        <!-- Blog Section -->
        @if($posts->count())
        <section class="mt-4">
            <div class="container">
                <div class="title mb-3">
                    <small data-cue="slideInUp">news</small>
                    <h2 data-cue="slideInUp" data-delay="200">Blog</h2>
                </div>
                <div class="home slider-feature-blog owl-carousel owl-theme">
                    @foreach ($posts as $post)
                        <!-- Blog item -->
                        <div class="item" data-cue="slideInUp" data-delay="{{$loop->index + 1}}00">
                            <x-front.cardblog :$post />
                        </div>
                        <!-- Final Blog item -->
                    @endforeach
                </div>
                <div class="d-flex justify-content-end">
                    <p><a href="{{ route('posts.blog') }}" class="btn_1 mt-1 outline">View all posts</a></p>
                </div>
            </div>
        </section>
        @endif
        <!-- /Blog Section-->

    </main>

</x-default-layout>

<style>
    .fs-title {
        font-size: 63px;
        font-weight: 800;
        text-align: center;
        color: #fff;
    }

    .slider-feature-goals .owl-nav {
        top: 35%;
    }

    @media (max-width: 466px) {
        .fs-title {
        font-size: 50px;
        }
    }

</style>

<script>

    let texts = document.querySelectorAll(".box-home-title h3");

    let prev = null;
    let animate = (curr, currIndex) => {
        let index = (currIndex + 1) % texts.length
        setTimeout(() => {
            if(prev) {
                prev.className = "";
            }

            curr.className = "show";
            prev = curr;
            animate(texts[index], index);
        }, 3500);
    }

    animate(texts[0], 0);

    if (document.querySelector("#inputSearchHome")) {
        document.querySelector("#inputSearchHome").addEventListener('click', function() {
            document.querySelector(".box-helper-search").classList.add("show");
            document.querySelector(".bg-fade-search").classList.add("showBg");
            this.classList.add("showInput");
        })
    }

    if (document.querySelector(".bg-fade-search")) {
        document.querySelector(".bg-fade-search").addEventListener('click', function() {
            document.querySelector(".box-helper-search").classList.remove("show");
            this.classList.remove("showBg");
            document.querySelector("#inputSearchHome").classList.remove("showInput")
        })
    }
</script>
