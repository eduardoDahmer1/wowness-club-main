<x-danger-button data-toggle="modal" data-target="#confirm-review-deletion-{{ $review->id }}">
    <i class="material-icons">delete</i>
</x-danger-button>

<div id="confirm-review-deletion-{{ $review->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-center-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('reviews.destroy', $review->id) }}" class="p-6">
                @csrf
                @method('delete')
        
                <h3 class="font-medium text-center m-3" style="color: #7b9a6c;">
                    {{$review->order ? $review->order->package->service->name : '' }}
                </h3>
                <h4 class="font-medium text-center m-3">
                    {{ __('Are you sure you want to delete this review?') }}
                </h4>
        
                <div class="m-3 d-flex justify-content-center">
                    <x-secondary-button data-dismiss="modal">
                        {{ __('Cancel') }}
                    </x-secondary-button>
        
                    <x-danger-button class="ml-3">
                        {{ __('Delete review') }}
                    </x-danger-button>
                </div>
            </form>
        </div>
    </ . div>
</div>