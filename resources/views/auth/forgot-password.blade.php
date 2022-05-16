<x-project.layout>

    <div class="col-md-2 col-lg-4"></div>

    <div class="col-md-8 col-lg-4">

        {{-- <x-auth-card> --}}

        {{-- Description --}}
        <div class="mb-3">
            Забыли пароль? Не проблема. Просто сообщите нам свой адрес электронной почты, и мы пришлём вам ссылку для сброса пароля, которая позволит вам выбрать новый.
        </div>

        {{-- Validation Error --}}
        {{-- <x-auth-validation-errors class="mb-3" :errors="$errors" /> --}}

        {{-- Session Status --}}
        <x-auth-session-status class="mb-3" :status="session('status')" />

        {{-- Form --}}
        <form method="POST" action="{{ route('password.email') }}">

            {{-- CSRF Token --}}
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control @if ($errors->any()) is-invalid @endif" id="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Member Password --}}
            <div class="mb-3">
                <p class="text-end">Вспомнили пароль? <a href="/login">Войдите!</a></p>
            </div>

            {{-- Send Form --}}
            <div class="mb-3">
                <x-button class="w-100">{{ __('Сбросить пароль') }}</x-button>
            </div>

        </form>

        {{-- </x-auth-card> --}}

    </div>

    <div class="col-md-2 col-lg-4"></div>

</x-project.layout>