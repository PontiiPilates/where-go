<button id="eventCreateTrigger" type="button" class="btn btn-warning invisible" data-bs-toggle="modal" data-bs-target="#eventCreate">Событие создано</button>

<div class="modal" id="eventCreate" tabindex="-1" aria-labelledby="eventCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered tools-bw-c">
        <div class="modal-content main-strong-shadow border-0">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h5 class="modal-title" id="eventCreateLabel">Событие создано!</h5>
                <p>Поделитесь им с друзьями</p>
                <i class="bi bi-reply-fill"></i>
                <p>https://where-go.ru/event/{{ $id }}</p>
            </div>

            <div class="modal-footer border-0">

                <!-- Поделиться -->
                <button
                    class="share-link btn btn-warning w-100"
                    data-bs-trigger="click"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    data-bs-original-title="Ссылка скопирована"
                    data-main-uri="https://where-go.ru/event/{{ $id }}">
                    Скопировать ссылку
                </button>
                <!-- /Поделиться -->

            </div>
        </div>
    </div>
</div>