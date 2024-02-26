@section('title', 'Reviews')
@include('admin.scripts')
<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">@lang('Reviews')</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid page__container">
            <div class="card card-form d-flex flex-column flex-sm-row">
                <div class="card-form__body card-body-form-group flex">
                    <div class="row">
                        <div class="col-sm-auto col-lg-4">
                            <div class="form-group">
                                <label for="filter_name">Reviews Title</label>
                                <x-admin.search :placeholder="'Search by title'"/>
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
                                <th>Practitioner</th>
                                <th>Service Title</th>
                                <th>Seeker's Name</th>
                                <th>Submited</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="companies">
                            @forelse ($reviews as $review)
                        
                                <tr @class(['bg-tr' => $loop->index % 2 == 0])>
                                    <td>
                                        <div class="badge badge-light">#{{ Str::limit(12356789, 6, "...") }}</div>
                                    </td>

                                    <td>
                                        <small>{{ $review->order ? $review->order->package->service->user->name : ''}}</small>
                                    </td>

                                    <td>
                                        <small>{{$review->order ? $review->order->package->service->name : ''}}</small>
                                    </td>

                                    <td>
                                        <small>{{$review->user->name}}</small>
                                    </td>
                                                                  
                                    <td>
                                        <small><i class="fas fa-calendar-alt"></i> {{ $review->created_at }}</small>
                                    </td>

                                    <td>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input name="status" type="checkbox" id="verified-for-{{ $review->id }}" data-id-review="{{$review->id}}" class="custom-control-input" @checked(isset($review->status) && $review->status == 1)>
                                            <label class="custom-control-label" for="verified-for-{{ $review->id }}">..</label>
                                        </div>
                                        <label for="verified-for-{{ $review->id }}" class="mb-0"><small>Published</small></label>
                                    </td>

                                    <td class="text-right">
                                        <div>
                                            <!-- Large modal -->
                                
                                        @include('admin.reviews.modal', ['review' => $review])
                                        @include('admin.reviews.partials.delete-review-form', ['review' => $review ])
                                        <x-danger-button><i class="material-icons">delete</i></x-danger-button>                             
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
                    {{-- @if ($reviews->hasPages())
                        {!! $reviews->withQueryString()->links() !!}
                    @endif --}}
                </div>
            </div>
        </div>

    </div>
    <script>
        document.querySelectorAll('input[name=status]').forEach(element => {
            element.addEventListener('change', () => {

                let idReview = element.getAttribute('data-id-review');
                let reviewVerified = $(element).is(":checked");
                var url = `/reviews/${idReview}/status`
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: url,
                    data: {
                        status: reviewVerified,
                        review: idReview,
                    },
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