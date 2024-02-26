<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if($errors->has('callback'))
        @foreach($errors->get('callback') as $message)
            <div class="mt-3 alert alert-danger" role="alert">
                {{$message}}
            </div>
        @endforeach
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <x-input-label for="email" :value="__('Email Address')" />
            <div class="input-group input-group-merge">
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="jhoe@example.com" />
                <div class="input-group-prepend mt-2">
                    <div class="input-group-text">
                        <span class="far fa-user"></span>
                    </div>
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" />
        </div>
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" />
            <div class="input-group input-group-merge">
                <x-text-input  id="password"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Enter your password" />
                <div class="input-group-prepend mt-2">
                    <div class="input-group-text">
                        <span class="fa fa-key"></span>
                    </div>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" />
        </div>
        <div class="form-group mb-5">
            <div class="custom-control custom-checkbox">
                <input id="remember_me" type="checkbox" name="remember" class="custom-control-input" checked >
                <label class="custom-control-label" for="remember_me">{{ __('Remember me') }}</label>
            </div>
        </div>
        <div class="form-group text-center">
            <x-primary-button class="btn-block mb-3">
                {{ __('Login') }}
            </x-primary-button>
            
            {{-- Don't have an account? <a class="text-body text-underline" href="{{ route('preregister') }}">Sign up!</a> --}}
        </div>
    </form>
        <div class="form-group text-center">
            <a href="{{ url('auth/google') }}" style="margin-top: 0px !important;background: #ffffff;color: #000000;padding: 8px;border-radius:6px; border:solid rgba(128, 128, 128, 0.445) 1px;" class="btn-block">
                <img class="mr-5" src="{{ asset('assets/images/google.png') }}">
                    {{__('Login with google')}}
            </a>
            
            <br><br>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <br>
        </div>
    
</x-guest-layout>



