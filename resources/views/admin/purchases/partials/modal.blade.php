<!-- Large modal -->
<button type="button" class="btn-options" data-toggle="modal" data-target=".bd-example-modal-lg-{{ $purchaseId }}"><img
        style="max-width: 20px;" src="https://i.ibb.co/5FSRq0Q/olho.png" alt=""></button>

<div class="modal fade bd-example-modal-lg-{{$purchaseId}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-5 pt-5">

            <!-- order number -->
            <div style="color: black;" class="border-bottom border-light-subtle pb-1 d-flex">
                <h1 style="font-size: 20px; font-weight: bold;" class="modal-title" id="staticBackdropLabel">Order
                    <span>#{{ $purchase->id }}</span>
                </h1>
            </div>

            <div style="color: black;" class="pt-3 grid-cols">

                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">STATUS:</span>
                    <div class="col-9">
                        @if ($purchase->status)
                        <small style="font-size: 13px;"><i style="color: rgb(0, 210, 0); font-size: 10px;" class="fa fa-circle"></i></i> {{ __('Paid') }}</small>
                        @else
                        <small>{{ __('Pending') }}</small>
                        @endif
                    </div>
                </div>

                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">CONTENT:</span>
                    <span class="col-9">{{ $purchase->content->title }}</span>
                </div>

                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">DATE:</span>
                    <span class="col-9">{{ $purchase->created_at->format('d-m-Y') }}</span>
                </div>

                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">PRACTITIONER:</span>
                    <span class="col-9">{{ $purchase->content->user()->withTrashed()->first()->name }}</span>
                </div>
                @isMaintainer(auth()->user())
                    <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">PRACTITIONER E-MAIL:</span>
                        <span class="col-9">{{ $purchase->content->user()->withTrashed()->first()->email }}</span>
                    </div>
                @endisMaintainer
                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">AMOUNT:</span>
                    <span class="col-9">{{ $purchase->amount_paid }}</span>
                </div>

                {{--
                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">COMMISSION:</span>
                    <span class="col-9">Undefined</span>
                </div> --}}

                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">CATEGORIES:</span>
                    <div class="col-9">
                        @if ($purchase->content->subcategories->count() > 0 )
                            @foreach ($purchase->content->categories as $category)
                            {{ str($category->name . ', ') }}
                            @endforeach
                        @else
                            @foreach ($purchase->content->categories as $category)
                            {{ $category->name }}{{ $loop->last ? '' : ',' }}
                            @endforeach
                        @endif
                        @foreach ($purchase->content->subcategories as $subcategory)
                        {{ $subcategory->name }}{{ $loop->last ? '' : ',' }}
                        @endforeach
                        </div>
                </div>

                <div class="d-flex align-items-center py-2">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">BUYER:</span>
                    <span class="col-9">{{ $purchase->user()->withTrashed()->first()->name }}</span>
                </div>

                @isPractitioner(auth()->user())
                    <div class="d-flex align-items-center py-2">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">BUYER E-MAIL:</span>
                        <span class="col-9">{{ $purchase->user()->withTrashed()->first()->email }}</span>
                    </div>
                @endisPractitioner

                @if(Auth::user()->isPaying())
                    @if ($purchase->user()->withTrashed()->first()->id !== Auth::user()->id)
                    <div class="col-md-6 py-2">
                        <a href="{{ route('chat.startChat', $purchase->user()->withTrashed()->first()) }}">Start Chat With Buyer</a>
                    </div>
                    @endif
                @endif

            </div>
            <div style="padding-top: 100px;" class="pb-4 modal-footer border-secondary-subtle justify-content-center">
                <button type="button"
                    style="font-weight: 200; border: none; border-radius: 4px; background-color: #f5f5f5; padding: 8px 30px;"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
