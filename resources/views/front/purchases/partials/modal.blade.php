<!-- Button trigger modal -->
<button type="button" class="btn-options" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$purchaseId}}">
    <img style="max-width: 20px;" src="https://i.ibb.co/5FSRq0Q/olho.png" alt="">
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal-{{$purchaseId}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">

                <!-- order number -->
                <div style="color: black;" class="border-bottom pb-1 border-light">
                    <h1 style="font-size: 20px; font-weight: bold;" class="modal-title" id="staticBackdropLabel">
                        Order
                        <span>#{{ $purchase->id }}</span>
                    </h1>
                </div>

                <div style="color: black;" class="pt-3">
                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">STATUS:</span>
                        @if ($purchase->status)
                        <small style="font-size: 13px;"><i style="color: rgb(0, 210, 0); font-size: 8px;" class="bi bi-circle-fill"></i> {{ __('Paid') }}</small>
                        @else
                        <small style="font-size: 13px;">{{ __('Pending') }}</small>
                        @endif
                    </div>

                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">CONTENT:</span>
                        <span class="col-9">{{ $purchase->content->title }}</span>
                    </div>

                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">DATE:</span>
                        <span class="col-9">{{ $purchase->created_at->format('d-m-Y') }}</span>
                    </div>

                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">PRACTITIONER:</span>
                        <span class="col-9">{{ $purchase->content->user()->withTrashed()->first()->name }}</span>
                    </div>

                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">AMOUNT:</span>
                        <span class="col-9">{{ $purchase->amount_paid }}</span>
                    </div>

                    <div class="py-2 border-bottom d-flex border-light">
                        <span class="col-3 fw-semibold" style="color: #7e7e7e; font-size: 13px;">CATEGORIES:</span>
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
