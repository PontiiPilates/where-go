<x-project.layout>
    <div class="col-md-2 col-lg-4"></div>

    <div class="col-md-8 col-lg-4">

    {{-- <x-auth-card> --}}

    {{-- Validation Errors --}}
    {{-- <x-auth-validation-errors class="mb-3" :errors="$errors" /> --}}

    {{-- Session Status --}}
    <x-auth-session-status class="mb-3" :status="session('status')" />

    {{-- Form --}}
    <form method="POST" action="{{ route('login') }}">

        {{--
            Не знаю как сейчас сделать вывод ошибок к каждому полю. Валидация происходит где-то глубже, чем в контроллере. На данный момент 
        --}}

        {{-- CSRF Token --}}
        @csrf

        {{-- Remember Me --}}
        <input id="remember_me" type="hidden" class="form-check-input" name="remember" value="on">

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control @if ($errors->any()) is-invalid @endif" id="email" value="{{ old('email') }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input name="password" type="password" class="form-control @if ($errors->any()) is-invalid @endif" id="password">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Forgot Password --}}
        <div class="mb-3">
            <p class="text-end"><a href="/forgot-password">Забыли пароль?</a></p>
        </div>

        <div class="mb-3">
            <x-button class="w-100">
                {{ __('Войти') }}
            </x-button>
        </div>

    </form>

    <p>Нет аккаунта? <a class="" href="{{ route('register') }}">{{ __('Зарегистрируйтесь!') }}</a></p>

    {{-- </x-auth-card> --}}
    </div>

    <div class="col-md-2 col-lg-4"></div>


</x-project.layout>