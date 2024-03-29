<div class="position-relative mb-5">

    <a href="/user/{{ $event->user_id }}" class="d-flex align-items-center text-decoration-none mb-3 text-reset">
        {{-- Аватар --}}
        @if($event->avatar)
        <img src="/public/img/avatars/{{ $event->avatar }}" alt="" width="45" height="45" class="rounded-circle me-2">
        @endif
        {{-- Имя автора события --}}
        <strong>{{ $event->name }}</strong>
    </a>

    <div class="position-absolute top-0 end-0">

        {{-- Закладка авторизованного пользователя --}}
        @auth
            <button class="card-icon bookmark" id="{{ $event->id }}">
                <i class="bi {{ $event->state_bookmark }}"></i>
            </button>
        @endauth

        {{-- Закладка гостя --}}
        @guest
            <a href="/login" class="card-icon bookmark text-reset" id="{{ $event->id }}">
                <i class="bi bi-bookmark"></i>
            </a>
        @endguest

    </div>

    {{-- Заголовок --}}
    <h5 class="mb-0">{{ $event->title }}</h5>

    {{-- Категория --}}
    <a href="/?selector={{ $event->category}}" class="text-reset">
        <small class="text-muted">
            {{ $event->category}}
        </small>
    </a>
    
    {{-- Изображение --}}
    @if($event->preview)
    <img src="/public/img/previews/{{ $event->preview }}" class="img-fluid rounded w-100 mt-3 mb-3" alt="event-image">
    @endif

    {{-- Информация --}}
    <ul class="list-unstyled">

        {{-- Start --}}
        <li><b>Начало:</b> {{ $event->date_start }} {{ $event->time_start ?? '' }}</li>

        {{-- End --}}
        @if($event->date_end)
        <li><b>Окончание:</b>  {{ $event->date_end }} {{ $event->time_end ?? '' }}</li>
        @endif

        {{-- Price --}}
        <li><b>Участие:</b> {{ $event->participant }}</li>

        {{-- Adress --}}
        <li><b>Место встречи:</b> {{ $event->adress }}</li>

    </ul>

    <ul class="list-inline mb-3">

        {{-- Источник --}}
        @if($event->source)
        <p>Источник: <a href="{{ $event->source }}" target="_blanc">{{ $event->source }}</a></p>
        @else

        {{-- Контакты --}}
        <x-section_contacts :phoneChecked="$event->phone_checked" :phone="$event->phone"
            :telegramChecked="$event->telegram_checked" :telegram="$event->telegram" :vkChecked="$event->vk_checked"
            :vk="$event->vk" :whatsappChecked="$event->whatsapp_checked" :whatsapp="$event->whatsapp">
        </x-section_contacts>
        @endif

    </ul>

    {{-- Описание --}}
    <p class="description">{!! $event->description !!}</p>

    <style>
        .description {
            white-space: pre-line;
            /* word-wrap: break-word; */
            /* word-break: break-word; */
        }
    </style>

    <div class="mb-3">

        {{-- Счетчик просмотров --}}
        <span class="card-icon bi bi-eye-fill"> {{ $event->counter + $event->counter_fake }}</span>

        {{-- Счетчик участников для автора события --}}
        @if (Auth::id() == $event->user_id)
        <a href="/run/{{ $event->id }}/users" class="text-reset text-decoration-none">
            <span class="card-icon bi bi-people-fill"> {{ $event->count_goes }}</span>
        </a>
        @endif

        {{-- Счетчик участников для любого другого пользователя --}}
        {{-- @guest
        <span class="card-icon bi bi-people-fill"> {{ $event->count_goes }}</span>
        @endguest --}}

    </div>

    <div class="d-lg-block d-flex justify-content-between gap-3">

        @auth
            @if( $event->run)
                {{-- Отменить участие --}}
                <button id="run" class="btn btn-light border tools-bw-btn flex-fill">Отменить участие</button>
                <x-button_share id="{{ $event->id }}"></x-button_share>
            @elseif(!$event->my)
                {{-- Принять участие --}}
                <button id="run" class="btn btn-warning tools-bw-btn flex-fill">Принять участие</button>
                <x-button_share id="{{ $event->id }}"></x-button_share>
            @elseif($event->my)
                {{-- Редактировать --}}
                <a href="/event/{{ $event->id }}/edit" class="btn btn-light border tools-bw-btn flex-fill">Редактировать</a>
                <x-button_share id="{{ $event->id }}"></x-button_share>
            @endif
        @endauth

        @guest
            <x-button_share class="share-link btn btn-light border tools-bw-btn" id="{{ $event->id }}"></x-button_share>
        @endguest

    </div>

</div>

@auth
    {{-- Модальное окно созданного события --}}
    <x-modal_event_done :id="$event->id"></x-modal_event_done>
@endauth