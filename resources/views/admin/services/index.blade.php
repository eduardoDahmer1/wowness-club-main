@section('title', 'Services')
@include('admin.scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Services</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">@lang('Services')</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">
            <div class="card card-form d-flex flex-column flex-sm-row">
                <div class="card-form__body card-body-form-group flex">
                    <div class="row">
                        <div class="col-sm-auto col-lg-4">
                            <div class="form-group">
                                <label for="filter_name">Services Name</label>
                                <x-admin.search />
                            </div>
                        </div>
                        @can('create', App\Models\Service::class)
                        <div class="col-sm-auto d-flex align-items-end">
                            <div class="form-group">
                                <a href="{{ route('services.create') }}" class="btn btn-primary p-2 text-uppercase fw-bold"><i class="material-icons">add</i> New Services</a>
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
                                <th>Name</th>
                                <th>Practitioner</th>
                                <th>Status</th>
                                <th class="text-center">Registered</th>

                            </tr>
                        </thead>
                        <tbody class="list" id="companies">
                            @forelse ($services as $service)
                                <tr @class(['bg-tr' => $loop->index % 2 == 0])>
                                    <td>
                                        <div class="badge badge-light">#{{ Str::limit($service->id, 6, "...") }}</div>
                                    </td>

                                    <td>
                                        <h6 class="m-0">{{ $service->name }} <a href="{{route('services.show', $service->slug)}}" target="_blank"><i class="fas fa-external-link-alt"></i></a></h6>
                                    </td>

                                    <td>
                                        <small>{{ $service->user()->withTrashed()->first()->name ?? null}}</small>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input name="status" type="checkbox" id="verified-for-{{ $service->id }}"
                                                data-id-service="{{ $service->id }}" class="custom-control-input"
                                                @checked($service->status)>
                                            <label class="custom-control-label"
                                                for="verified-for-{{ $service->id }}">..</label>
                                        </div>
                                        <label for="verified-for-{{ $service->id }}"
                                            class="mb-0"><small>Published</small></label>
                                    </td>

                                    <td class="text-center">
                                        <small><i class="fas fa-calendar-alt"></i> {{ $service->created_at->format('d-m-Y') }}</small>
                                    </td>
                                    @if ($service->status)
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
                                                <a class="btn-options" style="color: #7B9A6C; padding:9px;" href="{{ route('services.calendar', $service->id) }}"><i class="bi bi-calendar3"></i></a>
                                                <a href="{{ route('services.replicate', $service->id) }}" class="btn-options btn-copy"><i class="material-icons">content_copy</i></a>
                                            @endcan
                                                <a href="{{ route('services.edit', $service) }}" class="btn-options btn-edit"><i class="material-icons">create</i></a>
                                            @can('practitionerViewAny', App\Models\User::class)
                                                <div>
                                                    @if (!$service->packages->pluck('orders')->flatten()->count())
                                                        @include('admin.services.partials.delete-service-form', [
                                                            'serviceId' => $service->id,
                                                            'serviceName' => $service->name,
                                                        ])
                                                    @else
                                                        <button type="submit" class="btn-options btn-delete">
                                                            <i class="material-icons icon-del-have-order" onclick="alertDeleteServiceOrder()">delete</i>
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
                    @if ($services->hasPages())
                        {!! $services->withQueryString()->links() !!}
                    @endif
                </div>
            </div>
        </div>

    </div>
    <script>
        document.querySelectorAll('input[name=status]').forEach(element => {
            element.addEventListener('change', () => {

                let idService = element.getAttribute('data-id-service');
                let serviceVerified = $(element).is(":checked");
                var url = `/services/${idService}/status`

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: url,
                    data: {
                        status: serviceVerified,
                        service: idService,
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
