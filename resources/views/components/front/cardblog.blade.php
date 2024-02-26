@props(['post'])
@if($post->video)
<div data-bs-toggle="modal" data-bs-target="#exampleModal-{{$post->id}}" class="box_contents" data-cue="slideInUp" data-delay="300">
    <figure style="background: url('{{ asset('storage/' . $post->cover_photo) }}'); height: 290px; background-size: cover; background-repeat: no-repeat; background-position: center;">
        <em>{{($post->released_at ?? $post->created_at)->format('d M, Y')}}</em>
    </figure>
    <div class="wrapper">
        <small>new post<span></span></small>
        <h2>{{str($post->name)->limit(45, '...')}}</h2>
        <em>Read more</em>
    </div>
</div>
@else
<div class="box_contents">
    <a href="{{route('posts.show', $post->slug)}}" data-cue="slideInUp" data-delay="300">
        <figure style="background: url('{{ asset('storage/' . $post->cover_photo) }}'); height: 290px; background-size: cover; background-repeat: no-repeat; background-position: center;">
            <em>{{($post->released_at ?? $post->created_at)->format('d M, Y')}}</em>
        </figure>
        <div class="wrapper">
            <small>new post<span></span></small>
            <h2>{{str($post->name)->limit(45, '...')}}</h2>
            <em>Read more</em>
        </div>
    </a>
</div>
@endif