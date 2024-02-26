<x-danger-button x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-subcategory-deletion-{{ $subcategory }}')">
    {{ __('Delete Subsubcategory') }}</x-danger-button>

<x-modal name="confirm-subcategory-deletion-{{ $subcategory }}" focusable>
    <form method="post" action="{{ route('subcategories.destroy', $subcategory) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete this Subcategory?') }}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3">
                {{ __('Delete Subcategory') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
