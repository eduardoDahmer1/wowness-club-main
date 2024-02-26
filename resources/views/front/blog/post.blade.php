@section('specificmetatags')
<!-- title -->
<title>{{str($post->name)->limit(35,'...')}} | Wowness Club</title>
<meta property='og:title'  content="Post by {{ $post->user->name}} in {{$post->updated_at->format('d M, Y')}} | Blog Wowness Club">
<meta name='twitter:title' content="Post by {{ $post->user->name}} in {{$post->updated_at->format('d M, Y')}} | Blog Wowness Club">

<!-- description -->
<meta name='description' content='{{str($post->name)->limit(70,'...')}}'>
<meta property='og:description' content='{{str($post->name)->limit(70,'...')}}'>
<meta name='twitter:description' content='{{str($post->name)->limit(70,'...')}}'>

<!-- image -->
<meta property="og:image"  content="{{ asset('storage/' . $post->cover_photo) }}">
<meta name="twitter:image" content="{{ asset('storage/' . $post->cover_photo) }}">

<meta property="og:image:width" content="400" />
<meta property="og:image:height" content="400" />
@endsection

<x-default-layout>

    @include('front.layouts.headermain')

    <main>
        <section class="banner-inner-page"
         style="background-image:url({{ asset('storage/' . ($post->banner ?? $post->cover_photo))}});">
            <h1 data-cue="slideInUp">{{ $post->name }}</h1>
            <h6 data-cue="slideInUp" data-delay="200">{{($post->released_at ?? $post->created_at)->format('d M, Y')}} - By {{ $post->author ?? $post->user->name}}</h6>
        </section>

        <section>
            <div class="container">
                <div class="content-post" data-cue="slideInUp">
                    {!! $post->body !!}
                </div>
                @if ($post->nextPost())
                <p class="text-center pb-4"><a href="{{ route('posts.show', $post->nextPost()) }}" class="btn_1 outline mb-4 text-uppercase" data-cue="slideInUp" data-delay="600">Next post</a></p>
                @endif
            </div>
        </section>

        @if ($post->flipsnack_embed)
        <section class="section-magazine">
            <!-- /container-->
            <div class="title mb-3 text-center">
                <small data-cue="slideInUp">Free Digital Magazine</small>
                <h2 data-cue="slideInUp" data-delay="200">The best for you!</h2>
            </div>

            <div data-cue="slideInUp" data-delay="200">
                {!! $post->flipsnack_embed !!}
            </div>
        </section>
        @endif

    </main>

</x-default-layout>