<!-- Лист подписок -->

<div class="mb-5">

    @foreach ($stdVarFavourites as $item)

    <a href="/user/{{ $item->id }}" class="text-reset text-decoration-none">
        <div class="follow main-light-shadow rounded p-2 mb-2 d-flex align-items-center">
            <img src="/public/img/avatars/{{ $item->avatar }}" alt="follwo-avatar" class="rounded-circle me-2 tools-md-avatar">
            <strong>{{ $item->name }}</strong>
        </div>
    </a>

    @endforeach

</div>
<!-- /Лист подписок -->