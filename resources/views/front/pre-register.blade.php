@section('title', 'JOIN US |')

<x-default-layout>

    @include('front.layouts.headermain')

    <main>
        <section class="preregister" style="background-image: url({{ asset('assets/images/backgrounds/bg-preregister.png') }});">
            <div class="box-preregister" data-cue="slideInUp" data-delay="300">
                <div class="row">
                    <div class="p-3">
                        <h2 class="title-preregister" data-cue="slideInUp" data-delay="400" >How would you like to register?</h2>
                        <div class="row">

                            <div class="col-md-6" data-cue="slideInUp" data-delay="500">
                                <a href="{{ route('seeker.create') }}" class="box-imgs-options" style="background-image: url({{ asset('assets/images/backgrounds/bg-seeker-preregister.png') }});">
                                    <p class="text-center">I am a wowness seeker <i class="bi bi-arrow-right-circle-fill"></i></p>
                                </a>
                            </div>

                            <div class="col-md-6" data-cue="slideInUp" data-delay="600">
                                <a href="{{ route('facilitators.create') }}" class="box-imgs-options" style="background-image: url({{ asset('assets/images/backgrounds/bg-facilitator-preregister.png') }});">
                                    <p class="text-center">I am a practitioner <i class="bi bi-arrow-right-circle-fill"></i></p>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-auto">
                        <p>© Wowness Club</p>
                    </div>
                    <div class="col-auto">
                        <a class="btn_help float-end" href="http://wownessclub.co.uk/facilitators-faq">
                            <i class="bi bi-question-circle"></i> {{ __('Help') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-default-layout>

<style>

    header {
        backdrop-filter: blur(2px);
    }
    
    .preregister {
        padding: 20vh 0 10px;
        min-height: 100vh;
        background-size: cover
    }

    .box-preregister {
        max-width: 700px;
        margin: auto;
        background-color: #ffffffe5;
        padding: 0 30px;
        border-radius: 15px;
    }

    .box-preregister .box-imgs-options {
        height: 300px;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        border-radius: 20px;
        margin: 2rem 0;
        background-size: auto 100%;
        background-position: center;
    }

    .box-preregister .box-imgs-options:hover {
        background-size: auto 110%;
        background-position: center;
    }

    .box-preregister .title-preregister {
        text-align: center;
        color: #7d9a6f;
        padding-top: 3rem
    }

    .box-preregister .box-imgs-options p {
        background-color:#7d9a6f;
        font-weight: 600;
        text-transform: uppercase;
        text-align: center;
        color: #fff;
        padding: 10px 20px;
        border-radius: 15px;
    }

    .box-preregister .box-imgs-options:hover p {
        background-color:#fff;
        color: #7d9a6f;
        transition: all .5s;
    }

    @media (max-width:768px) {
        .box-preregister {
            padding: 0 10px;
            margin: 10px;
        }
    }

    footer {
        display: none
    }
    
</style>
