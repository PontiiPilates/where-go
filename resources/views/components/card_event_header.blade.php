<a href="/user/{{ $item->user_id }}" class="d-flex align-items-center text-decoration-none mb-3 text-reset">

    @if($item->avatar)
    <img src="/public/img/avatars/{{ $item->avatar }}" alt="image-profile" width="45" height="45" class="rounded-circle me-2">
    @endif

    <strong>{{ $item->name }}</strong>
</a>

@auth
<div class="position-absolute top-0 end-0">
    <button class="card-icon bookmark" id="{{ $item->id }}">
        <i class="bi {{ $item->state_bookmark }}"></i>
    </button>
</div>
@endauth

@guest
<div class="position-absolute top-0 end-0">
    <a href="/login" class="card-icon bookmark text-reset">
        <i class="bi bi-bookmark"></i>
    </a>
</div>
@endguest