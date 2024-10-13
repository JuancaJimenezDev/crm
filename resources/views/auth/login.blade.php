<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('auth.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('auth.password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('auth.remember_me') }}</span>
            </label>
        </div>

        <div class="d-flex justify-content-end mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: rgb(41 37 36); color: white; border: none; border-radius: 4px; font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; text-decoration: none; transition: background-color 0.15s ease-in-out; margin-left: 5px; margin-right:5px;"
                   onmouseover="this.style.backgroundColor='rgb(41 37 36)'"
                   onmouseout="this.style.backgroundColor='rgb(41 37 36)'"
                   onfocus="this.style.backgroundColor='rgb(41 37 36)'"
                   onmousedown="this.style.backgroundColor='rgb(41 37 36)'">
                    {{ __('auth.forgot_password') }}
                </a>
            @endif
                <x-primary-button>
                    {{ __('auth.login') }}
                </x-primary-button>
        </div>
    </form>
</x-guest-layout>
