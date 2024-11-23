<x-guest-layout>

    <x-auth-card class="d-flex justify-content-center">
        <img src="{{ asset('./assets/img/logos/logoOriginal.png') }}" alt="" style="margin-bottom: 50px;height:19vh;"
            class="m-auto">
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" id="login_form" action="{{ route('login') }}">

            {{-- @csrf --}}

            <!-- Email Address -->
            <div>
                <x-label for="username" :value="__('Nome de usuário')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value=" isset($_GET['user']) ? $_GET['user'] : '' " required
                    autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" :value=" isset($_GET['pass']) ? $_GET['pass'] : '' " class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                    
            </div>
          
            <!-- Remember Me -->
            <div class="block mt-2 pt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember" checked>
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    
                </label>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-button class="btn btn-primary btn-sm" style="width: 100%;
                        text-align: center;
                        height: 44px;
                        margin-top: 19px;
                        margin-bottom:15px;
                        display: flex;
                        justify-content: center; ">
                        {{ __('Acessar') }} 
                    </x-button>
                </div>

            </div>
        </form>
    </x-auth-card>
</x-guest-layout>


{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> --}}
<script src="{{ asset('./assets/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>

@if (isset($_GET['user']) && isset($_GET['pass']))
    <script>
        $(document).ready(function() {
            $('#login_form').submit();
        });
    </script>
@endif