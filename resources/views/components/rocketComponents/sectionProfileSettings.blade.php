<!-- Меню профиля -->
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link text-reset me-2 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Профиль</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link text-reset me-2" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Пароль</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link text-reset" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Почта</button>
    </li>
</ul>
<!-- /Меню профиля -->



<!-- Настройки профиля -->
<div class="tab-content mb-5" id="pills-tabContent">

    <!-- Форма редактирования профилья -->
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <form>
            <img src="/public/img/previews/2021_12_25__04_24_30__wsapy.jpeg" class="rounded w-50 mb-3" alt="image">
            <div class="mb-3">
                <label for="create-preview" class="form-label">Изображение</label>
                <input name="create_preview" type="file" class="form-control" id="create-preview">
            </div>
            <div class="mb-3">
                <label for="create-description" class="form-label">О себе</label>
                <textarea name="create_description" class="form-control " id="create-description" cols="30" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="create-city" class="form-label">Город</label>
                <select name="create_city" id="create-city" class="form-select" aria-label="Default select example">
                    <option selected>Красноярск</option>
                    <option value="1">Абакан</option>
                    <option value="2">Дивногорск</option>
                    <option value="3">Магнитогорск</option>
                </select>
            </div>
            <label for="phone" class="form-label">Номер телефона</label>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <input name="phone_checked" class="form-check-input mt-0 " type="checkbox" value="1" checked="">
                </div>
                <input name="phone" type="tel" class="form-control " id="phone" value="" placeholder="+79999999999" pattern="(\+7)[0-9]{10}">
            </div>
            <label for="telegram" class="form-label">Telegram</label>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <input name="telegram_checked" class="form-check-input mt-0 " type="checkbox" value="1" checked="">
                </div>
                <input name="telegram" type="text" class="form-control " id="telegram" value="" placeholder="userName">
            </div>
            <label for="vk" class="form-label">Vkontakte</label>
            <div class="input-group mb-4">
                <div class="input-group-text">
                    <input name="vk_checked" class="form-check-input mt-0 " type="checkbox" value="1" checked="">
                </div>
                <input name="vk" type="text" class="form-control " id="vk" value="" placeholder="userName">
            </div>
            <div class="d-lg-block d-flex">
                <button type="submit" class="btn btn-warning flex-fill tools-bw-btn">Сохранить</button>
            </div>
        </form>
    </div>
    <!-- /Форма редактирования профиля -->



    <!-- Форма смены пароля -->
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <form>
            <div class="mb-3">
                <label for="current_password" class="form-label">Текущий пароль</label>
                <input name="current_password" type="password" class="form-control " id="current_password">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Новый пароль</label>
                <input name="password_confirmation" type="password" class="form-control " id="password_confirmation">
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Подтверждение пароля</label>
                <input name="password" type="password" class="form-control " id="password">
            </div>
            <div class="d-lg-block d-flex">
                <button type="submit" class="btn btn-warning flex-fill tools-bw-btn">Изменить пароль</button>
            </div>
        </form>
    </div>
    <!-- /Форма смены пароля -->



    <!-- Форма смены почты -->
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <form>
            <div class="mb-4">
                <label for="current_password" class="form-label">Email</label>
                <input name="current_password" type="password" class="form-control " id="current_password">
            </div>
            <div class="d-lg-block d-flex">
                <button type="submit" class="btn btn-warning flex-fill tools-bw-btn">Изменить Email</button>
            </div>
        </form>
    </div>
    <!-- /Форма смены почты -->

</div>
<!-- /Настройки профиля -->