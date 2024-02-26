@section('title', 'Blog |')

<x-default-layout>

    @include('front.layouts.headermain')

    <main>
        <section class="banner-inner-page"
            style="background-image:url({{ asset('assets/images/banners/bannerblog.png') }});">
            <h1 data-cue="slideInUp">Wowness News</h1>
            <ul class="breadcrumb" data-cue="slideInUp" data-delay="200">
                <li><a href="{{route('home')}}">Home</a></li>
                <li>></li>
                <li><a href="{{route('posts.blog')}}">Blog</a></li>
            </ul>
        </section>

        <section class="search-blog text-center py-5">
            <div class="container">
                <div data-cue="slideInUp" class="row justify-content-center gap-3">
                    <h2 class="fw-semibold pb-1">{{ __('Search what you need') }}</h2>
                    <div class="col-12 col-lg-6">
                        <form method="GET" action="{{ route('posts.blog') }}" class="d-flex align-items-center" style="position:relative;">
                            <i class="bi bi-search" style="position: absolute;left: 15px;color: #b9b9b9;"></i>
                            <input id="filter_name" name="q" type="text" class="form-control"
                                placeholder="{{ __('Search by title post') }}" value="{{ request('q', '') }}">
                        </form>
                    </div>
                    @if (request('q', ''))
                        <a href="{{ route('posts.blog') }}" class="btn_1 col-11 col-sm-6 col-lg-2 px-2">Clear filters</a>
                    @endif
                </div>
            </div>
        </section>

        <section class="pb-4">
            <div class="container">
                <div class="title mb-3">
                    <small data-cue="slideInUp">news in blog</small>
                    <h2 data-cue="slideInUp" data-delay="200">Newsletter</h2>
                </div>
                <div class="row justify-content-center home">

                    @forelse ($posts as $post)
                        <!-- Blog item -->
                        <div class="item col-xl-4 col-lg-6" data-cue="slideInUp" data-delay="{{$loop->index + 1}}00">
                            <x-front.cardblog :$post />
                        </div>
                        <!-- Final Blog item -->
                    @empty
                        <h3 class="text-center">No posts</h3>
                    @endforelse
                </div>
                
                <div class="card-body my-4">
                    @if ($posts->hasPages())
                        {!! $posts->withQueryString()->links() !!}
                    @endif
                </div>
                
            </div>
        </section>

        <section class="section-magazine">
            <!-- /container-->
            <div class="title mb-3 text-center">
                <small data-cue="slideInUp">Free Digital Magazine</small>
                <h2 data-cue="slideInUp" data-delay="200">The best for you!</h2>
            </div>
            <div data-cue="slideInUp" data-delay="200">
                <iframe src="https://player.flipsnack.com?hash=Q0Q4Q0Q2Q0M1QTgrdnRuZjdkNGYwZw==" width="100%" height="250" seamless="seamless" scrolling="no" frameBorder="0" allowFullScreen allow="autoplay; clipboard-read; clipboard-write"></iframe>
            </div>
        </section>

    </main>

    @foreach ($posts as $post)
        <x-front.modalblog :$post />
    @endforeach

</x-default-layout>

<style>
    main {
        background-color: #fff;
    }
</style>
