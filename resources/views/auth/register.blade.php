<x-guest-layout>

    <x-project.navigation>
    </x-project.navigation>

    <!-- <x-auth-card> -->
        <!-- <x-slot name="logo"> -->
            <!-- <a href="/"> -->
                <!-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> -->
            <!-- </a> -->
        <!-- </x-slot> -->

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <x-label for="name" :value="__('Имя')" />
                <x-input id="name" class="" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <x-label for="password" :value="__('Пароль')" />
                <x-input id="password" class="" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <x-label for="password_confirmation" :value="__('Подтверждение пароля')" />
                <x-input id="password_confirmation" class="" type="password" name="password_confirmation" required />
            </div>

            <x-button class="mb-3">
                {{ __('Регистрация') }}
            </x-button>

        </form>

        <div class="">
            <a class="" href="{{ route('login') }}">
                {{ __('Уже зарегистрированы? Войдите.') }}
            </a>

        </div>

    </x-auth-card>
    
</x-guest-layout>