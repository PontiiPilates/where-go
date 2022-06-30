<!-- Форма сброса пароля -->
<form method="POST" action="{{ route('password.update') }}">

    <!-- Токен -->
    @csrf
    <!-- /Токен -->

    <!-- Токен -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">
    <!-- /Токен -->

    <!-- Email -->
    <div class="mb-5">
        <label for="email" class="form-label ">{{ __('Email') }}</label>
        <input name="email" type="email" class="form-control @error('email') is-invalid @endif" id="email" value="{{ old('email', $request->email) }}">
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

    <!-- Подтверждение пароля -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">{{ __('Подтверждение пароля') }}</label>
        <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
        @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Подтверждение пароля -->

    <div>
        <button type="submit" class="btn btn-warning w-100">{{ __('Сбросить пароль') }}</button>
    </div>

</form>
<!-- /Форма сброса пароля -->