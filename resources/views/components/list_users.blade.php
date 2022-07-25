<div class="mb-5">


    @foreach ( $data as $item)

    @php
    // // счётчик уведомлений
    // $count_notifications = '';
    // // обход уведомлений
    // foreach (session('notifications')['new_event'] as $k => $v) {
    // // проверка, есть ли уведомления от пользователя
    // if(in_array($item->id, $v)) {
    // // добавление уведомления
    // $count_notifications++;
    // }
    // }
    @endphp

    {{-- Карточка пользователя --}}
    <a href="/user/{{ $item->id }}" type="button" class="btn position-relative main-light-shadow mb-2 d-block text-start">
        <img src="/public/img/avatars/{{ $item->avatar }}" alt="follwo-avatar" class="rounded-circle me-2 tools-md-avatar">
        <strong>{{ Str::limit($item->name, 65) }}</strong>
        @isset ($item->notifications)
            @if ($item->notifications)
            <span class="position-absolute top-50 start-100 translate-middle badge rounded-pill bg-danger">{{ $item->notifications }}</span>
            @endif
        @endisset
    </a>

    @endforeach


</div>