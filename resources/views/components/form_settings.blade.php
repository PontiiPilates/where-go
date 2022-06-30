{{-- Табы --}}
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link text-reset me-2 @if($active == 'profile') active @endif" id="pills-home-tab"
            data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
            aria-selected="true">Профиль</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link text-reset me-2 @if($active == 'password') active @endif" id="pills-profile-tab"
            data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
            aria-selected="false">Пароль</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link text-reset @if($active == 'email') active @endif" id="pills-contact-tab"
            data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
            aria-selected="false">Почта</button>
    </li>
</ul>

<div class="tab-content mb-5" id="pills-tabContent">

    {{-- Контейнер для формы редактирования профиля --}}
    <div class="tab-pane fade @if($active == 'profile') show active @endif"
         id="pills-home"
         role="tabpanel"
         aria-labelledby="pills-home-tab">

        {{-- Форма редактирования профиля --}}
        <form action="" method="post" enctype="multipart/form-data">

            @csrf

            {{-- Изображение --}}
            <img src="/public/img/avatars/{{ session('avatar') ?? 'default.jpg' }}" class="rounded w-50 mb-3" alt="image">

            {{-- Загрузка изображения --}}
            <div class="mb-3">
                <label for="avatar" class="form-label">{{ __('Изображение') }}</label>
                <input name="avatar"
                       type="file"
                       class="form-control @error('avatar') is-invalid @enderror"
                       id="avatar">
                @error('avatar')
                <div id="avatar" class="invalid-feedback">{{ __('Загружаемое изображение должно быть в формате .jpg или .png') }}</div>
                @enderror
            </div>

            {{-- О себе --}}
            <div class="mb-3">
                <label for="about" class="form-label">{{ __('О себе') }}</label>
                <textarea name="about"
                          class="form-control @error('about') is-invalid @enderror"
                          id="about"
                          cols="30" rows="5">{{ session('about') ?? old('about') }}</textarea>
                @error('about')
                <div id="about" class="invalid-feedback">{{ __('Расскажите что-нибудь о себе. Не менее 120 символов.') }}</div>
                @enderror
            </div>

            {{-- Номер телефона --}}
            <label for="phone" class="form-label">Номер телефона</label>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <input name="phone_checked"
                           class="form-check-input mt-0"
                           type="checkbox"
                           value="checked"
                           {{ session('phone_checked') }}>
                </div>
                <input name="phone"
                       type="tel"
                       class="form-control @error('phone') is-invalid @enderror"
                       id="phone"
                       value="{{ session('phone') }}"
                       placeholder="+79999999999"
                       pattern="(\+7)[0-9]{10}">
                @error('phone')
                <div id="phone" class="invalid-feedback">{{ __('Введите номер так, как указано в примере') }}</div>
                @enderror
            </div>
            <!-- /Номер телефона -->

            {{-- Телеграм --}}
            <label for="telegram" class="form-label">Telegram</label>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <input name="telegram_checked"
                           class="form-check-input mt-0"
                           type="checkbox"
                           value="checked"
                           {{ session('telegram_checked') }}>
                </div>
                <input name="telegram"
                       type="text"
                       id="telegram"
                       class="form-control @error('telegram') is-invalid @enderror"
                       value="{{ session('telegram') }}"
                       placeholder="userName">
                @error('telegram')
                <div id="telegram" class="invalid-feedback">{{ __('Введите имя пользователя в мессенджере так, как указано в примере') }}</div>
                @enderror
            </div>

            {{-- Вконтакте --}}
            <label for="vk" class="form-label">Vkontakte</label>
            <div class="input-group mb-4">
                <div class="input-group-text">
                    <input name="vk_checked"
                           class="form-check-input mt-0"
                           type="checkbox"
                           value="checked"
                           {{ session('vk_checked') }}>
                </div>
                <input name="vk"
                       type="text"
                       class="form-control @error('vk') is-invalid @enderror"
                       id="vk"
                       value="{{ session('vk') }}"
                       placeholder="userName или id">
                @error('vk')
                <div id="vk" class="invalid-feedback">{{ __('Введите имя пользователя или идентификатор в социальной сети так, как указано в примере') }}</div>
                @enderror
            </div>

            {{-- WhatsApp --}}
            <label for="whatsapp" class="form-label">WhatsApp</label>
            <div class="input-group mb-4">
                <div class="input-group-text">
                    <input name="whatsapp_checked"
                           class="form-check-input mt-0"
                           type="checkbox"
                           value="checked"
                           {{ session('whatsapp_checked') }}>
                </div>
                <input name="whatsapp"
                       type="text"
                       class="form-control @error('whatsapp') is-invalid @enderror"
                       id="whatsapp"
                       value="{{ session('whatsapp') }}"
                       placeholder="+79999999999">
                @error('vk')
                <div id="vk" class="invalid-feedback">{{ __('Введите номер так, как указано в примере') }}</div>
                @enderror
            </div>

            {{-- Сохранить --}}
            <div class="d-lg-block d-flex">
                <button name="form_name"
                        type="submit"
                        class="btn btn-warning flex-fill tools-bw-btn"
                        value="control_profile">
                        {{ __('Сохранить') }}</button>
            </div>

        </form>

    </div>
    
    {{-- Контейнер для формы смены пароля --}}
    <div class="tab-pane fade @if($active == 'password') show active @endif"
         id="pills-profile"
         role="tabpanel"
         aria-labelledby="pills-profile-tab">
    
        <!-- Форма смены пароля -->
        <form action="" method="post">

            @csrf

            {{-- Текущий пароль --}}
            <div class="mb-3">
                <label for="current_password" class="form-label">{{ __('Текущий пароль') }}</label>
                <input name="current_password"
                       type="password"
                       class="form-control @error('current_password') is-invalid @enderror"
                       id="current_password">
                @error('current_password')
                <div id="current_password" class="invalid-feedback">{{ __('Вы указали не верный текущий пароль') }}</div>
                @enderror
            </div>

            {{-- Новый пароль --}}
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{ __('Новый пароль') }}</label>
                <input name="password_confirmation"
                       type="password"
                       class="form-control @error('password_confirmation') is-invalid @enderror"
                       id="password_confirmation">
                @error('password_confirmation')
                <div id="password_confirmation" class="invalid-feedback">{{ __('Пароль слишком прост') }}</div>
                @enderror
            </div>

            {{-- Подтверждение пароля --}}
            <div class="mb-4">
                <label for="password" class="form-label">{{ __('Подтверждение пароля') }}</label>
                <input name="password"
                       type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       id="password">
                @error('password')
                <div id="password" class="invalid-feedback">{{ __('Пароли не совпадают') }}</div>
                @enderror
            </div>

            {{-- Изменить пароль --}}
            <div class="d-lg-block d-flex">
                <button name="form_name"
                        value="change_password"
                        type="submit"
                        class="btn btn-warning flex-fill tools-bw-btn">{{ __('Изменить пароль') }}</button>
            </div>

        </form>

    </div>

    {{-- Контейнер для формы смены почты --}}
    <div class="tab-pane fade @if($active == 'email') show active @endif"
         id="pills-contact"
         role="tabpanel"
         aria-labelledby="pills-contact-tab">

         

        {{-- Форма смены почты --}}
        <form action="" method="post">

            @csrf

            <div class="mb-4">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input name="email"
                       type="text"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email"
                       value="{{ session('email') ?? old('email') }}">
                @error('email')
                <div id="email" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Изменить Email --}}
            <div class="d-lg-block d-flex">
                <button name="form_name"
                        type="submit"
                        value="change_email"
                        class="btn btn-warning flex-fill tools-bw-btn">{{ __('Изменить Email') }}</button>
            </div>

        </form>

    </div>

</div>