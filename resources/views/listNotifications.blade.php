{{-- Layout --}}
<x-layout :localstorage="$localstorage">

  @if ( count(session('notifications_unread')) )
  <ul class="list-unstyled p-0">
    @foreach (session('notifications_unread') as $notification)
    <li>
      <a href="/event/{{ $notification->data['event'] }}" class="btn main-light-shadow mb-2 text-start d-flex gap-2">
        <img src="/public/img/avatars/{{ $notification->data['avatar'] }}" alt="follwo-avatar" class="rounded-circle me-2 tools-md-avatar">
        <div>
          <strong class="truncate">{{ Str::limit($notification->data['name'], 24) }}</strong>
          <small class="d-block">добавление нового события</small>
        </div>
      </a>
    </li>
    @endforeach
  </ul>
  @else
  <div class="alert alert-secondary" role="alert">
    У вас нет уведомлений
  </div>
  @endif

</x-layout>