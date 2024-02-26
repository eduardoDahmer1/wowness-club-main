@section('title', 'Plans |')

<x-default-layout>

    @include('front.layouts.headermain')

    <main>
        <section class="banner-inner-page"
            style="background-image:url({{ asset('assets/images/banners/bannerblog.png') }});">
            <h1 data-cue="slideInUp">Wowness Plans</h1>
            <ul class="breadcrumb" data-cue="slideInUp" data-delay="200">
                <li><a href="{{route('home')}}">Home</a></li>
                <li>></li>
                <li><a href="#">Plans</a></li>
            </ul>
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <strong> {{$errors->first()}} </strong>
              </div>
            @endif
        </section>

        <section class="pb-4">
            <div class="container">
                <div class="row justify-content-center home">
                    <script async src="https://js.stripe.com/v3/pricing-table.js"></script>
                    <stripe-pricing-table pricing-table-id="prctbl_1OKMOLHURowfxygsvmZFpyAs"
                    publishable-key="pk_live_51N63OAHURowfxygs6GoerbSYotZSLoF8i2iME9tzORhMe6U09lXkRnaKZtG5GEnN4EHsrzdSZfN810vF59VZwuBO00uelBhRHq" client-reference-id="{{ auth()->user()->id }}">
                    </stripe-pricing-table>

                </div>

                <div class="card-body my-4">

                </div>

            </div>
        </section>

    </main>

</x-default-layout>

<style>
    main {
        background-color: #fff;
    }
</style>
