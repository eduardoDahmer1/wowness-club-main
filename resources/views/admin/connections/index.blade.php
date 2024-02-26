@section('title', 'Connections')

<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Connections</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">@lang('Connections')</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid page__container">

            <div class="card">

                <div class="table-responsive" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                    <table class="table mb-0 thead-border-top-0 table-striped">
                        <thead>
                            <tr>

                                <th>{{ __('Integration') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody class="list" id="companies">
                            <tr>
                                <td>
                                    <img style="max-width: 55px;" src="{{asset('assets/images/logostripe.png')}}" alt="">
                                </td>
                                @if (!auth()->user()->status_stripe_integration)
                                    <td>
                                        <small style="font-size: 13px; color: #939FAD;"><i style="font-size: 10px;" class="fa fa-circle"></i> {{ __('Undefined') }}</small>
                                    </td>
                                @else
                                    <td>
                                        <small style="font-size: 13px; color: #939FAD;"><i style="font-size: 10px; color:#2ae005" class="fa fa-circle"></i> {{ __('Connected') }}</small>
                                    </td>   
                                @endif
                                <td class="d-flex justify-content-end">
                                    <a class="btn btn-primary d-flex align-items-center" href="{{route('onboarding.status')}}">CONNECT</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>




            </div>
        </div>

    </div>
</x-app-layout>
