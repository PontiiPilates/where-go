<form action="" method="post" class="mb-3">

    @csrf

    <div class="mb-3">

        <label for="email" class="form-label">Email</label>
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $user->email }}">
        <!-- <div id="emailHelp" class="form-text">Подсказка.</div> -->

        @error('email')
        <strong>{{ $message }}</strong>
        @enderror

    </div>

    <button name="set_email" type="submit" class="btn btn-primary">{{ __('Изменить Email') }}</button>

</form>



<form action="" method="post">

    @csrf

    <div class="mb-3">

        <label for="current_password" class="form-label">Текущий пароль</label>
        <input name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password">
        <!-- <div id="emailHelp" class="form-text">Подсказка.</div> -->

        @error('current_password')
        <strong>{{ $message }}</strong>
        @enderror

    </div>

    <div class="mb-3">

        <label for="password_confirmation" class="form-label">Новый пароль</label>
        <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
        <!-- <div id="emailHelp" class="form-text">Подсказка.</div> -->

        @error('password_confirmation')
        <strong>{{ $message }}</strong>
        @enderror

    </div>

    <div class="mb-3">

        <label for="password" class="form-label">Подтверждение пароля</label>
        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
        <!-- <div id="emailHelp" class="form-text">Подсказка.</div> -->

        @error('password')
        <strong>{{ $message }}</strong>
        @enderror

    </div>

    <button name="set_password" type="submit" class="btn btn-primary">{{ __('Изменить пароль') }}</button>

</form>