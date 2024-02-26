<!-- Modal -->
<div class="modal fade" id="confirm-review-deletion-{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="{{ route('seeker.reviews.destroy', $review->id) }}" class="p-6">
                @csrf
                @method('delete')
                <h3 class="font-medium text-center m-3" style="color: #7b9a6c;">
                    {{$review->order ? $review->order->package->service->name : '' }}
                </h3>
                <h4 class="font-medium text-center m-3">
                    {{ __('Are you sure you want to delete this review?') }}
                </h4>
        
                <div class="m-4 d-flex justify-content-evenly">
                    <button id="cancel-btn" class="btn_modal m-0 px-5 py-2 bg-none fw-semibold" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button class="btn_modal m-0 px-5 py-2 bg-none fw-semibold" type="submit">{{ __('Delete review') }}</button>
                </div>
            </form>
        </div>
    </div>
  </div>