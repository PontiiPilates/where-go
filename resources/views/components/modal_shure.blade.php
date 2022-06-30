<!-- <div class="container-fluid vh-100 d-flex justify-content-center align-items-center"> -->

    <!-- <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#actionConfirm">Подтвердите действие</button> -->

    <div class="modal" id="actionConfirm" tabindex="-1" aria-labelledby="actionConfirmLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered tools-bw-c">
            <div class="modal-content main-strong-shadow border-0">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="modal-title" id="actionConfirmLabel">Вы действительно этого хотите?</h5>
                </div>
                <div class="modal-footer border-0">
                    <div class="d-flex justify-content-between gap-3 mb-3 w-100">
                        <button type="button" class=" btn btn-warning flex-fill" data-bs-dismiss="modal" aria-label="Close">Ой, я нечаяно</button>
                        <a href="/event/{{ $id }}/remove" class="btn btn-light border flex-fill">Да</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- </div> -->