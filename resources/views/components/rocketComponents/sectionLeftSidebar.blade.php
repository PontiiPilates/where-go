<!-- Левый сайдбар -->
<div class="sf-container unscroll-container pt-5">
    <div class="sf-content">

        <!-- Боковое меню -->
        <div class="border-bottom pb-3">
            <div><a href="/event/add" class="btn btn-warning w-100 text-start mb-2"><i
                        class="bi bi-plus-circle-fill me-2"></i>Создать событие</a></div>
            <!-- В каждом пункте меню будет проверка на соответствие URL, при нахождении такой, будет присвоен класс active -->
            <div><a href="/" class="btn btn-light active w-100 border-0 text-start mb-2"><i
                        class="bi bi-view-list me-2"></i>Поток</a></div>
            <div><a href="/bookmarks" class="btn btn-light w-100 border-0 text-start"><i
                        class="bi bi-bookmark-check me-2"></i>Закладки</a></div>
            <div><a href="/run" class="btn btn-light w-100 border-0 text-start"><i class="bi bi-geo me-2"></i>Иду</a>
            </div>
        </div>
        <!-- /Боковое меню -->

        <!-- Фильтр -->
        <div class="border-bottom pt-3 pb-3">
            <form method="get" action="">

                {{-- Фильтр по городу --}}
                <div class="mb-3">
                    @php
                    // Просто массив значений
                    $cityes = array(
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
                    <label for="city" class="form-label">Город</label>
                    <select name="city" id="city" class="form-select">
                        <option value="">Не имеет значения</option>
                        @foreach($cityes as $city)
                        @if (Request::input('city') == $city)
                        <option selected value="{{ $city }}">{{ $city }}</option>
                        @else
                        <option value="{{ $city }}">{{ $city }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                {{-- /Фильтр по городу --}}

                {{-- Фильтр по категории --}}
                <div class="mb-3">
                    @php
                    $categories = array(
                    //* Б
                    'Бизнес',
                    //* В
                    'Вечеринка',
                    'Выставка',
                    //* Д
                    'Досуг',
                    //* З
                    'Здоровье',
                    //* И
                    'Игры',
                    'Искусство',
                    //* К
                    'Карьера',
                    'Кино',
                    'Конференция',
                    'Концерт',
                    'Культура',
                    'Курсы',
                    //* Э
                    'Эзотерика',
                    //* М
                    'Мастер-классы',
                    'Музыка',
                    //* Н
                    'Наука',
                    //* О
                    'Общение',
                    'Образование',
                    'Отдых',
                    'Онлайн',
                    //* Р
                    'Развлечения',
                    //* С
                    'Семинар',
                    'Спорт',
                    'Стендап',
                    //* Т
                    'Туризм',
                    //* Х
                    'Хобби',
                    //* Ш
                    'Шоу',
                    //*
                    'Другое',
                    );
                    @endphp
                    <label for="category" class="form-label">Категория</label>
                    <select name="category" id="category" class="form-select">
                        <option value="">Не имеет значения</option>
                        @foreach($categories as $category)
                        @if (Request::input('category') == $category)
                        <option selected value="{{ $category }}">{{ $category }}</option>
                        @else
                        <option value="{{ $category }}">{{ $category }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                {{-- /Фильтр по категории --}}

                {{-- Фильтр по дате --}}
                @php
                $date_start = Request::input('date_start');
                @endphp
                <div class="mb-4">
                    <label for="date-start" class="form-label">
                        {{ __('Искать от даты') }}
                    </label>
                    <input name="date_start" id="date-start" class="form-control" type="date" value="{{ $date_start }}">
                </div>
                {{-- Фильтр по дате --}}

                <button name="filter" value="true" type="submit" class="btn btn-warning w-100 text-start">
                    <i class="bi bi-search me-2"></i>
                    {{ __('Искать') }}
                </button>
            </form>
        </div>
        <!-- /Фильтр -->

        <!-- Подписки -->
        @auth
        @php
        // Высота контейнера по умолчанию
        $height = 'auto';
        // Если количество подписок 5 и более ...
        if(count($stdVarFavourites) >= 1) {
        // То его высота становится фиксированной, а на 5 итерации цикла добавляется кнопка
        // $height = '229px';
        $height = '109px';
        }
        @endphp

        <div class="border-bottom pt-3 pb-3 d-flex flex-column gap-2" id="drop-list" style="height: {{ $height }}">

            @if(count($stdVarFavourites) == 0)
            <small class="m-0">Подпишитесь на кого-нибудь</small>
            @endif

            {{-- Это нужно сделать компонентом, поскольку этот фрагмент используется в двух местах --}}

            @foreach ($stdVarFavourites as $item)

            <a href="/user/{{ $item->id }}" class="d-flex align-items-center text-decoration-none text-reset">
                <img src="/public/img/avatars/{{ $item->avatar }}" alt="" width="32" height="32"
                    class="rounded-circle me-2">
                <strong>{{ $item->name }}</strong>
            </a>

            @if($loop->index == 0)
            <button class="btn btn-light active w-100 text-start border-0 mb-3" id="drop-down">Еще ...</button>
            @endif

            @endforeach

        </div>
        @endauth
        <!-- /Подписки -->

        <!-- Подвал -->
        <div class="pt-3">
            <ul class="list-inline lh-1">
                <li class="list-inline-item align-middle">
                    <a href="#" class="text-decoration-none text-secondary"><small>Как тут заработать?</small></a>
                </li>
                <li class="list-inline-item align-middle">
                    <a href="#" class="text-decoration-none text-secondary"><small>Связаться с разработчиком</small></a>
                </li>
            </ul>
        </div>
        <!-- /Подвал -->

    </div>
</div>
<!-- /Левый сайдбар -->