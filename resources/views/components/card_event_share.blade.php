{{-- TODO: данные шарилки нужно переделать таким образом, чтобы динамическим был id, event/user, classes --}}
<button
class="share-link card-icon"
data-bs-trigger="click"
data-bs-toggle="tooltip"
data-bs-placement="left"
data-bs-original-title="Ссылка скопирована"
data-main-uri="https://where-go.ru/event/{{ $id }}">
    <i class="bi bi-reply-fill"></i>
</button>