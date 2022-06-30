@if ($status)
    <div class="alert alert-secondary" role="alert">{{ __('Ссылка для сброса пароля отправлена на вашу почту') }}</div>
@else
    <p class="mb-3">{{ __('Забыли пароль? Не проблема. Просто сообщите нам свой адрес электронной почты, и мы пришлём ссылку для сброса пароля, которая позволит вам выбрать новый.') }}</p>
@endif

<p class="mb-3">
    {{ __('Вспомнили пароль?') }} <a href="{{ route('login') }}">{{ __('Войдите!') }}</a>
</p>

<!-- Форма запроса на восстановление пароля -->
<form method="POST" action="{{ route('password.email') }}">

    <!-- Токен -->
    @csrf
    <!-- /Токен -->

    <!-- Email -->
    <div class="mb-5">
        <label for="email" class="form-label ">{{ __('Email') }}</label>
        <input name="email" type="email" class="form-control @error('email') is-invalid @endif" id="email" value="{{ old('email') }}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Email -->

    <div>
        <button type="submit" class="btn btn-warning w-100">{{ __('Сбросить пароль') }}</button>
    </div>

</form>
<!-- /Форма запроса на восстановление пароля -->