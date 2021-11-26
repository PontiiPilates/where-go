<x-guest-layout>

    <x-project.navigation>
    </x-project.navigation>


    <x-auth-card>

        <x-slot name="logo">
            <!-- <a href="/"> -->
            <!-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> -->
            <!-- </a> -->
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <x-label for="password" :value="__('Пароль')" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label">Запомнить меня</label>
                <!-- <span class="ml-2 text-sm text-gray-600">{{ __('Huember me') }}</span> -->
            </div>

            <!-- <div class="mb-3 form-check">
                <input name="free" type="checkbox" class="form-check-input" id="free">
                <label class="form-check-label" for="free">Бесплатно</label>
            </div> -->

            <x-button class="mb-3">
                {{ __('Войти') }}
            </x-button>

            <!-- <div class="">
                @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                    {{ __('Забыли пароль?') }}
                </a>
                @endif
            </div> -->

        </form>

        <div class="">
            <a class="" href="{{ route('register') }}">
                {{ __('Нет профиля? Зарегистрируйтесь.') }}
            </a>

        </div>

    </x-auth-card>

</x-guest-layout>