<div class="card mb-3" style="width: 100%">

    <img src="/public/img/avatars/{{ $profile->avatar }}" class="card-img-top" alt="{{ $profile->avatar }}">

    <div class="card-body position-relative">

        <div class="position-absolute top-0 end-0">

            @php
            if($profile->followers) {
            $followers = $profile->followers;
            $followers = unserialize($followers);
            $count = count($followers);
            }
            @endphp

            @if(isset($count) && $count >= 1)
            <a href="/followers/{{ $profile->user_id }}" class="btn">
                <i class="bi bi-suit-heart"></i>
                <span class="badge bg-success">{{ $count }}</span>
            </a>
            @endif

            {{-- <!-- Подписка на пользователя --> --}}
            {{--
            <a href="/follow" class="btn" style="right: 40px;">
                <i class="bi bi-bell"></i>
            </a>
            <a href="/unfollow" class="btn" style="right: 40px;">
                <i class="bi bi-bell-fill"></i>
            </a>
            --}}

            @if( Request::is('profile/*') )

            @php

            /**
            * Проверка, подписан ли auth на user
            */

            // Получение идентификатора auth
            $auth_id = Auth::id();

            // Проверка существования подписок
            if(isset($followers) && $followers) {
            // Проверка, есть ли среди подписчиков user auth
            $toggle = in_array( $auth_id, $followers );
            }


            @endphp

            {{-- <!-- Подписка на пользователя --> --}}
            @auth
            {{-- <!-- Чтобы пользователь не смог подписаться на самого себя --> --}}
            @if($profile->user_id != Auth::id())
            <div style="width: 42px; height: 38px" class="btn">
                <i class="follow bi @if(isset($toggle)) bi-person-check-fill @else bi-person @endif" id="{{ $profile->user_id }}"></i>
            </div>
            @endif
            @endauth

            @endif

            {{-- <!-- Прошедшие события пользователя --> --}}
            <a href="/past/{{ $profile->user_id }}" class="btn" style="right: 40px;">
                <i class="bi bi-calendar-check"></i>
            </a>

            @if($profile->user_id == Auth::id())
            {{-- <!-- Настройка начальных данных пользователя --> --}}
            <a href="/edit/security" class="btn" style="right: 40px;">
                <i class="bi bi-key"></i>
            </a>

            {{-- <!-- Редактирование профиля --> --}}
            <a href="/edit/profile" class="btn">
                <i class="bi bi-gear"></i>
            </a>
            @endif


        </div>

        <h5 class="card-title">{{ $profile->name }}</h5>

        @if ($profile->city)
        <h6 class="card-subtitle mb-2 text-muted">{{ $profile->city }}</h6>
        @endif

        @if($profile->about)
        <p class="card-text">{{ $profile->about }}</p>
        @endif

        @if (
        $profile->phone_checked == 1||
        $profile->facebook_checked == 1||
        $profile->whatsapp_checked == 1||
        $profile->telegram_checked == 1||
        $profile->instagram_checked == 1||
        $profile->vk_checked == 1
        )
        <p class="card-text">Связаться со мной:</p>
        @endif

        <ul class="nav justify-content-start gap-2 w-100">

            @if ($profile->phone_checked == 1)
            <li class="nav-item">
                <a class="" aria-current="page" href="tel:{{ $profile->phone }}" target="_blank">
                    <img src="/public/img/icons/Telephone.svg" height="24px" width="24px" />
                </a>
            </li>
            @endif

            @if ($profile->facebook_checked == 1)
            <li class="nav-item">
                <a class="" aria-current="page" href="https://www.facebook.com/{{ $profile->facebook }}" target="_blank">
                    <img src="/public/img/social_icons/Facebook.svg" height="24px" width="24px" />
                </a>
            </li>
            @endif

            @if($profile->whatsapp_checked == 1)
            <li class="nav-item">
                <a class="" aria-current="page" href="https://api.whatsapp.com/send?phone={{ $profile->whatsapp }}" target="_blank">
                    <img src="/public/img/social_icons/WhatsApp.svg" height="24px" width="24px" />
                </a>
            </li>
            @endif

            @if($profile->telegram_checked == 1)
            <li class="nav-item">
                <a class="" aria-current="page" href="https://t.me/{{ $profile->telegram }}" target="_blank">
                    <img src="/public/img/social_icons/Telegram.svg" height="24px" width="24px" />
                </a>
            </li>
            @endif

            @if($profile->instagram_checked == 1)
            <li class="nav-item">
                <a class="" aria-current="page" href="https://instagram.com/{{ $profile->instagram }}" target="_blank">
                    <img src="/public/img/social_icons/Instagram.svg" height="24px" width="24px" />
                </a>
            </li>
            @endif

            @if($profile->vk_checked == 1)
            <li class="nav-item">
                <a class="" aria-current="page" href="https://vk.com/{{ $profile->vk }}" target="_blank">
                    <img src="/public/img/social_icons/VK.svg" height="24px" width="24px" />
                </a>
            </li>
            @endif

        </ul>


    </div>

</div>