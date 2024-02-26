@section('title', 'Edit ' . $user->name)

<x-app-layout>
    <div class="mdk-drawer-layout__content page">

        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Seeker</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">Seeker</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">

            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col-12 card-form__body card-body">
                        <form method="POST" action="{{ route('seekers.update', $user) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <x-input-label for="photo" :value="__('profile pic *')" />
                                        <x-input-info-label>Size: 1080x1080 | JPG, PNG, JPEG</x-input-info-label>
                                        <input type="file" name="photo" accept="image/png, image/jpeg, image/jpg" data-value-image="{{ $user->photo_url }}">
                                        <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="name" :value="__('Full Name *')" />
                                                <x-text-input id="name" name="name" type="text"
                                                    class="form-control" :value="old('name', $user->name)" />
                                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="phone" :value="__('Phone Number *')" />
                                                <x-text-input id="phone" name="phone" type="text"
                                                    class="form-control" :value="old('phone', $user->phone)" oninput="this.value = '+' + this.value.replace('+', '')"/>
                                                <x-input-error class="mt-2" :messages="$errors->get('phone')"/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="email" :value="__('Email *')" />
                                                <x-text-input id="email" name="email" type="email"
                                                    class="form-control" :value="old('email', $user->email)" />
                                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="password" :value="__('Password')" />
                                                <x-text-input id="password" name="password" type="password"
                                                    class="form-control" :value="old('password')" />
                                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                            </div>
                                        </div>

                                        @isAdmin(auth()->user())
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <x-input-label for="role" :value="__('Role *')" />
                                                    <select name="role" id="role" data-toggle="select" required>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->value }}" @selected($user->role->value === $role->value)>
                                                                {{ $role->name() }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                                                </div>
                                            </div>
                                        @endisAdmin

                                <div class="col-12">
                                    <div class="title-forms-defaults">
                                        <h3>Address</h3>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="street" :value="__('Street')" />
                                        <x-text-input id="street" name="street" type="text"
                                            class="form-control" :value="old('street', $user->street)"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('street')" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="number" :value="__('Number')" />
                                        <x-text-input id="number" name="number" type="text"
                                            class="form-control" :value="old('number', $user->number)"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('number')" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="city" :value="__('City')" />
                                        <x-text-input id="city" name="city" type="text"
                                            class="form-control" :value="old('city', $user->city)"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('city')" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="complement" :value="__('State')" />
                                        <x-text-input id="complement" name="complement" type="text"
                                            class="form-control" :value="old('complement', $user->complement)" />
                                        <x-input-error class="mt-2" :messages="$errors->get('complement')" />
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="zipcode" :value="__('Zipcode')" />
                                        <x-text-input id="zipcode" name="zipcode" type="text"
                                            class="form-control" :value="old('zipcode', $user->zipcode)"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('zipcode')" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="country_id" :value="__('Country')" />
                                        <select name="country_id" id="country_id" data-toggle="select">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @selected($user->country_id === $country->id)>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('country_id')" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center col-12">
                                    <x-success-button>{{ __('Save') }}</x-success-button>
                                    <a style="color:#333;" href="{{ route('seekers.index') }}"
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
 </div>
</div>

</x-app-layout>

@include('admin.scripts')