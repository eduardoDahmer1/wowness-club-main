<x-danger-button data-toggle="modal" data-target="#confirm-category-deletion-{{ $categoryId }}">
    <i class="material-icons">delete</i>
</x-danger-button>

<div id="confirm-category-deletion-{{ $categoryId }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-center-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('categories.destroy', $categoryId) }}" class="p-6">
                @csrf
                @method('delete')
        
                <h3 class="font-medium text-center m-3" style="color: #7b9a6c;">
                    {{ $categoryName }}
                </h3>
                <h4 class="font-medium text-center m-3">
                    {{ __('Are you sure you want to delete this category?') }}
                </h4>
        
                <div class="m-3 d-flex justify-content-center">
                    <x-secondary-button data-dismiss="modal">
                        {{ __('Cancel') }}
                    </x-secondary-button>
        
                    <x-danger-button class="ml-3">
                        {{ __('Delete Category') }}
                    </x-danger-button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- <x-danger-button x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-category-deletion-{{ $category }}')">
    <i class="material-icons">delete</i>
</x-danger-button>

<x-modal name="confirm-category-deletion-{{ $category }}" focusable>
    <form method="post" action="{{ route('categories.destroy', $category) }}" class="p-6">
        @csrf
        @method('delete')

        <h5 class="text-lg font-medium text-gray-900 text-center">
            {{ __('Are you sure you want to delete this category?') }}
        </h5>

        <div class="mt-6 flex justify-center">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3">
                {{ __('Delete Category') }}
            </x-danger-button>
        </div>
    </form>
</x-modal> --}}



