@section('title', 'Content')
@include('admin.scripts')
<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Content</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">@lang('Content')</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">
            <div class="card card-form d-flex flex-column flex-sm-row">
                <div class="card-form__body card-body-form-group flex">
                    <div class="row">
                        <div class="col-sm-auto col-lg-4">
                            <div class="form-group">
                                <label for="filter_name">Content Title</label>
                                <x-admin.search :placeholder="'Search by title'"/>
                            </div>
                        </div>
                        @can('create', App\Models\Service::class)
                        <div class="col-sm-auto d-flex align-items-end">
                            <div class="form-group">
                                <a href="{{ route('contents.create') }}" class="btn btn-primary p-2 text-uppercase fw-bold"><i class="material-icons">add</i> New Content</a>
                            </div>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
            @if (session('message'))
            <div class="alert alert-danger d-flex align-items-center justify-content-center">
                <p class="m-0">
                {{ session('message') }}
                </p>
            </div>
            @endif
            <div class="card">

                <div class="table-responsive" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                    <table class="table mb-0 thead-border-top-0 table-striped">
                        <thead>
                            <tr>

                                <th style="width: 30px;" class="text-center">#ID</th>
                                <th>Title</th>
                                <th>Practitioner</th>
                                @can('viewAny', App\Models\Calendar::class)
                                <th>Status</th>
                                @endcan
                                <th class="text-center">Registered</th>

                            </tr>
                        </thead>
                        <tbody class="list" id="companies">
                            @forelse ($contents as $content)
                                <tr @class(['bg-tr' => $loop->index % 2 == 0])>
                                    <td>
                                        <div class="badge badge-light">#{{ Str::limit($content->id, 6, "...") }}</div>
                                    </td>

                                    <td>
                                        <h6 class="m-0">{{ $content->title }} <a href="{{route('contents.show', $content->slug)}}" target="_blank"><i class="fas fa-external-link-alt"></i></a></h6>
                                    </td>

                                    <td>
                                        <small>{{ $content->user()->withTrashed()->first()->name ?? null}}</small>
                                    </td>
                                    @can('viewAny', App\Models\Calendar::class)
                                    <td>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input name="status" type="checkbox" id="verified-for-{{ $content->id }}"
                                                data-id-content="{{ $content->id }}" class="custom-control-input"
                                                @checked($content->status)>
                                            <label class="custom-control-label"
                                                for="verified-for-{{ $content->id }}">..</label>
                                        </div>
                                        <label for="verified-for-{{ $content->id }}"
                                            class="mb-0"><small>Published</small></label>
                                    </td>
                                    @endcan

                                    <td class="text-center">
                                        <small><i class="fas fa-calendar-alt"></i> {{ $content->created_at->format('d-m-Y') }}</small>
                                    </td>
                                    @if ($content->status)
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
                                            @can('practitionerViewAny',App\Models\User::class)
                                            <a href="{{ route('contents.replicate', $content->id) }}" class="btn-options btn-copy"><i class="material-icons">content_copy</i></a>
                                            @endcan
                                            <a href="{{ route('contents.edit', $content) }}" class="btn-options btn-edit"><i class="material-icons">create</i></a>

                                           @can('practitionerViewAny', App\Models\User::class)
                                            <div>
                                                @if (!$content->purchases->count())

                                                    @include('admin.contents.partials.delete-content-form', [
                                                        'contentId' => $content->id,
                                                        'contentTitle' => $content->title,
                                                    ])

                                                @else
                                                    <button type="submit" class="btn-options btn-delete" >
                                                        <i class="material-icons icon-del-have-order" onclick="alertDeleteContentPurchase()">delete</i>
                                                    </button>
                                                @endif
                                            </div>
                                           @endcan
                                        </div>
                                    </td>
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
                    @if ($contents->hasPages())
                        {!! $contents->withQueryString()->links() !!}
                    @endif
                </div>
            </div>
        </div>

    </div>
    <script>
        document.querySelectorAll('input[name=status]').forEach(element => {
            element.addEventListener('change', () => {

                let idService = element.getAttribute('data-id-content');
                let contentVerified = $(element).is(":checked");
                var url = `/contents/${idService}/status`

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: url,
                    data: {
                        status: contentVerified,
                        content: idService,
                    }
                });
            })
        });
    </script>
</x-app-layout>

<style>
    .icon-del-have-order {
    color: #8b8b8b;
    background: #fff;
    cursor: pointer;
    }
</style>
