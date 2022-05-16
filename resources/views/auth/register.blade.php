<x-project.layout>

    <div class="col-md-2 col-lg-4"></div>

    <div class="col-md-8 col-lg-4">

        {{-- <x-auth-card> --}}

        {{-- Validation Errors --}}
        {{-- Не хочу пользоваться стандартным выводом сообщений об ошибках, поскольку они выводятся пачкой без пометки соответствующих полей
        <div class="mb-3">
            <x-auth-validation-errors class="mb-3" :errors="$errors" />
        </div>
        --}}

        {{-- Email --}}
        {{-- Также на всякий случай оставляю стандартное унифицированное поле, вдруг получится передать ошибку в его класс
            <div class="mb-3">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="" type="email" name="email" :value="old('email')" required />
            </div>
        --}}

        {{-- Session Status --}}
        <x-auth-session-status class="mb-3" :status="session('status')" />

        {{-- Form --}}
        <form method="POST" action="{{ route('register') }}">

            {{-- CSRF Token --}}
            @csrf

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Как к вам обращаться?')}}</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" placeholder="Геральд из Ривии">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password Confirmation --}}
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
                <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Button --}}
            <div class="mb-3">
                <x-button class="w-100">
                    {{ __('Регистрация') }}
                </x-button>
            </div>

        </form>

        <p>Уже зарегистрированы? <a class="" href="{{ route('login') }}">{{ __('Войдите!') }}</a></p>

        {{-- </x-auth-card> --}}
    </div>

    <div class="col-md-2 col-lg-4"></div>

</x-project.layout>