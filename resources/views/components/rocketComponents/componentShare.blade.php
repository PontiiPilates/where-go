{{-- TODO: данные шарилки нужно переделать таким образом, чтобы динамическим был id, event/user, classes --}}

<button {{ $attributes }}
    class="share-link btn btn-light border ms-lg-3"
    data-bs-trigger="click"
    data-bs-toggle="tooltip"
    data-bs-placement="left"
    title="Ссылка скопирована"
    data-bs-original-title="Ссылка скопирована"
    data-main-uri="https://where-go.ru/user/{{ $id }}">
        <i class="bi bi-reply-fill"></i>
</button>