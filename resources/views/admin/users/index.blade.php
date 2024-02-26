<x-app-layout>

    <div class="mdk-drawer-layout__content page">

        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Practitioner</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">Practitioner</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">

            <div class="card card-form d-flex flex-column flex-sm-row">
                <div class="card-form__body card-body-form-group flex">
                    <div class="row">
                        <div class="col-sm-auto col-lg-4">
                            <div class="form-group">
                                <label for="filter_name">Practitioner Name</label>
                                <x-admin.search />
                            </div>
                        </div>

                        <div class="col-sm-auto d-flex align-items-end">
                            @can('seekerViewAny', App\Models\User::class)
                            <div class="form-group">
                                <a href="{{ route('users.create') }}"
                                    class="btn btn-primary p-2 text-uppercase fw-bold"><i class="material-icons">add</i>
                                    New Practitioner</a>
                            </div>
                           @endcan
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">

                <div class="table-responsive" data-toggle="lists">

                    <table class="table mb-0 thead-border-top-0 table-striped">
                        <thead>
                            <tr>
                                <th style="width: 30px;" class="text-center">#ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Application</th>
                                <th>Plan</th>
                                <th class="text-center">Registered</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="companies">
                            @forelse ($users as $user)
                                <tr @class(['bg-tr' => $loop->index % 2 == 0])>
                                    <td>
                                        <div class="badge badge-light">#{{ str($user->id)->reverse()->limit(6, '...') }} </div>
                                    </td>
                                    <td>
                                        <h6 class="m-0">{{ $user->name }} <a href="{{ route('facilitators.show', $user->slug) }}" target="_blank"><i class="fas fa-external-link-alt"></i></a></h6>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input name="status" type="checkbox" id="verified-for-{{ $user->slug }}"
                                                data-id-user="{{ $user->slug }}" class="custom-control-input"
                                                @checked($user->status)>
                                            <label class="custom-control-label"
                                                for="verified-for-{{ $user->slug }}">..</label>
                                        </div>
                                        <label for="verified-for-{{ $user->slug }}"
                                            class="mb-0"><small>Verified</small></label>
                                    </td>
                                    <td class="text-center">
                                        @if ($user->selected_plan)
                                        <h6 class="m-0">{{$user->selected_plan === 'free' ? 'F' : 'S'}}</h6>
                                        @else
                                        <h6 class="m-0"></h6>
                                        @endif
                                    </td>
                                    <td>
                                        <h6 class="m-0">{{ $user->subscription->plan->name ?? 'Free | No plan' }} </h6>
                                    </td>
                                    <td class="text-center">
                                        <small><i class="fas fa-calendar-alt"></i> {{ $user->created_at->format('d-m-Y') }}</small>
                                    </td>
                                    <td>
                                        <div class="box-options">
                                            @if ($user->categories->count() || $user->subcategories->count())
                                                <a data-toggle="collapse" href="#subcategories-for-{{ $user->id }}" role="button" aria-expanded="false" aria-controls="subcategories-for-{{ $user->id }}" class="btn btn-link">
                                                    Categories <i class="material-icons">keyboard_arrow_down</i>
                                                </a>
                                            @endif

                                            <a href="{{ route('users.edit', $user) }}" class="btn-options btn-edit"><i class="material-icons">create</i></a>
                                            @can('delete', auth()->user())
                                                @include('admin.users.partials.delete-user-form', [
                                                    'userId' => $user->id,
                                                    'userName' => $user->name,
                                                ])
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="p-0">
                                        <div class="collapse list-subcat" id="subcategories-for-{{ $user->id }}">
                                            <ul>
                                                @foreach ($user->categories as $category)
                                                    <li><span>#{{ str($category->id)->reverse()->limit(6, "...") }}</span> {{ $category->name }}</li>
                                                @endforeach
                                                @foreach ($user->subcategories as $subcategory)
                                                    <li><span>#{{ str($subcategory->id)->reverse()->limit(6, "...") }}</span> {{ $subcategory->name }}</li>
                                                @endforeach
                                            </ul>
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
                    @if ($users->hasPages())
                        {!! $users->withQueryString()->links() !!}
                    @endif
                </div>

            </div>
        </div>



    </div>

    <script>
        document.querySelectorAll('input[name=status]').forEach(element => {
            element.addEventListener('change', () => {

                // Função que altera o valor do status do usuário ao clicar no botão "toggle" de verificado
                let idUser = element.getAttribute('data-id-user');
                let userVerified = $(element).is(":checked");
                var url = `/users/${idUser}/status`
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: url,
                    data: {
                        status: userVerified,
                        user: idUser,
                    }
                });
            })
        });
    </script>
</x-app-layout>
