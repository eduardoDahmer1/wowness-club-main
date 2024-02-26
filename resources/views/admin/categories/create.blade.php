@section('title', 'New Category')
<x-app-layout>
    <div class="mdk-drawer-layout__content page">

        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">New Category</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">

            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col-12 card-form__body card-body">
                        <form method="POST" action="{{ route('categories.store') }}" class="dropzone"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <x-input-label for="name" :value="__('Category Name *')" />
                                        <x-text-input id="name" name="name" type="text" class="form-control"
                                            :value="old('name')" required />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>
                                    <div class="form-group">
                                        <x-input-label for="description" :value="__('Description')" />
                                        <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                    </div>
                                </div>
                                <div class="col-lg-4">

                                    <x-input-label :value="__('Icon') . ' *'" />
                                    <x-input-info-label>Size: 200x200 | Only PNG</x-input-info-label>

                                    <input required type="file" name="icon" accept="image/png, image/jpeg, image/jpg">
                                    <x-input-error class="mt-2" :messages="$errors->get('icon')" />

                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary my-2 p-2 text-uppercase fw-bold"
                                            data-handler="newinputSubcat" >
                                            + new subcategory</button>
                                    <div id="inputsSubCat" class="row"></div>
                                </div>
                                

                                <div class="col-auto mt-3">
                                    <x-success-button>{{ __('Create') }}</x-success-button>
                                    <a style="color:#333;" href="{{ route('categories.index') }}"
                                        class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
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
