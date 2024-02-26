@section('title', 'Profile '. $user->alias .' |')

<x-default-layout>
    @include('front.layouts.headersearch')
    <main>

        <section class="container">

            <div class="pb-2 justify-content-center">

                <div class="breadcrumb px-2">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>></li>
                        <li><a href="#" class="active">@lang('Practitioner')</a></li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-lg-2 mb-4">
                        <div data-cue="slideInUp" class="photo"
                            style="background: url('{{ asset('storage/' . $user->photo) }}') center center; background-size: cover; background-repeat: no-repeat;">
                        </div>
                    </div>
                    <div class="col-md-10 d-flex flex-column justify-content-center ps-4">
                        <!-- <div>
                            <p class="fw-bold m-0"><span><img src="https://i.ibb.co/99CwpxV/Group-10.png"
                                        alt=""></span>4.93 <span style="font-size: 14px;"
                                    class="text-decoration-underline fw-light">985 Reviews</span></p>
                        </div> -->
                        @if($user->isPaying())
                            <div class="d-flex justify-content-start pt-3">
                                @if ($user->facebook)
                                <a target="_blank" href="{{ $user->facebook }}"><img class="px-1" style="max-width: 50px;"
                                        src="https://i.ibb.co/TPQZbr6/image-13.png" alt=""></a>
                                @endif
                                @if ($user->instagram)
                                <a target="_blank" href="{{ $user->instagram }}"><img class="px-1"
                                        style="max-width: 50px;" src="https://i.ibb.co/HDwwPBx/image-14.png"
                                        alt=""></a>
                                @endif
                                @if ($user->linkedin)
                                <a target="_blank" href="{{ $user->linkedin }}"><img class="px-1" style="max-width: 50px;"
                                        src="https://i.ibb.co/hDjsx8S/image-15.png" alt=""></a>
                                @endif

                                @if ($user->youtube)
                                <a target="_blank" href="{{ $user->youtube }}"><img class="px-1" style="max-width: 50px;"
                                        src="https://i.ibb.co/Ld02B5J/image-16.png" alt=""></a>
                                @endif

                                @if ($user->tiktok)
                                <a target="_blank" href="{{ $user->tiktok }}"><img class="px-1" style="max-width: 50px;"
                                        src="https://i.ibb.co/t3PCQdN/image-17.png" alt=""></a>
                                @endif

                                @if ($user->twitter)
                                <a target="_blank" href="{{ $user->twitter }}"><img class="px-1" style="max-width: 50px;"
                                        src="https://i.ibb.co/nkgt6gK/image-18.png" alt=""></a>
                                @endif

                                @if ($user->site)
                                <a target="_blank" href="{{ $user->site }}"><img class="px-1" style="max-width: 43px;"
                                        src="https://cdn-icons-png.flaticon.com/128/3178/3178285.png" alt=""></a>
                                @endif
                            </div>
                            <div class="pt-3 d-flex">
                                <div id="NumberFollowers"></div>
                                @if (Auth::check())
                                <div id="ButtonFollow" class="d-flex justify-content-center"></div>
                                <div id="ButtonInitChatPract" class="ms-2" style="background-color: #fff;"></div>
                                @else
                                <button type="button" class="btn_follow fw-bold" data-bs-toggle="modal" data-bs-target="#modalLogin"><i class="bi bi-person-plus-fill me-1"></i> Follow</button>
                                <button type="button" class="btn_follow fw-bold ms-2" data-bs-toggle="modal" data-bs-target="#modalLogin">Start Chat</button>
                                @endif
                            </div>
                        @endif
                        <div id="liveAlertPlaceholder"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <!-- Share -->
                        <div data-cue="slideInUp">
                            <div class="d-flex justify-content-center my-2">
                                <div class="c-share">
                                    <input class="c-share__input" type="checkbox" id="checkbox">
                                    <label class="c-share__toggler" for="checkbox">
                                        <span class="c-share__icon"></span>
                                    </label>

                                    <ul class="c-share_options" data-title="Share">
                                        <li><a target="_blank"
                                                href="https://api.whatsapp.com/send?text={{ url()->current() }}"><img
                                                    style="max-width: 35px;"
                                                    src="https://yata-apix-c5d75a7d-0220-4381-99f9-4338b659364d.s3-object.locaweb.com.br/00a2242d7baf4a979181f443a3d86ab2.png"
                                                    alt=""></a></li>
                                        <li><a target="_blank"
                                                href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><img
                                                    style="max-width: 35px;"
                                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/2021_Facebook_icon.svg/2048px-2021_Facebook_icon.svg.png"
                                                    alt=""></a></li>
                                        <li><a target="_blank"
                                                href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}"><img
                                                    style="max-width: 35px;" src="https://i.ibb.co/GtByRRf/linke.png"
                                                    alt=""></a></li>
                                        <li><a id="cpLink" href="">
                                                <img style="max-width: 35px;" src="https://i.ibb.co/7t5by4R/copiar-link.png"
                                                    alt=""></a>
                                            <input style="whidth: 0; height: 0; opacity: 0;" id="text" type="text"
                                                value="{{ url()->current() }}">
                                        </li>
                                    </ul>
                                </div>
                                <label for="checkbox" style="color: #7D9A6F;"
                                    class="d-flex align-items-center px-2 fw-semibold">Share
                                </label>
                            </div>
                        </div>
                        <!-- Final -->
                    </div>
                    <!-- <div class="col-md-10">
                        <div class="my-2">
                            Aqui vai os botoes do chat e follow
                        </div>
                    </div> -->
                </div>

                <!-- section1 -->
                <div class="row">

                    <div data-cue="slideInUp" class="col-12">
                        <div class="margin-top">
                            <h1 class="nome">{{ $user->alias }}</h1>
                            <p class="text-color my-2 fw-normal">{{ $user->headline }}</p>
                            @if($user->quote)
                            <p class="quote col-lg-10 my-2">“{{ $user->quote }}”</p>
                            @endif

                            <!-- categorias -->
                            <div data-cue="slideInUp" class="col-12 col-lg-9 pt-1 pb-3 ">
                                <div class="categories">
                                    @foreach ($user->categoriesuser as $categorie)
                                        <div class="d-flex px-1 py-1">
                                            <span style="font-size: 14px;"
                                                class="d-flex justify-content-center bg-icons2 fw-semibold">
                                                <img src="{{ asset('storage/' . $categorie->icon) }}"
                                                    alt="">{{ $categorie->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <p class="my-2" style="color: #444444;padding: 10px;background-color: #fff;">{{ $user->bio }}</p>

                            @if ($user->languages->count() > 0)
                            <div class="my-3">
                                <h5 class="m-0" style="color: #444;letter-spacing: 1px;">Languages</h5>
                                <p class="m-0">
                                <img style="max-height: 15px;" src="https://i.ibb.co/frRsstZ/mingcute-world-2-line.png" alt="">
                                @foreach ($user->languages as $language)
                                    {{$language->name}}{{ !$loop->last ? ',' : ''}}
                                @endforeach
                                </p>
                            </div>
                            @endif

                            @if ($user->specialisations->count() > 0)
                            <div class="my-3">
                                <h5 class="m-0" style="color: #444;letter-spacing: 1px;">Qualitications, Specialisations & Experience</h5>
                                @foreach ($user->specialisations as $specialisation)
                                    <p class="m-0">{{$specialisation->name}}</p>
                                @endforeach
                            </div>
                            @endif

                            @if ($user->years_experience)
                            <div class="my-3">
                                <h5 class="m-0" style="color: #444;letter-spacing: 1px;">Years of Experience</h5>
                                <p class="m-0">{{$user->years_experience}} </p>
                            </div>
                            @endif

                            @if ($user->offer)
                            <div class="my-3">
                                <h5 class="m-0" style="color: #444;letter-spacing: 1px;">Conditions </h5>
                                <p class="m-0">{{ $user->offer}} </p>
                            </div>
                            @endif

                            @if ($user->help)
                            <div class="my-3">
                                <h5 class="m-0" style="color: #444;letter-spacing: 1px;">Clients </h5>
                                <p class="m-0">{{ $user->help }} </p>
                            </div>
                            @endif

                        </div>
                    </div>

                </div>
                <!-- /section1 -->

                <!-- cetificados -->
                @if ($user->certificates->count() && $user->show_certificates)
                    <div data-cue="slideInUp">
                        <div class="form-group multiple-files">
                            <div class="box-galleries">
                                <div class="my-3 fw-semibold tx-center"><span
                                        style="letter-spacing: 3px; font-size: 22px; color: #666666;">Qualifications/Insurance</span>
                                </div>
                                <div class="certificate gap-2">
                                    @foreach ($user->certificates as $certificate)
                                        @if (in_array(pathinfo(asset('storage/' . $certificate->file), PATHINFO_EXTENSION), [
                                                'jpg',
                                                'jpeg',
                                                'png',
                                                'webp',
                                                'gif',
                                                'svg',
                                            ]))
                                            <div class="box-image-gallery gallery">
                                                <a href="{{ asset('storage/' . $certificate->file) }}"><img
                                                        class="rounded" width="110px" height="110px"
                                                        src="{{ asset('storage/' . $certificate->file) }}"
                                                        alt=""></a>
                                            </div>
                                        @else
                                            <div class="box-image-gallery" id="certificate-{{ $certificate->id }}"
                                                style="background: #fff;">
                                                <a href="{{ asset('storage/' . $certificate->file) }}"
                                                    class="text-center w-100 p-2 " target="_blank">
                                                    <svg width="40" height="40" viewBox="0 0 40 40"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.86886 35.9993C8.96887 35.9993 8.19816 35.6785 7.55672 35.0371C6.91528 34.3957 6.5951 33.6255 6.59619 32.7266V14.4406C6.59619 14.0042 6.67801 13.5886 6.84164 13.1937C7.00528 12.7988 7.23709 12.4508 7.53708 12.1497L15.4733 4.21353C15.7733 3.91354 16.1213 3.68173 16.5173 3.51809C16.9133 3.35446 17.3289 3.27264 17.7642 3.27264H29.5048C30.4048 3.27264 31.1755 3.59336 31.817 4.23481C32.4584 4.87625 32.7786 5.64641 32.7775 6.54531V32.7266C32.7775 33.6266 32.4568 34.3973 31.8153 35.0387C31.1739 35.6802 30.4037 36.0003 29.5048 35.9993H9.86886ZM9.86886 32.7266H29.5048V6.54531H17.8051L9.86886 14.4815V32.7266ZM19.6868 27.1222C19.905 27.1222 20.1096 27.0878 20.3005 27.0191C20.4914 26.9503 20.6686 26.8347 20.8323 26.6722L25.1276 22.3768C25.4276 22.0768 25.5776 21.7086 25.5776 21.2723C25.5776 20.8359 25.414 20.4541 25.0867 20.1269C24.7867 19.8269 24.4115 19.6769 23.9609 19.6769C23.5104 19.6769 23.122 19.8269 22.7959 20.1269L21.3232 21.5177V16.3633C21.3232 15.8997 21.1661 15.5108 20.8519 15.1966C20.5377 14.8824 20.1494 14.7259 19.6868 14.727C19.2232 14.727 18.8343 14.884 18.5201 15.1982C18.206 15.5124 18.0494 15.9008 18.0505 16.3633V21.5177L16.5778 20.0859C16.2505 19.7859 15.8687 19.636 15.4324 19.636C14.996 19.636 14.6142 19.7996 14.2869 20.1269C13.987 20.4268 13.837 20.8087 13.837 21.2723C13.837 21.7359 13.987 22.1177 14.2869 22.4177L18.5414 26.6722C18.705 26.8358 18.8823 26.952 19.0732 27.0207C19.2641 27.0894 19.4687 27.1233 19.6868 27.1222Z"
                                                            fill="#555555" />
                                                    </svg>
                                                    <small>{{ str(basename($certificate->original_name))->limit(6, '...') . pathinfo(asset('storage/' . $certificate->file), PATHINFO_EXTENSION) }}</small>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                @endif
                <!-- /cetificados -->

                @if ($user->testimonials->count() > 0)
                <div class="row justify-content-center">
                    <div class="col-12">
                        <!-- titulo -->
                        <div style="padding-top: 70px;">
                            <span class="fw-bold"
                                style="color: #7D9A6F; letter-spacing: 2px; text-transform: uppercase; font-size: 18px;">Customer Feedback</span>
                            <h2 style="font-size: 38px;">Testimonials</h2>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="owl-testimonials owl-carousel owl-theme owl-loaded">
                            @foreach ($user->testimonials as $testimonial)
                            <div class="item">
                                <iframe width="100%" src="https://www.youtube.com/embed/{{substr($testimonial->name, -11)}}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                height="250"
                                style="border-radius: 15px;border: 1px solid #7d9a6f;"
                                ></iframe>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                @endif

                <!-- section4 avaliações -->
                @if($reviews->isNotEmpty())
                    <div class="mt-5">
                        <h2 class="fw-normal">Reviews</h2>
                        <div class="d-flex aling-items-center mb-4">
                            <i style="font-size: 1.2rem;color:gold;" class="bi bi-star-fill"></i>
                            <p style="line-height: 2;" class="fw-bold m-0 px-1">{{ $user->overall }} <span class="fw-normal" style="text-decoration: underline;">({{$reviewsCount}} Reviews)</span></p>
                        </div>
                    </div>
                @foreach($reviews as $review)           
                    <div class="col-12 col-md-6 bg-review mb-4 position-relative">
                        <input class="rating text-center size-stars mb-2" name="overall" min="{{$review->overall}}" max="{{$review->overall}}" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.1" style="--value:{{$review->overall}}" type="range">
                        <h3 style="font-size: 22px;" class="fw-semibold mb-0">{{ $review->title }}</h3>
                        <span style="color: #878787;">{{ $review->user->name }} - {{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}</span>
                        <div class="pt-1" style="padding-right: 20px;">
                            <span style="font-size: 14px;" class="fw-semibold">{{ $review->order?->package->service->name }}</span>
                        </div>
                        <span style="font-size: 12px; color: #878787;" class="fw-semibold">{{ $review->description }}</span>
                        <span style="
                            top: 0;
                            right: 0;
                            margin: 20px 40px;
                            background: #444444;
                            padding: 2px 30px;
                            border-radius: 50px;
                            color: #fff;
                            font-weight: 500;
                        " 
                        class="position-absolute">Verified</span>
                    </div>
                @endforeach
                <!-- botão -->
                <div class="text-left">
                    <a class="btn_1" href="#">See all Reviews</a>
                </div>
                @endif
                <style>
                    .bg-review {
                        background: #F2F5F2;
                        border-radius: 10px;
                        padding: 30px 50px;
                    }
                </style>
                <!-- /section4 avaliações -->

                <div class="row p-0 justify-content-center">

                    <!-- titulo -->
                    <div style="padding-top: 70px;">
                        <span class="fw-bold"
                            style="color: #7D9A6F; letter-spacing: 2px; text-transform: uppercase; font-size: 18px;">services
                            for practitioner</span>
                        <h2 style="font-size: 38px;">{{ $user->alias }}</h2>
                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="row">
                        @if (request('q', ''))
                            <div class="title mb-2">
                                <small data-cue="slideInUp">service for</small>
                                <h2 data-cue="slideInUp" data-delay="200">{{ request('q', '') }}</h2>
                            </div>
                        @endif
                        <div class="col-12 mb-3">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="service-tab" data-bs-toggle="tab" data-bs-target="#service" type="button" role="tab" aria-controls="service" aria-selected="true">Services</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="freecontent-tab" data-bs-toggle="tab" data-bs-target="#freecontent" type="button" role="tab" aria-controls="freecontent" aria-selected="false">Free Content</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="paidcontent-tab" data-bs-toggle="tab" data-bs-target="#paidcontent" type="button" role="tab" aria-controls="paidcontent" aria-selected="false">Paid Content</button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="service" role="tabpanel" aria-labelledby="service-tab">
                                <div class="row">
                                    @forelse ($services as $service)
                                        <div class="col-md-6 col-lg-4 col-xl-3" data-cues="slideInUp"
                                            data-delay="{{ $loop->index + 3 . '00' }}">
                                            <x-front.cardservice :$service />
                                        </div>
                                    @empty
                                        <h5 class="text-center">No services found :(</h5>
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane fade" id="freecontent" role="tabpanel" aria-labelledby="freecontent-tab">
                                <div class="row">
                                    @forelse ($freecontents as $content)
                                        <div class="col-md-6 col-lg-4 col-xl-3" data-cues="slideInUp"
                                            data-delay="{{ $loop->index + 3 . '00' }}">
                                            <x-front.cardcontent :$content />
                                        </div>
                                    @empty
                                        <h5 class="text-center">No free content found :(</h5>
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane fade" id="paidcontent" role="tabpanel" aria-labelledby="paidcontent-tab">
                                <div class="row">
                                    @forelse ($paidcontents as $content)
                                        <div class="col-md-6 col-lg-4 col-xl-3" data-cues="slideInUp"
                                            data-delay="{{ $loop->index + 3 . '00' }}">
                                            <x-front.cardcontent :$content />
                                        </div>
                                    @empty
                                        <h5 class="text-center">No paid content found :(</h5>
                                    @endforelse
                                </div>
                            </div>

                        </div>

                        <div class="pb-4">
                            @if ($services->hasPages())
                                {!! $services->withQueryString()->links() !!}
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
</x-default-layout>
<link href="{{ asset('assets/front/css/stars.css')}}" rel="stylesheet">
<style>
    .c-share {
        position: relative;
        width: 2.5em;
        height: 2.5em;
    }

    .c-share__input {
        display: none;
    }

    .c-share__input:checked~.c-share_options {
        width: 14em;
        height: 6.3em;
        border-radius: 0.3125em;
        box-shadow: 0 2px 5px 1px rgb(218, 218, 218);

        &::before,
        li {
            transition: 0.3s 0.15s;
            opacity: 1;
            transform: translateY(0);
        }
    }

    .c-share__toggler,
    .c-share_options {
        position: absolute;
        width: inherit;
        height: inherit;
        border-radius: 50%;
        background-color: #ffffff;
    }

    .c-share__toggler {
        cursor: pointer;
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .c-share__icon {
        background: url('https://i.ibb.co/600Nqg1/material-symbols-share.png') center center;
        background-size: cover;
        background-repeat: no-repeat;
        width: 25px;
        height: 25px;
        position: absolute;
    }

    .c-share__input:checked~.c-share__toggler .c-share__icon {
        background: url('https://i.ibb.co/vwSvPvG/iconX.png') center center;
        background-size: cover;
        background-repeat: no-repeat;
        width: 13px;
        height: 13px;
    }

    .c-share_options {
        display: flex;
        gap: 10px;
        padding: 0;
        padding-left: 15px;
        list-style: none;
        margin: 0;
        box-sizing: border-box;
        overflow: hidden;
        transition: 0.2s;

    }

    .c-share_options li {
        margin-top: 40px;
    }

    .c-share_options::before,
    .c-share_options li {
        transform: translateY(0.625em);
        transition: 0s;
    }

    .box-image-gallery {
        width: 110px;
        height: 110px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 10px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-color: white;
        border-radius: 6px;
        position: relative;
        box-shadow: 1px 2px 10px -6px #8e8e8e;
        background-color: #fff;
    }

    .box-image-gallery i:hover {
        opacity: 1;
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

    .certificate {
        display: flex;
        flex-wrap: wrap;
    }

    .categories {
        display: flex;
        flex-wrap: wrap;
    }

    .text-color {
        color: #444444;
    }

    .quote {
        font-style: italic;
        font-weight: 700;
        line-height: 35px;
        font-size: 20px;
        color: #7D9A6F;
    }

    .nome {
        margin: 0;
        padding: 0;
        font-weight: 600;
        font-size: 42px;
    }

    .photo {
        height: 192px;
        padding-right: 10px;
        border-radius: 100%;
    }

    .p-left {
        padding-left: 30px;
    }

    @media (max-width: 991px) {
        .photo {
            height: 400px;
        }

        .nome {
            font-size: 45px;
        }

        .quote {
            font-size: 24px;
            line-height: 30px;
        }
    }

    @media (max-width: 767px) {
        .margin-top {
            margin-top: 20px;
        }
        .tx-center {
            text-align: center;
        }

        .certificate {
            justify-content: center;
        }

        .photo {
            height: 350px;
        }

        .nome {
            font-size: 40px;
            margin-top: 20px;
        }

        .quote {
            font-size: 20px;
        }
    }
    .nav-tabs .nav-link {
        color: #7c996e;
    }
</style>

<script>

    const userPractitioner = {!! $user !!};

    var lightbox = new SimpleLightbox('.gallery a');

    const cpLink = document.querySelector('#cpLink');
    // const url_atual = window.location.href;

    cpLink.addEventListener('click', function(event) {
        event.preventDefault();
        const textInput = document.getElementById('text');
        textInput.select();
        document.execCommand('copy');
    });
</script>
