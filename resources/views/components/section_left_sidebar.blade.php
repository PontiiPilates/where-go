{{-- Левый сайдбар --}}
<div class="sf-container unscroll-container pt-5">
    <div class="sf-content">

        {{-- Меню --}}
        <div class="border-bottom pb-3">
            <div>
                <a href="/event/add" class="btn btn-warning w-100 text-start mb-2">
                    <i class="bi bi-plus-circle-fill me-2"></i>Создать событие
                </a>
            </div>
            <div>
                <a href="/" class="btn btn-light w-100 border-0 text-start mb-2 @if(Request::is('/')) active @endif">
                    <i class="bi bi-view-list me-2"></i>Поток
                </a>
            </div>
            <div>
                <a href="/bookmarks"
                    class="btn btn-light w-100 border-0 text-start mb-2 @if(Request::is('bookmarks')) active @endif">
                    <i class="bi bi-bookmark-check me-2"></i>Закладки
                </a>
            </div>
            <div>
                <a href="/run" class="btn btn-light w-100 border-0 text-start @if(Request::is('run')) active @endif">
                    <i class="bi bi-geo me-2"></i>Иду
                </a>
            </div>
        </div>

        {{-- Desctop фильтр --}}
        <div class="border-bottom pt-3 pb-3">
            <form method="get" action="">

                {{-- <div class="mb-3">
                    По городу
                    <x-field_city_filter :localstorage="$localstorage"></x-field_city_filter>
                    </div> --}}
                    
                <div class="mb-3">
                    {{-- По категории --}}
                    <x-field_category_filter :localstorage="$localstorage"></x-field_category_filter>
                </div>
                <div class="mb-4">
                    {{-- По дате --}}
                    <x-field_data_filter></x-field_data_filter>
                </div>
                <button name="filter" value="true" type="submit" class="btn btn-warning w-100 text-start">
                    <i class="bi bi-search me-2"></i>{{ __('Искать') }}
                </button>
            </form>
        </div>

        @auth

            {{-- Управление высотой контейнера --}}
            @php
            // Высота контейнера по умолчанию
            $height = 'auto';
            // Количество элементов в массиве
            $count = count(session('favourites_obj'));
            // Количество отображаемых элементов
            $open_items = 3;
            // Итерация цикла, после которой произвести вывод кнопки
            $show_button = $open_items - 1;
            // Если количество элементов в массиве больше требуемого, то его высота становится фиксированной
            // Она включает высоту выводимых элементов + кнопка
            if($count > 3) {
            // $height = '109px'; // Для отображения одной подписки и кнопки
            $height = '195px'; // Для отображения трёх подписок и кнопки
            // $height = '229px'; // Для отображения четырёх подписок и кнопки
            }
            @endphp

            {{-- Подписки --}}
            <div class="border-bottom pt-3 pb-3 d-flex flex-column gap-2" id="drop-list" style="height: {{ $height }}">

                @if($count == 0)
                <small class="m-0">{{ __('Подпишитесь на кого-нибудь') }}</small>
                @endif

                @foreach (session('favourites_obj') as $item)

                    <a href="/user/{{ $item->id }}" type="button" class="btn btn-sm position-relative text-start m-0 p-0">
                        <img src="/public/img/avatars/{{ $item->avatar }}" alt="follwo-avatar" width="32" height="32" class="rounded-circle me-2">
                        <strong>{{ Str::limit($item->name, 15) }}</strong>

                        {{-- Marker --}}
                        @if( in_array($item->id, session('notifications_marks_users')) )
                        <span class="position-absolute top-50 translate-middle p-1 bg-danger border border-light rounded-circle" style="left: 98%">
                            <span class="visually-hidden">Новые уведомления</span>
                        </span>
                        @endif

                    </a>

                    @if($count > $open_items && $loop->index == 2)
                    <button class="btn btn-light active w-100 text-start border-0 mb-3" id="drop-down">{{ __('Еще ...') }}</button>
                    @endif

                @endforeach

            </div>

        @endauth

        {{-- Footer --}}
        <div class="pt-3">
            <ul class="list-inline lh-1">
                <li class="list-inline-item align-middle">
                    <a href="https://t.me/zloileshii" class="text-decoration-none text-secondary"><small>Связаться с разработчиком</small></a>
                </li>
            </ul>
        </div>

    </div>

</div>

<style>
    .btn:focus {
        box-shadow: none;
    }
</style>