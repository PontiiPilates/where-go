<div class="mb-5">

    @foreach ( $data as $item)
    {{-- Карточка пользователя --}}
    <a href="/user/{{ $item->id }}" type="button" class="btn position-relative main-light-shadow mb-2 d-block text-start">
        <img src="/public/img/avatars/{{ $item->avatar }}" alt="follwo-avatar" class="rounded-circle me-2 tools-md-avatar">
        <strong class="truncate">{{ Str::limit($item->name, 24) }}</strong>

        {{-- Marker --}}
        @if( in_array($item->id, session('notifications_marks_users')) )
        <span class="position-absolute top-50 translate-middle p-1 bg-danger border border-light rounded-circle" style="left: 95%">
            <span class="visually-hidden">Новые уведомления</span>
        </span>
        @endif
    </a>
    @endforeach

</div>