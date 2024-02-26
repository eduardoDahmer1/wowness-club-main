<!-- Modal -->
<div class="modal fade" id="exampleModal-{{$orderId}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">

                <!-- order number -->
                <div style="color: black;" class="border-bottom pb-1 border-light">
                    <h1 style="font-size: 20px; font-weight: bold;" class="modal-title" id="staticBackdropLabel">
                        Order
                        <span>#{{ $order->id }}</span>
                    </h1>
                </div>

                <div style="color: black;" class="pt-3">
                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">STATUS:</span>
                        @if ($order->status)
                        <small style="font-size: 13px;"><i style="color: rgb(0, 210, 0); font-size: 8px;" class="bi bi-circle-fill"></i> {{ __('Paid') }}</small>
                        @else
                        <small style="font-size: 13px;">{{ __('Pending') }}</small>
                        @endif
                    </div>

                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">SERVICE:</span>
                        <span class="col-9">{{ $order->package->service->name }}</span>
                    </div>

                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">PACKAGE:</span>
                        <span class="col-9">{{ $order->package->name }}</span>
                    </div>

                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">DATE:</span>
                        <span class="col-9">{{ $order->created_at->format('d-m-Y') }}</span>
                    </div>

                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">AGENT:</span>
                        <span class="col-9">{{ $order->package->service->user()->withTrashed()->first()->name }}</span>
                    </div>

                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">AMOUNT:</span>
                        <span class="col-9">{{ $order->package->price * $order->quantity}}</span>
                    </div>

                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">CATEGORIES:</span>
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

                <div style="padding-top: 80px;" class=" border-light modal-footer justify-content-center">
                    <button
                        style="font-weight: 200; border: none; border-radius: 4px; background-color: #f5f5f5; padding: 8px 30px;"
                        type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    button.btn-options {
        border: none;
        background-color: #fff;
        border-radius: 5px;
        padding: 7px;
    }
</style>
