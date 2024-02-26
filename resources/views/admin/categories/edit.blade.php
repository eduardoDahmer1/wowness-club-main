@section('title', 'Edit ' . $category->name)
<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item">Categories</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">Edit Category</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">

            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col-12 card-form__body card-body">
                        <form method="POST" action="{{ route('categories.update', $category) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <x-input-label for="name" :value="__('Category Name *')" />
                                        <x-text-input id="name" name="name" type="text" class="form-control"
                                            :value="old('name', $category->name)" />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>
                                    <div class="form-group">
                                        <x-input-label for="description" :value="__('Description')" />
                                        <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $category->description) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                    </div>
                                </div>
                                <div class="col-lg-4">

                                    <x-input-label :value="__('Icon *')" />
                                    <x-input-info-label>Size: 200x200 | Only PNG</x-input-info-label>
                                    {{-- <input type="file" name="icon" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"> --}}
                                    <input type="file" name="icon" data-value-image='{{ $category->icon ? asset("storage/" . $category->icon) : ''}}'/>

                                    <x-input-error class="mt-2" :messages="$errors->get('icon')" />

                                </div>
                                
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary my-2 p-2 text-uppercase fw-bold"
                                            data-handler="newinputSubcat">
                                            + new subcategory</button>

                                    <div id="inputsSubCat" class="row">
                                        @foreach ($category->subcategories as $subcategory)
                                            <div id="subcategory_{{ $loop->index }}" class="box-inputs-dinamic col-md-6">
                                                <x-input-error class="mt-2" :messages="$errors->get('subcategories.' . $subcategory->id . '.destroy')" />
                                                <div class="row">
                                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons icon-delete-subcat"
                                                    onclick="document.getElementById('subcategory_{{ $loop->index }}').remove()">delete</i>

                                                    <input type="hidden" value="{{ $subcategory->id }}"
                                                        name="subcategories[{{ $loop->index }}][id]">
                                                    <div class="col-lg-7">
                                                        <div>
                                                            <x-input-label for="subcategories_name{{ $loop->index }}" :value=" $loop->index + 1 . '. Subcategory Name'" />
                                                            <x-text-input id="subcategories_name{{ $loop->index }}"
                                                                name="subcategories[{{ $loop->index }}][name]" type="text" required
                                                                class="mt-1 block w-full" :value="old(
                                                                    'subcategories[{{ $loop->index }}][name]',
                                                                    $subcategory->name,
                                                                )" />
                                                            <x-input-error class="mt-2" :messages="$errors->get('subcategories.' . $loop->index . '.name')" />
                                                        </div>
                                                        <div>
                                                            <x-input-label for="subcategories_description{{ $loop->index }}" :value="__('Description')" />
                                                            <textarea name="subcategories[{{ $loop->index }}][description]" id="subcategories_description{{ $loop->index }}" rows="4"
                                                                class="form-control">{{ old("subcategories[$loop->index][description]", $subcategory->description) }}</textarea>
                                                            <x-input-error class="mt-2" :messages="$errors->get('subcategories.' . $loop->index . '.description')" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <x-input-label for="subcategories_icon{{ $loop->index }}" :value="__('Icon')" />
                                                        <input type="file" name="subcategories[{{$loop->index}}][icon]" required data-value-image='{{ $subcategory->icon ? asset("storage/" . $subcategory->icon) : ''}}'/>
                                                        <x-input-error class="mt-2" :messages="$errors->get('subcategories.' . $loop->index . '.icon')" />
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                                <div class="col-auto mt-3">
                                    <x-success-button>{{ __('Save') }}</x-success-button>
                                    <a style="color:#333;" href="{{ route('categories.index') }}"
                                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

@include('admin.scripts')

