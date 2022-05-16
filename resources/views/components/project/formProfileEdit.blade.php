@if($message)
<div class="alert alert-info" role="alert">Привет, <strong>{{ Auth::user()->name }}</strong>, заполни свой профиль!</div>
@endif

<form action="" method="post" enctype="multipart/form-data">

    @csrf

    @if($profile->avatar)
    <img src="/public/img/avatars/{{ $profile->avatar }}" class="img-thumbnail mb-2" alt="{{ $profile->avatar }}">
    @endif

    <div class="mb-3">
        <input name="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar">
        @error('avatar')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="city" class="form-label @error('city') is-invalid @enderror">Город</label>
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
            '123'
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
        @error('city')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>



    <div class="mb-3">
        <label for="about" class="form-label">О себе</label>
        <textarea name="about" class="form-control @error('about') is-invalid @enderror" id="about" cols="30" rows="5">{{ $profile->about }}</textarea>
        @error('about')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <label for="phone" class="form-label">Номер телефона</label>
    <div class="input-group mb-3">
        <div class="input-group-text">
            <input name="phone_checked" class="form-check-input mt-0 @error('phone_checked') is-invalid @enderror" type="checkbox" value="1" @if( $profile->phone_checked == 1) checked @endif>
        </div>
        <input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ $profile->phone }}" placeholder="+79999999999" pattern="(\+7)[0-9]{10}">
        @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <label for="whatsapp" class="form-label">WhatsApp</label>
    <div class="input-group mb-3">
        <div class="input-group-text">
            <input name="whatsapp_checked" class="form-check-input mt-0 @error('whatsapp_checked') is-invalid @enderror" type="checkbox" value="1" @if( $profile->whatsapp_checked == 1) checked @endif>
        </div>
        <input name="whatsapp" type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp" value="{{ $profile->whatsapp }}" placeholder="+79999999999">
        @error('whatsapp')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <label for="telegram" class="form-label">Telegram</label>
    <div class="input-group mb-3">
        <div class="input-group-text">
            <input name="telegram_checked" class="form-check-input mt-0 @error('telegram_checked') is-invalid @enderror" type="checkbox" value="1" @if( $profile->telegram_checked == 1) checked @endif>
        </div>
        <input name="telegram" type="text" class="form-control @error('telegram') is-invalid @enderror" id="telegram" value="{{ $profile->telegram }}" placeholder="userName">
        @error('telegram')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <label for="instagram" class="form-label">Instagram</label>
    <div class="input-group mb-3">
        <div class="input-group-text">
            <input name="instagram_checked" class="form-check-input mt-0 @error('instagram_checked') is-invalid @enderror" type="checkbox" value="1" @if( $profile->instagram_checked == 1) checked @endif>
        </div>
        <input name="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" value="{{ $profile->instagram }}" placeholder="userName">
        @error('instagram')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <label for="facebook" class="form-label">Facebook</label>
    <div class="input-group mb-3">
        <div class="input-group-text">
            <input name="facebook_checked" class="form-check-input mt-0 @error('facebook_checked') is-invalid @enderror" type="checkbox" value="1" @if( $profile->facebook_checked == 1) checked @endif>
        </div>
        <input name="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook" value="{{ $profile->facebook }}" placeholder="userName">
        @error('facebook')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <label for="vk" class="form-label">Vkontakte</label>
    <div class="input-group mb-3">
        <div class="input-group-text">
            <input name="vk_checked" class="form-check-input mt-0 @error('vk_checked') is-invalid @enderror" type="checkbox" value="1" @if( $profile->vk_checked == 1) checked @endif>
        </div>
        <input name="vk" type="text" class="form-control @error('vk') is-invalid @enderror" id="vk" value="{{ $profile->vk }}" placeholder="userName">
        @error('vk')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mb-3 w-100">{{ __('Сохранить') }}</button>

</form>