@section('title', 'Posts')

<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Posts</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">@lang('Posts')</h1>
                </div>

            </div>
        </div>
        <div class="container-fluid page__container">
            <div class="card card-form d-flex flex-column flex-sm-row">
                <div class="card-form__body card-body-form-group flex">
                    <div class="row">
                        <div class="col-sm-auto col-lg-4">
                            <div class="form-group">
                                <label for="filter_name"></label>
                                <x-admin.search />
                            </div>
                        </div>

                        <div class="col-sm-auto d-flex align-items-end">
                            <div class="form-group">
                                <a href="{{ route('posts.create') }}" class="btn btn-primary p-2 text-uppercase fw-bold"><i class="material-icons">add</i>New Post</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card">

                <div class="table-responsive" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                    <table class="table mb-0 thead-border-top-0 table-striped">
                        <thead>
                            <tr>

                                <th style="width: 30px;" class="text-center">#ID</th>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th class="text-center">Created</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody class="list" id="companies">

                            @forelse($posts as $post)

                                <tr @class(['bg-tr' => $loop->index % 2 == 0])>
                                    <td>
                                        <div class="badge badge-light">#{{ Str::limit($post->id, 6, "...") }}</div>
                                    </td>
                                    <td>
                                        <h6 class="m-0">{{ $post->name }}</h6>
                                    </td>
                                    <td>
                                        <small>{{ $post->author ?? $post->user->name }}</small>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input name="status" type="checkbox" id="verified-for-{{ $post->id }}"
                                                data-id-post="{{ $post->id }}" class="custom-control-input"
                                                @checked($post->status)>
                                            <label class="custom-control-label"
                                                for="verified-for-{{ $post->id }}">..</label>
                                        </div>
                                        <label for="verified-for-{{ $post->id }}"
                                            class="mb-0"><small>Published</small></label>
                                    </td>

                                    <td class="text-center">
                                        <small><i class="fas fa-calendar-alt"></i> {{($post->released_at ?? $post->created_at)->format('d-m-Y')}}</small>
                                    </td>
                                    @if ($post->status)
                                        <td>
                                            <small style="font-size: 13px; color: #939FAD;"><i style="font-size: 10px; color:#2ae005" class="fa fa-circle"></i> {{ __('Published') }}</small>
                                        </td>
                                    @else
                                        <td>
                                            <small style="font-size: 13px; color: #939FAD;"><i style="font-size: 10px;" class="fa fa-circle"></i> {{ __('Draft') }}</small>
                                        </td>   
                                    @endif
                                    <td>
                                        <div class="box-options">
                                            
                                            <a href="{{ route('posts.edit', $post) }}" class="btn-options btn-edit"><i class="material-icons">create</i></a>
                                            @include('admin.posts.partials.delete-post-form', [
                                                'postId' => $post->id,
                                                'postName' => $post->name,
                                            ])
                                        </div>
                                    </td>
                                </tr>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        @lang('No results found')
                                    </td>
                                </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-body text-right">
                    @if ($posts->hasPages())
                        {!! $posts->withQueryString()->links() !!}
                    @endif
                </div>

            </div>
        </div>

    </div>
    <script>
        document.querySelectorAll('input[name=status]').forEach(element => {
            element.addEventListener('change', () => {
                
                let idPost = element.getAttribute('data-id-post');
                let postVerified = $(element).is(":checked");
                var url = `/posts/${idPost}/status`
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: url,
                    data: {
                        status: postVerified,
                        post: idPost,
                    }
                });
            })
        });
    </script>
</x-app-layout>


