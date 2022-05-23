<p class="mb-3">
    {{ __('Еще нет аккаунта?') }} <a href="{{ route('register') }}">{{ __('Зарегистрируйтесь!') }}</a>
</p>

<!-- Форма авторизации -->
<form method="POST" action="{{ route('login') }}">

    <!-- Токен -->
    @csrf
    <!-- /Токен -->

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Email -->

    <!-- Пароль -->
    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Пароль') }}</label>
        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Пароль -->

    <p class="mb-5">
        <a href="{{ route('password.email') }}">{{ __('Забыли пароль?') }}</a>
    </p>

    <div>
        <button type="submit" class="btn btn-warning w-100">{{ __('Войти') }}</button>
    </div>

</form>
<!-- /Форма авторизации -->