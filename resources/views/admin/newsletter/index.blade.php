<x-app-layout>

    <div class="mdk-drawer-layout__content page">

        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Newsletter</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">Newsletter</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">

            <div class="card">

                <div class="table-responsive" data-toggle="lists">

                    <table class="table mb-0 thead-border-top-0 table-striped">
                        <thead>
                            <tr>
                                <th style="width: 30px;" class="text-center">#ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Best Describes</th>
                                <th class="text-center">Registered</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="companies">
                            @forelse ($newsletters as $newsletter)
                                <tr @class(['bg-tr' => $loop->index % 2 == 0])>
                                    <td>
                                        <div class="badge badge-light">#{{ str($newsletter->id)->reverse()->limit(6, '...') }}</div>
                                    </td>
                                    <td>
                                        <h6 class="m-0">{{ $newsletter->name }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="m-0">{{ $newsletter->email }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="m-0">{{ $newsletter->city }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="m-0" style="text-transform: capitalize;">{{ $newsletter->best_describes }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <small><i class="fas fa-calendar-alt"></i> {{ $newsletter->created_at->format('d-m-Y') }}</small>
                                    </td>
                                    <td>
                                        <div class="box-options">
                                            @can('delete', auth()->user())
                                                @include('admin.newsletter.partials.delete-newsletter-form', [
                                                    'userId' => $newsletter->id,
                                                    'userName' => $newsletter->email,
                                                ])
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
                    @if ($newsletters->hasPages())
                        {!! $newsletters->withQueryString()->links() !!}
                    @endif
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
