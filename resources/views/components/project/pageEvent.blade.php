@foreach ($event as $item)

@php
@endphp

<div class="card mb-3" style="width: 100%">

    <div class="card-body">

        {{-- <!-- Блок управления событием  --> --}}
        <div class="position-absolute top-0 end-0 d-flex">

            @if(Auth::id() == $item->user_id)
            <div style="width: 42px; height: 38px">
                <a href="/edit/event/{{ $item->id }}" class="btn">
                    <i class="bi bi-gear"></i>
                </a>
            </div>
            @else

            {{-- <!-- Закладки --> --}}

            @auth
            <div style="width: 42px; height: 38px" class="btn">
                @if( $bookmarks && in_array( $item->id, $bookmarks ) )
                <i class="bookmark bi bi-bookmark-check-fill" id="{{ $item->id }}"></i>
                @else
                <i class="bookmark bi bi-bookmark" id="{{ $item->id }}"></i>
                @endif
            </div>
            @endauth
            @endif
            <div style="width: 42px; height: 38px" class="d-flex justify-content-center align-items-center">
                <div class="ya-share2 align-self-center" data-curtain data-size="s" data-shape="round" data-limit="0" data-more-button-type="short" data-services="vkontakte,facebook,odnoklassniki,telegram,whatsapp"></div>
            </div>

        </div>

        <a href="/event/{{ $item->id }}" class="link-dark" style="text-decoration: none;">
            <h5 class="card-title">{{ $item->title }}</h5>
        </a>

        <h6 class="card-subtitle mb-2 text-muted">{{ $item->city }}, {{ $item->adress }}</h6>

        <p class="card-text"><small class="text-muted">{{ mb_strcut($item->date_start, 0, -9) }}</small></p>

    </div>

    <img src="/public/img/previews/{{ $item->preview }}" class="img-fluid" alt="...">

    <div class="card-body">


        <p class="card-text">{{ $item->description }}</p>

        <a href="/profile/{{ $item->user_id }}" class="card-link">{{ $item->name }}</a>

        {{-- Если автор события выбрал статус "свидетель", то контакты не указываются --}}
        @if(!$item->witness)

        @if (
        $creator->phone_checked == 1||
        $creator->facebook_checked == 1||
        $creator->whatsapp_checked == 1||
        $creator->telegram_checked == 1||
        $creator->instagram_checked == 1||
        $creator->vk_checked == 1
        )
        <p class="card-text">Связаться с организатором:</p>
        @endif

        <ul class="nav justify-content-start gap-2 w-100">


            @if ($creator->phone_checked == 1)
            <li class="nav-item">
                <a class="" aria-current="page" href="tel:{{ $creator->phone }}" target="_blank">
                    <img src="/public/img/icons/Telephone.svg" height="24px" width="24px" />
                </a>
            </li>
            @endif

            @if ($creator->facebook_checked == 1)
            <li class="nav-item">
                <a class="" aria-current="page" href="https://www.facebook.com/{{ $creator->facebook }}" target="_blank">
                    <img src="/public/img/social_icons/Facebook.svg" height="24px" width="24px" />
                </a>
            </li>
            @endif

            @if($creator->whatsapp_checked == 1)
            <li class="nav-item">
                <a class="" aria-current="page" href="https://api.whatsapp.com/send?phone={{ $creator->whatsapp }}" target="_blank">
                    <img src="/public/img/social_icons/WhatsApp.svg" height="24px" width="24px" />
                </a>
            </li>
            @endif

            @if($creator->telegram_checked == 1)
            <li class="nav-item">
                <a class="" aria-current="page" href="https://t.me/{{ $creator->telegram }}" target="_blank">
                    <img src="/public/img/social_icons/Telegram.svg" height="24px" width="24px" />
                </a>
            </li>
            @endif

            @if($creator->instagram_checked == 1)
            <li class="nav-item">
                <a class="" aria-current="page" href="https://instagram.com/{{ $creator->instagram }}" target="_blank">
                    <img src="/public/img/social_icons/Instagram.svg" height="24px" width="24px" />
                </a>
            </li>
            @endif

            @if($creator->vk_checked == 1)
            <li class="nav-item">
                <a class="" aria-current="page" href="https://vk.com/{{ $creator->vk }}" target="_blank">
                    <img src="/public/img/social_icons/VK.svg" height="24px" width="24px" />
                </a>
            </li>
            @endif

        </ul>
        @endif

    </div>

</div>
@endforeach
<script src="https://yastatic.net/share2/share.js"></script>