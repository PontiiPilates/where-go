{{-- Очень ебаный костыль --}}
@php
$active = 'profile';
if ( isset(Request::query()['password']) ) {
$active = 'password';
}
if ( isset(Request::query()['email']) ) {
$active = 'email';
}
@endphp

<!-- Меню профиля -->
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link text-reset me-2 @if($active == 'profile') active @endif" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Профиль</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link text-reset me-2 @if($active == 'password') active @endif" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Пароль</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link text-reset @if($active == 'email') active @endif" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Почта</button>
    </li>
</ul>
<!-- /Меню профиля -->

<!-- Настройки профиля -->
<div class="tab-content mb-5" id="pills-tabContent">

    <!-- Форма редактирования профиля -->
    <div class="tab-pane fade @if($active == 'profile') show active @endif" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <form action="" method="post" enctype="multipart/form-data">

            @csrf

            <!-- Изображение -->
            <img src="/public/img/avatars/{{ $profile->avatar ?? 'default.jpg' }}" class="rounded w-50 mb-3" alt="image">
            <!-- /Изображение -->

            <!-- Загрузка изображения -->
            <div class="mb-3">
                <label for="avatar" class="form-label">Изображение</label>
                <input name="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar">
                @error('avatar')
                <div id="avatar" class="invalid-feedback">Загружаемое изображение должно быть в формате .jpg или .png</div>
                @enderror
            </div>
            <!-- /Загрузка изображения -->

            <!-- О себе -->
            @php
            // Если есть введенное значение перед перезагрузкой страницы
            if ( old('about') ) {
            $profile->about = old('about');
            }
            @endphp
            <div class="mb-3">
                <label for="about" class="form-label">О себе</label>
                <textarea name="about" class="form-control @error('about') is-invalid @enderror" id="about" cols="30" rows="5">{{ $profile->about ?? '' }}</textarea>
                @error('about')
                <div id="about" class="invalid-feedback">Расскажите о себе</div>
                @enderror
            </div>
            <!-- /О себе -->

            <!-- Выбо города -->
            @php
            // Просто массив значений
            $cityes = array(
            'Не имеет значения',
            'Ачинск',
            'Артемовск',
            'Боготол',
            'Бородино',
            'Енисейск',
            'Железногорск',
            'Дивногорск',
            'Дудинка',
            'Заозерный',
            'Зеленогорск',
            'Игарка',
            'Иланский',
            'Канск',
            'Кодинск',
            'Красноярск',
            'Лесосибирск',
            'Минусинск',
            'Назарово',
            'Норильск',
            'Сосновоборск',
            'Ужур',
            'Уяр',
            'Шарыпово',
            );
            @endphp

            @php
            $selected = '';
            // Если событие редактируется и $city существует
            if( $profile->city ) {
            $selected = $profile->city;
            }
            // Если перед отправкой формы было установлено значение
            if( old('city') ) {
            $selected = old('city');
            }
            @endphp

            <div class="mb-3">
                <label for="city" class="form-label">Город</label>
                <select name="city" id="city" class="form-select @error('city') is-invalid @enderror">
                    {{-- Вывод списка городов --}}
                    @foreach($cityes as $city)

                    {{-- Если $selected совпадает со значением из списка, то отображать его как selected --}}
                    @if( $selected == $city )
                    <option selected value="{{ $city }}">{{ $city }}</option>
                    {{-- Иначе просто option --}}
                    @else
                    <option value="{{ $city }}">{{ $city }}</option>
                    @endif

                    @endforeach
                </select>
                @error('city')
                <div id="city" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- /Выбор города -->

            <!-- Номер телефона -->
            <label for="phone" class="form-label">Номер телефона</label>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    @php
                    $checked = '';
                    if( $profile->phone_checked) {
                    $checked = 'checked';
                    }
                    @endphp
                    <input name="phone_checked" class="form-check-input mt-0 " type="checkbox" value="1" {{ $checked }}>
                </div>
                <input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ $profile->phone ?? '' }}" placeholder="+79999999999" pattern="(\+7)[0-9]{10}">
                @error('phone')
                <div id="phone" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- /Номер телефона -->

            <!-- Телеграм -->
            <label for="telegram" class="form-label">Telegram</label>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    @php
                    $checked = '';
                    if( $profile->telegram_checked) {
                    $checked = 'checked';
                    }
                    @endphp
                    <input name="telegram_checked" class="form-check-input mt-0 " type="checkbox" value="1" {{ $checked }}>
                </div>
                <input name="telegram" type="text" class="form-control @error('telegram') is-invalid @enderror" id="telegram" value="{{ $profile->telegram ?? '' }}" placeholder="userName">
                @error('telegram')
                <div id="telegram" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- /Телеграм -->

            <!-- Вконтакте -->
            <label for="vk" class="form-label">Vkontakte</label>
            <div class="input-group mb-4">
                <div class="input-group-text">
                    @php
                    $checked = '';
                    if( $profile->vk_checked) {
                    $checked = 'checked';
                    }
                    @endphp
                    <input name="vk_checked" class="form-check-input mt-0 " type="checkbox" value="1" {{ $checked }}>
                </div>
                <input name="vk" type="text" class="form-control @error('vk') is-invalid @enderror" id="vk" value="{{ $profile->vk ?? '' }}" placeholder="userName">
                @error('vk')
                <div id="vk" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- /Вконтакте -->

            <div class="d-lg-block d-flex">
                <button name="form_name" value="profile" type="submit" class="btn btn-warning flex-fill tools-bw-btn">Сохранить</button>
            </div>

        </form>
        {{-- dd($profile) --}}
    </div>
    <!-- /Форма редактирования профиля -->

    <!-- Форма смены пароля -->
    <div class="tab-pane fade @if($active == 'password') show active @endif" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <form action="" method="post">

            @csrf

            <div class="mb-3">
                <label for="current_password" class="form-label">Текущий пароль</label>
                <input name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password">
                @error('current_password')
                <div id="current_password" class="invalid-feedback">Не верный пароль</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Новый пароль</label>
                <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
                @error('password_confirmation')
                <div id="password_confirmation" class="invalid-feedback">Пароль слишком прост</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Подтверждение пароля</label>
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
                @error('password')
                <div id="password" class="invalid-feedback">Пароли не совпадают</div>
                @enderror
            </div>
            <div class="d-lg-block d-flex">
                <button name="form_name" value="sequrity" type="submit" class="btn btn-warning flex-fill tools-bw-btn">Изменить пароль</button>
            </div>
        </form>
    </div>
    <!-- /Форма смены пароля -->

    <!-- Форма смены почты -->
    <div class="tab-pane fade @if($active == 'email') show active @endif" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <form action="" method="post">

            @csrf

            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $email ?? '' }}">
                @error('email')
                <div id="email" class="invalid-feedback">Адрес электронной почты должен быть введен полностью</div>
                @enderror
            </div>
            <div class="d-lg-block d-flex">
                <button name="form_name" type="submit" value="email" class="btn btn-warning flex-fill tools-bw-btn">Изменить Email</button>
            </div>
        </form>
    </div>
    <!-- /Форма смены почты -->

</div>
<!-- /Настройки профиля -->