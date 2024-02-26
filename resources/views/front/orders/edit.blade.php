@section('title', 'Edit your profile |')

<x-default-layout>
    @include('front.layouts.headersearch')
    <main>
        @auth
            
        
        <section class="container">
            <div class="breadcrumb px-2">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>></li>
                    <li><a href="{{ route('orders.indexSeeker') }}">{{ auth()->user()->name}}</a>
                    <li>></li>
                    <li><a class="active" href="#">Edit Seeker</a></li>
                    </li>
                </ul>
            </div>

            <form method="POST" action="{{ route('seeker.update', $seeker) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
            <div style="padding-bottom: 100px" class="row justify-content-center mt-4">

                <div class="col-lg-4 col-md-12 profile-pic">
                    <input class="m-0 bg-white" data-value-image="{{ asset('storage/' . auth()->user()->photo) }}" type="file" name="photo" accept="image/*" />
                </div>

                <div class="col-lg-8 col-md-12" style="padding-left: 10px;">
                    <div style="padding: 30px; border-radius: 10px; box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.039);" class="bg-white">
                        <div style="border-bottom: 1px solid #F7F8F9;" class="mb-4">
                            <h1 class="m-0 fw-normal pb-2">Edit Profile</h1>
                        </div>
    
                        {{-- name --}}
                        <div class="mb-4 form-group">
                            <label class="m-0" for="fullname">{{ __('Full Name *') }}</label>
                            <p class="label-info"><small>{{ __('Your real name') }}</small></p>
                            <input type="text" name="name" id="fullname"
                                value="{{ auth()->user()->name}}" class="form-control required"
                                minlength="3"/>
                        </div>
        
                        {{-- phone --}}
                        <div class="mb-4 form-group">
                            <label class="m-0" for="phone">{{ __('Phone') }}</label>
                            <p class="label-info">
                                <small>{{ __('Your phone will not be shown on your profile.') }}</small>
                            </p>
                            <input type="text" name="phone" id="phone"
                                value="{{ auth()->user()->phone}}" class="form-control" oninput="this.value = '+' + this.value.replace('+', '')"/>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="title-forms-defaults">
                                    <h3>Address</h3>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input-label for="street" :value="__('Street')" />
                                    <x-text-input id="street" name="street" type="text"
                                        class="form-control" :value="old('street', auth()->user()->street)"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('street')" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input-label for="number" :value="__('Number')" />
                                    <x-text-input id="number" name="number" type="text"
                                        class="form-control" :value="old('number', auth()->user()->number)"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('number')" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input-label for="city" :value="__('City')" />
                                    <x-text-input id="city" name="city" type="text"
                                        class="form-control" :value="old('city', auth()->user()->city)"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('city')" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input-label for="complement" :value="__('State')" />
                                    <x-text-input id="complement" name="complement" type="text"
                                        class="form-control" :value="old('complement', auth()->user()->complement)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('complement')" />
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input-label for="zipcode" :value="__('Zipcode')" />
                                    <x-text-input id="zipcode" name="zipcode" type="text"
                                        class="form-control" :value="old('zipcode', auth()->user()->zipcode)"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('zipcode')" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="custom_select">
                                    <x-input-label for="country_id" :value="__('Country')" />
                                    <select name="country_id" id="country_id" class="wide" data-toggle="select">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @selected(auth()->user()?->country_id === $country->id)>
                                                {{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('country_id')" />
                                </div>
                            </div>
                        </div>
    
                        {{-- botão --}}
                        <div class="d-flex gap-3 justify-content-center">
                            <x-success-button class="rounded btn_1 px-5">{{ __('Save') }}</x-success-button>
                            <a style="padding: 14px 40px; color:#636363; border: 1px solid #63636323;" href="{{ route('orders.indexSeeker') }}"
                                class="rounded inline-flex items-center py-2 font-semibold">
                                {{ __('Cancel') }}
                            </a>
                        </div>
    
                    </div>
                </div>

            </div>
            </form>
        </section>
        @endauth
    </main>

</x-default-layout>

<style>
    @media (max-width: 990px) {
        .profile-pic {
            margin-bottom: 10px;
        }
    }
</style>
