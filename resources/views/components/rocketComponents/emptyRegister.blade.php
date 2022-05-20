<p class="mb-3">Уже есть аккаунт? <a href="">Войдите!</a></p>

<!-- Форма регистрации -->
<form method="POST" action="{{ route('register') }}">

    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Как обращаться к вам?') }}</label>
        <input name="name" type="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
        <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
        @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <button type="submit" class="btn btn-warning w-100">Регистрация</button>
    </div>

</form>
<!-- /Форма регистрации -->