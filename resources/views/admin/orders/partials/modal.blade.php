<!-- Large modal -->
<button type="button" class="btn-options" data-toggle="modal" data-target=".bd-example-modal-lg-{{ $orderId }}"><img
        style="max-width: 20px;" src="https://i.ibb.co/5FSRq0Q/olho.png" alt=""></button>

<div class="modal fade bd-example-modal-lg-{{$orderId}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-5 pt-5">

            <!-- order number -->
            <div style="color: black;" class="border-bottom border-light-subtle pb-1 d-flex">
                <h1 style="font-size: 20px; font-weight: bold;" class="modal-title" id="staticBackdropLabel">Order
                    <span>#{{ $order->id }}</span>
                </h1>
            </div>

            <div style="color: black;" class="pt-3 grid-cols">

                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">STATUS:</span>
                    <div class="col-9">
                        @if ($order->status)
                        <small style="font-size: 13px;"><i style="color: rgb(0, 210, 0); font-size: 10px;" class="fa fa-circle"></i></i> {{ __('Paid') }}</small>
                        @else
                        <small>{{ __('Pending') }}</small>
                        @endif
                    </div>
                </div>

                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">SERVICE:</span>
                    <span class="col-9">{{ $order->package->service->name }}</span>
                </div>

                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">PACKAGE:</span>
                    <span class="col-9">{{ $order->package->name }}</span>
                </div>

                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">DATE:</span>
                    <span class="col-9">{{ $order->created_at->format('d-m-Y') }}</span>
                </div>

                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">PRACTITIONER:</span>
                    <span class="col-9">{{ $order->package->service->user()->withTrashed()->first()->name }}</span>
                </div>
                @isMaintainer(auth()->user())
                    <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">PRACTITIONER E-MAIL:</span>
                        <span class="col-9">{{ $order->package->service->user()->withTrashed()->first()->email }}</span>
                    </div>
                @endisMaintainer
                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">AMOUNT:</span>
                    <span class="col-9">{{ $order->package->price * $order->quantity }}</span>
                </div>

                {{--
                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">COMMISSION:</span>
                    <span class="col-9">Undefined</span>
                </div> --}}

                <div class="d-flex align-items-center py-2 border-bottom border-light-subtle">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">CATEGORIES:</span>
                    <div class="col-9">
                        @if ($order->package->service->subcategories->count() > 0 )
                            @foreach ($order->package->service->categories as $category)
                            {{ str($category->name . ', ') }}
                            @endforeach
                        @else
                            @foreach ($order->package->service->categories as $category)
                            {{ $category->name }}{{ $loop->last ? '' : ',' }}
                            @endforeach
                        @endif
                        @foreach ($order->package->service->subcategories as $subcategory)
                        {{ $subcategory->name }}{{ $loop->last ? '' : ',' }}
                        @endforeach
                        </div>
                </div>

                <div class="d-flex align-items-center py-2">
                    <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">BUYER:</span>
                    <span class="col-9">{{ $order->user()->withTrashed()->first()->name }}</span>
                </div>

                @isPractitioner(auth()->user())
                    <div class="d-flex align-items-center py-2">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">BUYER E-MAIL:</span>
                        <span class="col-9">{{ $order->user()->withTrashed()->first()->email }}</span>
                    </div>
                @endisPractitioner

            </div>

            <div style="padding-top: 100px;" class="pb-4 modal-footer border-secondary-subtle justify-content-center">
                <button type="button"
                    style="font-weight: 200; border: none; border-radius: 4px; background-color: #f5f5f5; padding: 8px 30px;"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
