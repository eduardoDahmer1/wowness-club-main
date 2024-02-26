@section('title', 'Successful payment! |')

<x-default-layout>

    <main class="bg-success">

        <div class="text-center py-3">
        <img src="{{asset('assets/images/wownesslogocolorida.png')}}" width="100%" style="max-width:480px;padding:2rem;" alt="Logo Wowness Club"></a>
        </div>

        <section class="d-flex align-items-center justify-content-center">
            <div class="bg-white-80 col-11 col-md-12 col-xl-5 text-center p-4 rounded ">
                <div class="d-flex justify-content-center">
                    <lottie-player  src="https://lottie.host/e6cc05ff-e6ec-4c76-a184-c5118ed8d9d8/GnOJfPZ7Am.json"  background="transparent"  speed="1"  style="width: 130px; height: 130px; color: rgb(124, 154, 111)""  loop autoplay></lottie-player>
                </div>
                <h1 style="color: rgb(124, 154, 111); font-size:50px;">Payment confirmed!</h1>

                <h2> Hi {{$name}},</h2><br>
                <p style="color: rgb(0, 0, 0);" class="fs-5 pb-2">
                   Thank you for your order. <br>
                   You will receive an email confirmation shortly. <br>
                   Please read the details below to see if the practitioner<br>
                   has any after-purchase instructions for you.
                </p>

                  @if($after_purchase)
                  <h5>AFTER PURCHASE INSTRUCTIONS:</h5>
                  <p class="fs-5 pb-2 flex-wrap" style="word-wrap: break-word; color:rgb(27, 27, 27); font-size:50px;">{{$after_purchase}}</p>
                  @endif

                <div class="d-flex flex-wrap justify-content-center gap-4">
                    <a class="btn_p2 col-8 col-md-6 col-lg-5" href="{{ route('orders.indexSeeker') }}">View Order</a>
                    <a class="btn_p col-8 col-md-6 col-lg-5" href="{{ route('service.search') }}">Continue Browsing</a>
                </div>
            </div>
        </section>

    </main>

</x-default-layout>

<style>
    .bg-white-80 {
      background: #ffffff;
    }

    .bg-success {
       background: url({{asset('assets/images/backgrounds/bg-payment-sucess.jpg')}}) center center;
       background-size: cover;
       height: 130vh;
       opacity: 0.9;
    }

    .btn_p {
      background: rgb(124, 154, 111);
      color: #fff;
      padding: 15px 26px;
      border-radius: 50px;
      font-weight: 600;
      font-size: 18px;
    }

    .btn_p:hover {
      background: rgb(124, 154, 111);
      color: rgb(124, 154, 111);
    }

    .btn_p2 {
      background:rgb(190, 191, 189);
      color: rgb(254, 254, 254);
      padding: 15px 26px;
      border-radius: 50px;
      font-weight: 600;
      font-size: 18px;
    }
</style>
