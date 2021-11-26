<form action="" method="post" enctype="multipart/form-data">

    @csrf

    <!-- <div class="mb-3">
        <label for="name" class="form-label">Имя пользователя</label>
        <input name="name" type="text" class="form-control" id="name" value="{{ $profile->name }}">
    </div> -->

    <div class="mb-3">
        <label for="avatar" class="form-label">Аватар</label>
        <input name="avatar" type="file" class="form-control" id="avatar">
        <div id="avatar" class="form-text">{{ $profile->avatar }}</div>
    </div>

    <div class="mb-3">
        <label for="about" class="form-label">О себе</label>
        <textarea name="about" class="form-control" id="about" cols="30" rows="5">{{ $profile->about }}</textarea>
    </div>

    <div class="mb-3">
        <label for="city" class="form-label">Город</label>
        <select name="city" class="form-control" id="city">

            @php
                $cityes = array(
                'Абакан',
                'Ачинск',
                'Дивногорск',
                'Железхногорск',
                'Красноярск',
                'Минусинск',
                'Сосновоборск',
                );
            @endphp

            @foreach ($cityes as $city)

                @if ($profile->city == $city)
                    <option selected value="{{ $city }}">{{ $city }}</option>
                @else
                    <option value="{{ $city }}">{{ $city }}</option>
                @endif

            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Номер телефона</label>
        <input name="phone" type="text" class="form-control" id="adress" value="{{ $profile->phone }}">
    </div>

    <div class="mb-3 form-check">

        @php
            if( $profile->wp == 'on' ) {
                $wp = 'checked';
            }
        @endphp

        <input name="wp" type="checkbox" class="form-check-input" id="wp" {{ $wp ?? '' }}>
        <label class="form-check-label" for="wp">WhatsApp</label>
    </div>

    <div class="mb-3 form-check">

        @php
            if( $profile->wb == 'on' ) {
                $wb = 'checked';
            }
        @endphp

        <input name="wb" type="checkbox" class="form-check-input" id="wb" {{ $wb ?? '' }}>
        <label class="form-check-label" for="wb">Viber</label>
    </div>

    <div class="mb-3 form-check">

        @php
            if( $profile->tg == 'on' ) {
                $tg = 'checked';
            }
        @endphp

        <input name="tg" type="checkbox" class="form-check-input" id="tg" {{ $tg ?? '' }}>
        <label class="form-check-label" for="tg">Telegram</label>
    </div>

    <div class="mb-3">
        <label for="ig" class="form-label">Instagram</label>
        <input name="ig" type="text" class="form-control" id="ig" value="{{ $profile->ig }}">
    </div>

    <div class="mb-3">
        <label for="fb" class="form-label">Facebook</label>
        <input name="fb" type="text" class="form-control" id="fb" value="{{ $profile->fb }}">
    </div>

    <div class="mb-3">
        <label for="vk" class="form-label">Vkontakte</label>
        <input name="vk" type="text" class="form-control" id="vk" value="{{ $profile->vk }}">
    </div>

    <div class="mb-3">
        <label for="ok" class="form-label">Odnoklassniki</label>
        <input name="ok" type="text" class="form-control" id="ok" value="{{ $profile->ok }}">
    </div>

    <div class="mb-3">
        <label for="yt" class="form-label">YouTube</label>
        <input name="yt" type="text" class="form-control" id="yt" value="{{ $profile->yt }}">
    </div>

    <button type="submit" class="btn btn-primary">Обновить</button>

</form>