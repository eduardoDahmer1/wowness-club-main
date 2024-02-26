<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="{{ asset('assets/front/css/checkout.css') }}">
    <!-- BASE CSS -->
    <link href="{{ asset('assets/front/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/vendors.min.css')}}" rel="stylesheet">
    <title>Checkout for "{{$purchase->content->title}}"</title>

    <!-- GOOGLE WEB FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <meta name="purchase" content="{{$purchase->id}}">
    <meta name="stripePk" content="{{env('STRIPE_PRIMARY_KEY')}}">
    <meta name="returnUrl" content="{{route('purchases.payment-successfull')}}">
    <meta name="customerEmail" content="{{$purchase->user->email}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <main>

        <div class="container pt-4 pb-4">
            <div class="row justify-content-center">
                <img class="col-6 col-sm-4 col-md-2  p-2" src="{{ asset('assets/images/wownesslogocolorida.png') }}" alt="">
            </div>
        </div>

        <section class="container">

            <div class="row">
                <div class="col-12 col-lg-4 mb-3">

                    <div class="bg-white rounded">
                        <div class="rounded-top"
                            style="background: url('{{ asset('storage/' . $purchase->content->thumbnail) }}') center center;
                          height: 280px;
                          width: 100%;
                          background-size: cover;
                          background-repeat: no-repeat;">
                        </div>

                        <div>
                            <div class="py-3">
                                <h4 class="text-capitalize c-green px-4 pt-2">{{ $purchase->content->title }}</h4>
                                <h6 class="fst-italic fw-light px-4 py-2">{{ $purchase->content->subtitle }}</h6>
                                {{-- goals --}}
                                <div class="d-flex gap-1 flex-wrap justify-content-center">
                                    @foreach ($purchase->content->results as $result)
                                        <div class="bg-icons">
                                            <span class="d-flex gap-1 align-items-center"><img style="max-width: 16px"
                                                    src="{{ $result->icon }}"
                                                    alt="">{{ str($result->name)->limit(6, '...') }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- local/date --}}
                            <div class="px-4">

                                <div style="font-size: 16px;" class="pt-2 d-flex gap-1 align-items-center"><img style="max-width: 14px; "src="{{ $purchase->content->target->icon() }}" alt="">
                                {{ $purchase->content->target->name() }}
                                </div>

                                <div style="font-size: 16px;" class="pt-2 d-flex gap-1 align-items-center"><img style="max-width: 14px; "src="{{ $purchase->content->type->icon() }}" alt="">
                                    {{ $purchase->content->type->name() }}
                                </div>

                                <div style="font-size: 16px;" class="pt-2 d-flex gap-1 align-items-center"><img style="max-width: 14px; "src="{{ $purchase->content->aimed->icon() }}" alt="">
                                    {{ $purchase->content->aimed->name() }}
                                </div>
                            </div>

                            {{-- infos --}}
                            <div class="text-capitalize p-4" style="font-size: 16px; font-weight: 500;">

                                <div class="d-flex justify-content-between">
                                    <span style="color: #A6A6A6;">Practitioner</span>
                                    <p style="margin: 0;">{{ $purchase->content->user->alias }}</p>
                                </div>

                            </div>

                            {{-- Fee --}}
                            <div style="font-size: 20px;"
                                class="text-capitalize fw-bold d-flex justify-content-between pb-3 px-4">
                                <span class="c-green">Processing Fee:</span>
                                <p class="total-price" style="margin: 0;">£ {{ $fee }}</p>
                            </div>
                            {{-- amount --}}
                            <div style="font-size: 20px;"
                                class="text-capitalize fw-bold d-flex justify-content-between pb-3 px-4">
                                <span class="c-green">Amount:</span>
                                <p class="total-price" style="margin: 0;">£ {{ $netValue }}</p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="bg-white rounded row justify-content-center px-3">
                        <h2 style="color: #7D9A6F; padding-top:63px;" class="text-center">How do you want to pay?</h2>
                        <!-- Display a payment form -->
                        <form id="payment-form">
                            <div id="link-authentication-element">
                                <!--Stripe.js injects the Link Authentication Element-->
                            </div>
                            <div id="payment-element">
                                <!--Stripe.js injects the Payment Element-->
                            </div>
                            <button class="btn_1 py-3 rounded col-12" id="submit">
                                <div class="text-capitalize spinner hidden" id="spinner"></div>
                                <span id="button-text">Pay now</span>
                            </button>
                            <div id="payment-message" class="hidden"></div>
                            <div id="adress">
                                <!--Stripe.js injects the Payment Element-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </main>

    {{-- Stripe Checkout --}}
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('assets/front/js/checkout-purchase.js') }}"></script>
</body>
</html>
