<x-app-layout>

    <div class="mdk-drawer-layout__content page">

        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Seeker</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">Seeker</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">

            <div class="card card-form d-flex flex-column flex-sm-row">
                <div class="card-form__body card-body-form-group flex">
                    <div class="row">
                        <div class="col-sm-auto col-lg-4">
                            <div class="form-group">
                                <label for="filter_name">Seeker Name</label>
                                    <x-admin.search />
                            </div>
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
                                <th class="text-center">Registered</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="companies">
                            @forelse ($seekers as $seeker)
                                <tr @class(['bg-tr' => $loop->index % 2 == 0])>
                                    <td>
                                        <div class="badge badge-light">#{{ str($seeker->id)->reverse()->limit(6, '...') }}</div>
                                    </td>                                   
                                    <td>
                                        <h6 class="m-0">{{ $seeker->name }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <small><i class="fas fa-calendar-alt"></i> {{ $seeker->created_at->format('d-m-Y') }}</small>
                                    </td>
                                    <td>
                                        <div class="box-options">
                                            @if ($seeker->categories->count() || $seeker->subcategories->count())
                                                <a data-toggle="collapse" href="#subcategories-for-{{ $seeker->id }}" role="button" aria-expanded="false" aria-controls="subcategories-for-{{ $seeker->id }}" class="btn btn-link">
                                                    Categories <i class="material-icons">keyboard_arrow_down</i>
                                                </a>
                                            @endif
                                    
                                            <a href="{{ route('seekers.edit', $seeker) }}" class="btn-options btn-edit"><i class="material-icons">create</i></a>
                                            @can('delete', auth()->user())
                                                @include('admin.seekers.partials.delete-seeker-form', [
                                                    'userId' => $seeker->id,
                                                    'userName' => $seeker->name,
                                                ])
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="p-0">
                                        <div class="collapse list-subcat" id="subcategories-for-{{ $seeker->id }}">
                                            <ul>
                                                @foreach ($seeker->categories as $category)
                                                    <li><span>#{{ str($category->id)->reverse()->limit(6, "...") }}</span> {{ $category->name }}</li>
                                                @endforeach
                                                @foreach ($seeker->subcategories as $subcategory)
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
                    @if ($seekers->hasPages())
                        {!! $seekers->withQueryString()->links() !!}
                    @endif
                </div> 

            </div>
        </div>
    </div>

</x-app-layout>
