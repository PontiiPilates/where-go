<!-- Левый сайдбар -->
<div class="sf-container unscroll-container pt-5">
    <div class="sf-content">

        <!-- Боковое меню -->
        <div class="border-bottom pb-3">
            <div><a href="/event/add" class="btn btn-warning w-100 text-start mb-2"><i class="bi bi-plus-circle-fill me-2"></i>Создать событие</a></div>
            <!-- В каждом пункте меню будет проверка на соответствие URL, при нахождении такой, будет присвоен класс active -->
            <div><a href="/g" class="btn btn-light active w-100 border-0 text-start mb-2"><i class="bi bi-view-list me-2"></i>Поток</a></div>
            <div><a href="/bookmarks" class="btn btn-light w-100 border-0 text-start"><i class="bi bi-bookmark-check me-2"></i>Закладки</a></div>
            <div><a href="/run" class="btn btn-light w-100 border-0 text-start"><i class="bi bi-geo me-2"></i>Иду</a></div>
        </div>
        <!-- /Боковое меню -->

        <!-- Фильтр -->
        <div class="border-bottom pt-3 pb-3">
            <form method="" action="">
                <div class="mb-3">
                    <label for="city" class="form-label">Город</label>
                    <select name="city" id="city" class="form-select">
                        <option selected>Красноярск</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Город</label>
                    <select name="category" id="category" class="form-select">
                        <option selected>Развлечения</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="date-start" class="form-label">Искать от даты</label>
                    <input name="date_start" id="date-start" class="form-control" type="date">
                </div>
                <button type="submit" class="btn btn-warning w-100 text-start"><i class="bi bi-search me-2"></i>Искать</button>
            </form>
        </div>
        <!-- /Фильтр -->

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

        <!-- Подписки -->
        <div class="border-bottom pt-3 pb-3 d-flex flex-column gap-2" id="drop-list" style="height: {{ $height }}">

        @if(count($stdVarFavourites) == 0)
        <small class="m-0">Подпишитесь на кого-нибудь</small>
        @endif

            {{-- Это нужно сделать компонентом, поскольку этот фрагмент используется в двух местах --}}

            @foreach ($stdVarFavourites as $item)

            <a href="/user/{{ $item->id }}" class="d-flex align-items-center text-decoration-none text-reset">
                <img src="/public/img/avatars/{{ $item->avatar }}" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>{{ $item->name }}</strong>
            </a>

                @if($loop->index == 0)
                <button class="btn btn-light active w-100 text-start border-0 mb-3" id="drop-down">Еще ...</button>
                @endif

            @endforeach

        </div>
        <!-- /Подписки -->

        <!-- Подвал -->
        <div class="pt-3">
            <ul class="list-inline lh-1">
                <li class="list-inline-item align-middle">
                    <a href="#" class="text-decoration-none text-secondary"><small>Связаться с разработчиком |</small></a>
                </li>
                <li class="list-inline-item align-middle">
                    <a href="#" class="text-decoration-none text-secondary"><small>Помощь |</small></a>
                </li>
                <li class="list-inline-item align-middle">
                    <a href="#" class="text-decoration-none text-secondary"><small>Инвесторам |</small></a>
                </li>
            </ul>
        </div>
        <!-- /Подвал -->

    </div>
</div>
<!-- /Левый сайдбар -->