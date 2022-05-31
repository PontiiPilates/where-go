{{-- Блок управления состоянием закладок, располагается в самом начале, поскольку является общим для двух элементов в
компоненте --}}
{{-- А также он повторяется и поэтому может находиться сразу в компоненте --}}
@php

// Класс по умолчанию
$bookmark_class = 'bi-bookmark';

// Если $bookmarks существует и если обнаружено совпадение
if ( isset($bookmarks) && in_array( $id, $bookmarks ) ) {
// То начальный класс изменяется
$bookmark_class = 'bi-bookmark-check-fill';
}

@endphp

<!-- Карточка -->
<div class="card mb-3 main-light-shadow border-white postiton-relative">
    <div class="row p-1 g-3">

        {{-- Если есть изображение --}}
        @if($preview)
        <!-- Левая колонка / верхняя строка -->
        <div class="col col-lg-6" style="min-width: 300px;">

            <!-- Блок для мобильной версии -->
            <div class="d-block d-sm-none position-relative p-0 mb-3">

                <!-- Автор -->
                <a href="/user/{{ $creatorId }}" class="d-flex align-items-center text-decoration-none text-reset">

                    @if($avatar)
                    <img src="/public/img/avatars/{{ $avatar }}" alt="image-profile" width="45" height="45"
                        class="rounded-circle me-2">
                    @endif

                    <strong>{{ $username }}</strong>
                </a>
                <!-- /Автор -->

                <!-- Просится быть отдельным компонентом, повторяется уже практически 5 что ли раз -->
                <!-- Закладка -->
                <div class="position-absolute top-0 end-0">
                    <button class="card-icon bookmark" id="{{ $id }}">
                        <i class="bi {{ $bookmark_class }}"></i>
                    </button>
                </div>
                <!-- /Закладка -->

            </div>
            <!-- /Блок для мобильной версии -->

            <!-- Изображение -->
            <img src="/public/img/previews/{{ $preview }}" class="img-fluid rounded" alt="image-event">
            <!-- /Изображение -->

        </div>
        <!-- /Левая колонка / верхняя строка -->
        @endif

        <!-- Правая колонка / нижняя строка -->
        <div class="col @if( $preview ) col-lg-6 @endif" style="min-width: 300px;">
            <div class="card-body position-relative h-100 p-0 pb-3">

                <!-- Блок для десктопной версии -->
                <!-- TODO: поскольку этот фрагмент повторяется, то следует подумать над вёрсткой. Возможно тут поможет order -->
                <div class="d-none d-sm-block position-relative">

                    <!-- Автор -->
                    <a href="/user/{{ $creatorId }}"
                        class="d-flex align-items-center text-decoration-none mb-3 text-reset">

                        @if($avatar)
                        <img src="/public/img/avatars/{{ $avatar }}" alt="image-profile" width="45" height="45"
                            class="rounded-circle me-2">
                        @endif

                        <strong>{{ $username }}</strong>
                    </a>
                    <!-- /Автор -->

                    <!-- Закладка -->
                    <div class="position-absolute top-0 end-0">
                        <button class="card-icon bookmark" id="{{ $id }}">
                            <i class="bi {{ $bookmark_class }}"></i>
                        </button>
                    </div>
                    <!-- /Закладка -->

                </div>
                <!-- /Блок для десктопной версии -->

                <!-- Заголовок -->
                <a href="/event/{{ $id }}" class="text-reset text-decoration-none">
                    <h5 class="card-title text-truncate mb-0">{{ $title }}</h5>
                </a>
                <!-- /Заголовок -->

                <!-- Категория -->

                {{-- Преобразование строки категории в массив --}}
                @php
                $category = explode(',', $category)
                @endphp

                <p class="card-text">
                    <small class="text-muted">

                        {{-- Организация вывода категорий с использованием разделимтеля --}}
                        @foreach($category as $item)
                        <a href="" class="text-reset">{{ $item }}</a>
                        @unless($loop->last)
                        |
                        @endunless
                        @endforeach

                    </small>
                </p>
                <!-- /Категория -->

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
                    $dateStart = strtotime($dateStart);
                    $d = date('d', $dateStart);
                    $n = date('n', $dateStart);
                    $m = $month[$n];
                    $y = date('Y', $dateStart);

                    @endphp

                    {{-- Вывод даты в удобном формате --}}
                    <li>{{ $d . ' ' . $m . ' ' . $y }}</li>

                    <li>{{ $adress }}</li>

                    @php
                    $price_type = '';
                    if($priceType == 'free') {
                    $price_type = 'Вход: бесплатно';
                    } elseif ($priceType == 'donate') {
                    $price_type = 'Вход: за донат';
                    } elseif ($priceType == 'price') {
                    $price = $cost;
                    $price_type = "Вход: $price рублей";
                    }
                    @endphp
                    <li>{{ $price_type }}</li>
                </ul>
                <!-- /Информация -->

                <!-- Статистика -->
                <div class="position-absolute bottom-0">
                    <span class="card-icon bi bi-eye-fill"> {{ $viewsCount }}</span>
                    @php
                    $goes = unserialize($goes);
                    $goes = count($goes);
                    @endphp
                    <span class="card-icon bi bi-people-fill"> {{ $goes }}</span>
                </div>
                <!-- /Статистика -->

                <!-- Поделиться -->
                <div class="position-absolute bottom-0 end-0">
                    <button class="share-link card-icon" data-bs-trigger="click" data-bs-toggle="tooltip"
                        data-bs-placement="left" data-bs-original-title="Ссылка скопирована"
                        data-main-uri="https://where-go.ru/event/{{ $id }}">
                        <i class="bi bi-reply-fill"></i>
                    </button>
                </div>
                <!-- /Поделиться -->

            </div>
        </div>
        <!-- /Правая колонка / нижняя строка -->

    </div>

    @if($dateStart + 86400 < time()) <!-- Фон прошедшего события -->
        <div class="position-absolute top-0 bottom-0 start-0 end-0 bg-white opacity-75"></div>
        <!-- /Фон прошедшего события -->

        <!-- Обозначение прошедшего события -->
        <a href="/event/{{ $id }}" class="text-reset text-decoration-none">
            <div class="position-absolute top-50 start-50 translate-middle bg-white rounded-circle opacity-100 main-strong-shadow d-flex flex-column justify-content-center align-items-center gap-2"
                style="height: 120px; width: 120px;">
                <div><i class="bi bi-hourglass-bottom"></i></div>
                <div class="text-center">Событие окончено</div>
            </div>
        </a>
        <!-- /Обозначение прошедшего события -->
        @endif

</div>
<!-- /Карточка -->