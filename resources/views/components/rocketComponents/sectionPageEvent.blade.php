{{-- Блок управления состоянием закладок, располагается в самом начале, поскольку является общим для двух элементов в
компоненте --}}
{{-- А также он повторяется и поэтому может находиться сразу в компоненте --}}
{{-- А еще их нужно привести к стандарту, поскольку тут я уже импользую объект, тогда, как ранее использовал переменную
--}}
@php

// Класс по умолчанию
$bookmark_class = 'bi-bookmark';

// Если $stdVarBookmarks существует и если обнаружено совпадение
if ( isset($stdVarBookmarks) && in_array( $event->id, $stdVarBookmarks ) ) {
// То начальный класс изменяется
$bookmark_class = 'bi-bookmark-check-fill';
}

@endphp



<!-- Страница события -->
<div class="position-relative mb-5">

    <!-- Автор -->
    <a href="/user/{{ $event->user_id }}" class="d-flex align-items-center text-decoration-none mb-3 text-reset">
        @if($event->avatar)
        <img src="/public/img/avatars/{{ $event->avatar }}" alt="" width="45" height="45" class="rounded-circle me-2">
        @endif
        <strong>{{ $event->name }}</strong>
    </a>
    <!-- /Автор -->



    <!-- Просится быть отдельным компонентом, повторяется уже практически 5 что ли раз -->
    <!-- Закладка -->
    <div class="position-absolute top-0 end-0">
        @auth
        <button class="card-icon bookmark" id="{{ $event->id }}">
            <i class="bi {{ $bookmark_class }}"></i>
        </button>
        @endauth
        @guest
        <a href="/login" class="card-icon bookmark text-reset" id="{{ $event->id }}">
            <i class="bi {{ $bookmark_class }}"></i>
        </a>
        @endguest
    </div>
    <!-- /Закладка -->

    <!-- Заголовок -->
    <h5 class="mb-0">{{ $event->title }}</h5>
    <!-- /Заголовок -->

    <!-- Категория -->
    <p><small class="text-muted">@if($event->category !== 'Не имеет значения') {{ $event->category }} @endif</small></p>
    <!-- /Категория -->

    <!-- Изображение -->
    @if($event->preview)
    <img src="/public/img/previews/{{ $event->preview }}" class="img-fluid rounded w-100 mb-3" alt="event-image">
    @endif
    <!-- /Изображение -->

    <!-- Информация -->
    <ul class="list-unstyled">
        {{-- Преобразование даты в метку времени --}}
        @php
        $month = [
        1 => 'января',
        2 => 'февраля',
        3 => 'марта',
        4 => 'апреля',
        5 => 'мая',
        6 => 'июня',
        7 => 'июля',
        8 => 'августа',
        9 => 'сентября',
        10 => 'октября',
        11 => 'ноября',
        12 => 'декабря',
        ];
        $dateStart = strtotime($event->date_start);
        $d = date('d', $dateStart);
        $n = date('n', $dateStart);
        $m = $month[$n];
        $y = date('Y', $dateStart);

        @endphp

        {{-- Вывод даты в удобном формате --}}
        <li>{{ $d . ' ' . $m . ' ' . $y }}</li>
        <li>{{ $event->adress }}</li>
        @php
        $price_type = '';
        if($event->price_type == 'free') {
            $price_type = 'Вход: бесплатно';
        } elseif ($event->price_type == 'donate') {
            $price_type = 'Вход: за донат';
        } elseif ($event->price_type == 'price') {
            $price = $event->cost;
            $price_type = "Вход: $price рублей";
        }
        @endphp
        <li>{{ $price_type }}</li>
    </ul>
    <!-- /Информация -->

    <!-- Связаться -->
    <ul class="list-inline mb-3">

        <!-- Компонент: иконки контактов -->
        <x-rocketComponents.componentContacts :phoneChecked="$event->phone_checked" :phone="$event->phone"
            :telegramChecked="$event->telegram_checked" :telegram="$event->telegram"
            :whatsappChecked="$event->whatsapp_checked" :whatsapp="$event->whatsapp">
        </x-rocketComponents.componentContacts>
        <!-- /Компонент: иконки контактов -->
    </ul>
    <!-- /Связаться -->

    <!-- Описание -->
    <p>{{ $event->description }}</p>
    <!-- /Описание -->

    <!-- Статистика -->
    <div class="mb-3">
        <span class="card-icon bi bi-eye-fill"> {{ $viewsCount }}</span>
        @auth
        <a href="/run/{{ $event->id }}/users" class="text-reset text-decoration-none">
            <span class="card-icon bi bi-people-fill"> {{ $count }}</span>
        </a>
        @endauth
        @guest
        <span class="card-icon bi bi-people-fill"> {{ $count }}</span>
        @endguest
    </div>
    <!-- /Статистика -->

    <!-- Действия -->
    <div class="d-lg-block d-flex justify-content-between gap-3">
        {{-- {{ dd($event) }} --}}

        @auth

        {{-- Это условие лучше бы перенести в контроллер, а сюда вывести лишь одну переменную --}}
        @if(in_array($userId, $runUsersIds) )
        <button id="run" class="btn btn-light border tools-bw-btn flex-fill">Отменить участие</button>
        <!-- Поделиться -->
        <button class="share-link btn btn-light border ms-lg-3" data-bs-trigger="click" data-bs-toggle="tooltip"
            data-bs-placement="left" data-bs-original-title="Ссылка скопирована"
            data-main-uri="https://where-go.ru/event/{{ $event->id }}">
            <i class="bi bi-reply-fill"></i>
        </button>
        <!-- /Поделиться -->
        @elseif(Auth::id() != $event->user_id)
        <button id="run" class="btn btn-warning tools-bw-btn flex-fill">Принять участие</button>
        <!-- Поделиться -->
        <button class="share-link btn btn-light border ms-lg-3" data-bs-trigger="click" data-bs-toggle="tooltip"
            data-bs-placement="left" data-bs-original-title="Ссылка скопирована"
            data-main-uri="https://where-go.ru/event/{{ $event->id }}">
            <i class="bi bi-reply-fill"></i>
        </button>
        <!-- /Поделиться -->
        @elseif(Auth::id() == $event->user_id)
        <a href="/event/{{ $event->id }}/edit" class="btn btn-light border tools-bw-btn flex-fill">Редактировать</a>
        <!-- Поделиться -->
        <button class="share-link btn btn-light border ms-lg-3" data-bs-trigger="click" data-bs-toggle="tooltip"
            data-bs-placement="left" data-bs-original-title="Ссылка скопирована"
            data-main-uri="https://where-go.ru/event/{{ $event->id }}">
            <i class="bi bi-reply-fill"></i>
        </button>
        <!-- /Поделиться -->
        @endif

        @endauth

        @guest
        <!-- Поделиться -->
        <button class="share-link btn btn-light border tools-bw-btn" data-bs-trigger="click" data-bs-toggle="tooltip"
            data-bs-placement="left" data-bs-original-title="Ссылка скопирована"
            data-main-uri="https://where-go.ru/event/{{ $event->id }}">
            <i class="bi bi-reply-fill"></i>
        </button>
        <!-- /Поделиться -->
        @endguest



    </div>
    <!-- /Действия -->

</div>
<!-- /Страница события -->

@auth
<!-- Модальное окно созданного события -->
<x-rocketComponents.modalWindowEventDone :id="$event->id">
</x-rocketComponents.modalWindowEventDone>
<!-- /Модальное окно созданного события -->
@endauth