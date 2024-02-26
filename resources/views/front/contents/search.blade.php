
@section('title', 'Search for contents: ' . request('q', '') . ' |')

<x-default-layout>
    <style>
        #preloader {
            backdrop-filter: blur(10px);
            background-color: rgba(41, 43, 51, 0.6);
        }
    </style>

    @include('front.layouts.headersearch')

    <main>
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>></li>
                    <li><a href="{{ url()->current() }}" class="active">@lang('Search')</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <button class="buttonfilters d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="bi bi-sliders2"></i> Add Filters
                    </button>
                    <div class="box-content-default collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <x-admin.side-bar-search-content :results="$results" :categories="$categories"
                        :languages="$languages" :aimeds="$aimeds" :subcategories="$subcategories" :types="$types" />
                    </div>
                </div>

                <div class="col-md-8 col-lg-9">
                    <div class="box-content-default">
                        <div class="row">
                            @if (request('q', ''))
                                <div class="title mb-2">
                                    <small data-cue="slideInUp">content for</small>
                                    <h2 data-cue="slideInUp" data-delay="200">{{ request('q', '') }}</h2>
                                </div>
                            @endif
                            @forelse ($contents as $content)
                            <div class="col-xl-4 col-lg-6" data-cues="slideInUp" data-delay={{$loop->index + 3 . '00'}}>
                                <x-front.cardcontent :$content />
                            </div>
                            @empty
                            <h5 class="text-center">Ops, we couldn’t find this content in our database yet :(</h5>
                                <!-- Newsletter -->
                                <section class="wrappernewsletter">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-10 text-center">
                                                <div class="box-content">
                                                    <img src="https://cdn-icons-png.flaticon.com/128/5721/5721203.png" class="pb-3" alt="">
                                                    <h1>Didn't find what you need?</h1>
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
                            @endforelse
                        </div>

                        <div class="card-body text-right">
                            @if ($contents->hasPages())
                                {!! $contents->withQueryString()->links() !!}
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </main>

</x-default-layout>

<script>
    if (window.matchMedia("(max-width:767px)").matches) {
        document.querySelector("#collapseOne").classList.remove("show")
    }

    const form = document.querySelector("#search-form")

    const rangeInputs = document.querySelectorAll('input[type="range"]')

    function handleInputChange(e) {
    let target = e.target
    if (e.target.type !== 'range') {
        target = document.getElementById('range')
    }
    const min = target.min
    const max = target.max
    const val = target.value

    target.style.backgroundSize = (val - min) * 100 / (max - min) + '% 100%'
    }

    rangeInputs.forEach(input => {
        input.addEventListener('input', handleInputChange)
    })

    document.querySelectorAll('#search-form input:not([type="range"]):not([type="number"]):not([name="startDate"]):not(.flatpickr)').forEach(input => {
        input.addEventListener("change", () => form.submit())
    })

    document.querySelectorAll('li.option').forEach(input => {
        input.addEventListener("click", () => {
            document.querySelector("#country_id").value = input.getAttribute("data-value")
            form.submit()
        })
    })

</script>


