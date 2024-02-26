@section('title', 'Content Purchase')

<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Content Purchase</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">@lang('Content Purchase')</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">


                <div class="card card-form d-flex flex-column flex-sm-row">
                    <div class="card-form__body card-body-form-group flex">
                        <div class="row">
                            <div class="col-sm-auto col-lg-4">
                                <div class="form-group">
                                    <label for="filter_name">Purchase Name</label>
                                    <x-admin.search />
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

                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Content Title') }}</th>
                                <th>{{ __('Practitioner Name') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody class="list" id="companies">
                            @forelse ($purchases as $purchase)
                                <tr @class(['bg-tr' => $loop->index % 2 == 0])>
                                    <td>
                                        <div class="badge badge-light">#{{ Str::limit($purchase->id, 6, '...') }}</div>
                                    </td>

                                    <td>
                                        @if ($purchase->status)
                                        <small style="font-size: 13px;"><i style="color: rgb(0, 210, 0); font-size: 10px;" class="fa fa-circle"></i></i> {{ __('Paid') }}</small>
                                        @else
                                        <small>{{ __('Pending') }}</small>
                                        @endif
                                    </td>

                                    <td>
                                        <small><i class="fas fa-calendar-alt"></i>
                                            {{ $purchase->created_at->format('d-m-Y') }}</small>
                                    </td>

                                    <td>
                                        <small>{{ str($purchase->content->title)->limit(16, '...') }}</small>
                                    </td>

                                    <td>
                                        <small>{{ $purchase->content->user()->withTrashed()->first()->name }}</small>
                                    </td>

                                    <td>
                                        <small>{{ $purchase->amount_paid }}</small>
                                    </td>

                                    <td class="d-flex justify-content-end">
                                        <small>@include('admin.purchases.partials.modal', [
                                            'purchaseId' => $purchase->id,
                                            'purchaseName' => $purchase->name,
                                        ])</small>
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

            </div>
        </div>

    </div>
</x-app-layout>
