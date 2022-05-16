@php


// очередной костыль, чтобы на главной странице и на странице пользователя выводились разные сообщения об отсутствии событий
if( !collect($events)->all() ) {

    if ( str_starts_with($_SERVER['REQUEST_URI'], '/profile') ) {
        $message = "У вас пока нет ни одного события. <a href='/create/event'>Создать.</a>";
    } else {
        $message = 'По данным параметрам событий не обнаружено';
    }
    if ( str_starts_with($_SERVER['REQUEST_URI'], '/get/bookmarks') ) {
        $message = "У вас пока нет закладок.";
    }
    if ( str_starts_with($_SERVER['REQUEST_URI'], '/past') ) {
        $message = "У пользователя нет прошедших событий.";
    }
}

@endphp

@if ( isset($message) )
<div class="alert alert-info" role="alert"><?= $message ?></div>
@endif

@foreach ($events as $item)

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

        </div>

        <a href="/event/{{ $item->id }}" class="link-dark" style="text-decoration: none;">
            <h5 class="card-title">{{ $item->title }}</h5>
        </a>


        <h6 class="card-subtitle mb-2 text-muted">{{ $item->city }}, {{ $item->adress }}</h6>

        <p class="card-text"><small class="text-muted">{{ mb_strcut($item->date_start, 0, -9) }}</small></p>

    </div>


    <img src="/public/img/previews/{{ $item->preview }}" class="img-fluid" alt="...">

    <div class="card-body">

        @php
        $description = $item->description;
        $short_description = mb_strcut($description, 0, 160);
        @endphp

        <p class="card-text text-short" id="{{$item->id}}">{{ $short_description }} @if( strlen($description) > 160) <span class="link-secondary">... еще</span> @endif </p>

        <p class="card-text" style="display: none;" id="text-long-{{$item->id}}">{{ $item->description }}</p>

        <a href="/profile/{{ $item->user_id }}" class="card-link">{{ $item->name }}</a>

    </div>

</div>

@endforeach


{{-- <!-- Выводить пагинацию только на главной странице --> --}}
@if( Request::url() == 'http://where-go.ru' )
{{ $events->links() }}
@endif

<script src="https://yastatic.net/share2/share.js"></script>