<!DOCTYPE html>
<html lang="ru">

<head>
    <x-rocketComponents.head></x-rocketComponents.head>
</head>

<body>

    <!-- container-fluid - обеспечивает контроль по всей ширине окна -->
    <!-- content-container - обеспечивает ограничение области контента до 960px -->
    <!-- row - обеспечивает непосредственное управление трансформациями колонок -->




    <!-- Header desctop -->
    <div class="container-fluid d-none d-lg-block main-light-shadow fixed-top bg-white">
        <div class="container-content">
            <div class="row navbar navbar-light" style="height: 70px;">

                <!-- Лого и слоган -->
                <div class="col" style="padding-left: 16px;">
                    <a href="#" class="navbar-brand lh-1">
                        <strong>Найди событие по душе</strong><br>
                        <small>или создай своё</small>
                    </a>
                </div>
                <!-- /Лого и слоган -->
                {{ $title }}

                <!-- Профиль -->
                <div class="col position-relative text-end">
                    <div class="btn-group">
                        <button type="button" class="btn btn-light border rounded d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>
                                {{ $slot }}
                            </strong>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Профиль</a></li>
                            <li><a class="dropdown-item" href="#">Настройки</a></li>
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="#">Выйти</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /Профиль -->

            </div>
        </div>
    </div>
    <!--/Header desctop -->



    <!-- Header mobile -->
    <div class="container-fluid d-lg-none main-light-shadow fixed-top bg-white">
        <div class="navbar navbar-light d-flex justify-content-between flex-nowrap" style="height: 70px;">
            <!-- В каждом пункте меню будет проверка на соответствие URL, при нахождении такой, будет присвоен класс active-navigation-element -->
            <a href="" class="text-center text-reset text-decoration-none active-navigation-element"><i class="bi bi-view-list"></i><br><small>Поток</small></a>
            <a href="" class="text-center text-reset text-decoration-none"><i class="bi bi-check-lg"></i><br><small>Подписки</small></a>
            <a href="" class="text-center text-reset text-decoration-none"><i class="bi bi-plus-circle-fill"></i><br><small>Создать</small></a>
            <a href="" class="text-center text-reset text-decoration-none"><i class="bi bi-bookmark-check"></i><br><small>Закладки</small></a>
            <a href="" class="text-center text-reset text-decoration-none"><i class="bi bi-person"></i><br><small>Профиль</small></a>
        </div>
    </div>
    <!-- /Header mobile -->



    <!-- Контент -->
    <div class="container-fluid">
        <div class="container-content">
            <div class="row" style="margin-top: 70px;">

                <!-- Левый сайдбар -->
                <div class="sf-rail col-lg-3 d-none d-lg-block">
                    <div class="sf-container unscroll-container pt-5">
                        <div class="sf-content">

                            <!-- Боковое меню -->
                            <div class="border-bottom pb-3">
                                <div><a href="#" class="btn btn-warning w-100 text-start mb-2"><i class="bi bi-plus-circle-fill me-2"></i>Создать событие</a></div>
                                <!-- В каждом пункте меню будет проверка на соответствие URL, при нахождении такой, будет присвоен класс active -->
                                <div><a href="#" class="btn btn-light active w-100 border-0 text-start mb-2"><i class="bi bi-view-list me-2"></i>Поток</a></div>
                                <div><a href="#" class="btn btn-light w-100 border-0 text-start"><i class="bi bi-bookmark-check me-2"></i>Закладки</a></div>
                            </div>
                            <!-- /Боковое меню -->

                            <!-- Фильтр -->
                            <div class="border-bottom pt-3 pb-3">
                                <form method="" action="">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">Город</label>
                                        <select name="city" id="city" class="form-select">
                                            <option selected>Красноярск</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Город</label>
                                        <select name="category" id="category" class="form-select">
                                            <option selected>Развлечения</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="date-start" class="form-label">Искать от даты</label>
                                        <input name="date_start" id="date-start" class="form-control" type="date">
                                    </div>
                                    <button type="submit" class="btn btn-warning w-100 text-start"><i class="bi bi-search me-2"></i>Искать</button>
                                </form>
                            </div>
                            <!-- /Фильтр -->

                            <!-- Подписки -->
                            <!-- Если элементов больше 10 например, то передаем id="drop-list" -->
                            <div class="border-bottom pt-3 pb-3 d-flex flex-column gap-2" id="drop-list">
                                <a href="#" class="d-flex align-items-center text-decoration-none text-reset">
                                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                                    <strong>mdo</strong>
                                </a>
                                <button class="btn btn-light w-100 text-start border-0 mb-3" id="drop-down">Еще ...</button>
                                <a href="#" class="d-flex align-items-center text-decoration-none text-reset">
                                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                                    <strong>mdo</strong>
                                </a>
                                <a href="#" class="d-flex align-items-center text-decoration-none text-reset">
                                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                                    <strong>mdo</strong>
                                </a>
                                <a href="#" class="d-flex align-items-center text-decoration-none text-reset">
                                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                                    <strong>mdo</strong>
                                </a>
                                <a href="#" class="d-flex align-items-center text-decoration-none text-reset">
                                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                                    <strong>mdo</strong>
                                </a>
                            </div>
                            <!-- /Подписки -->

                            <!-- Подвал -->
                            <div class="pt-3">
                                <ul class="list-inline lh-1">
                                    <li class="list-inline-item align-middle">
                                        <a href="#" class="text-decoration-none text-secondary"><small>Связаться с разработчиком |</small></a>
                                    </li>
                                    <li class="list-inline-item align-middle">
                                        <a href="#" class="text-decoration-none text-secondary"><small>Помощь |</small></a>
                                    </li>
                                    <li class="list-inline-item align-middle">
                                        <a href="#" class="text-decoration-none text-secondary"><small>Инвесторам |</small></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /Подвал -->

                        </div>
                    </div>
                </div>
                <!-- /Левый сайдбар -->



                <!-- Разделитель колонок -->
                <div class="col-1 d-none d-lg-block"></div>
                <!-- /Разделитель колонок -->



                <!-- Правая колонка -->
                <div class="col col-lg-8 pt-5">

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



                    <!-- Форма создания события -->
                    <form class="mb-5">
                        <div class="mb-3">
                            <label for="create-name" class="form-label">Название</label>
                            <input name="create_name" type="email" class="form-control" id="create-name">
                        </div>

                        <div class="mb-3">
                            <label for="create-description" class="form-label">Описание</label>
                            <textarea name="create_description" class="form-control " id="create-description" cols="30" rows="5"></textarea>
                        </div>

                        <img src="/public/img/previews/2021_12_25__04_24_30__wsapy.jpeg" class="rounded w-50 mb-3" alt="image">

                        <div class="mb-3">
                            <label for="create-preview" class="form-label">Изображение</label>
                            <input name="create_preview" type="file" class="form-control" id="create-preview">
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

                        <div class="mb-3">
                            <label for="create-category" class="form-label">Категория</label>
                            <select name="create_category" id="create-category" class="form-select" aria-label="Default select example">
                                <option selected>Развлечения</option>
                                <option value="1">Карьера</option>
                                <option value="2">Спорт</option>
                                <option value="3">Отдых</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="create-date-start" class="form-label">Дата начала</label>
                                <input name="create-date_start" type="date" class="form-control " id="create-date-start" value="">
                            </div>
                            <div class="col mb-3">
                                <label for="create-time-start" class="form-label">Время начала</label>
                                <input name="create_time_start" type="time" class="form-control " id="create-time-start" value="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="create-date-end" class="form-label">Дата окончания</label>
                                <input name="create_date_end" type="date" class="form-control " id="create-date-end" value="">
                            </div>
                            <div class="col mb-3">
                                <label for="create-time-end" class="form-label">Время окончания</label>
                                <input name="create_time_end" type="time" class="form-control " id="create-time-end" value="">
                            </div>
                        </div>

                        <div class="form-check form-check-inline mb-3">
                            <input class="form-check-input r-f-free " type="radio" name="create_price_type" id="free" value="free" checked="">
                            <label class="form-check-label" for="free">Бесплатно</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input r-f-donate " type="radio" name="create_price_type" id="donate" value="donate">
                            <label class="form-check-label" for="donate">Донат</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input r-f-price " type="radio" name="create_price_type" id="price" value="price">
                            <label class="form-check-label" for="price">Цена</label>
                        </div>

                        <div class="mb-4">
                            <input name="cost" type="number" class="form-control r-f-cost " id="cost" value="" placeholder="Цена в руб." disabled="">
                        </div>

                        <div class="form-check mb-4">
                            <input name="witness" class="form-check-input" type="checkbox" value="1" id="witness">
                            <label class="form-check-label" for="witness">Свидетель события</label>
                        </div>

                        <div class="d-flex justify-content-between gap-3">
                            <button type="submit" class="btn btn-warning flex-fill">Сохранить</button>
                            <a href="#" class="btn btn-light border flex-fill">Удалить</a>
                        </div>
                    </form>
                    <!-- /Форма создания события -->



                    <!-- Профиль -->
                    <div class="mb-5">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="left-column d-flex flex-column justify-content-between">
                                <h5 class="card-title text-truncate mb-0">Reality of Zagurskii</h5>
                                <div>
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <img class="tools-bs-social" src="/public/img/social_icons/Telegram.svg">
                                        </li>
                                        <li class="list-inline-item">
                                            <img class="tools-bs-social" src="/public/img/social_icons/Instagram.svg">
                                        </li>
                                        <li class="list-inline-item">
                                            <img class="tools-bs-social" src="/public/img/social_icons/VK.svg">
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex gap-3">
                                    <div>
                                        <strong class="d-block m-0 p-0 lh-1 fs-5">16</strong>
                                        <small class="d-block m-0 p-0 lh-1 text-secondary">подписчиков</small>
                                    </div>
                                    <div>
                                        <strong class="d-block m-0 p-0 lh-1 fs-5">16</strong>
                                        <small class="d-block m-0 p-0 lh-1 text-secondary">подписчиков</small>
                                    </div>
                                </div>
                            </div>
                            <div class="right-column">
                                <img src="https://github.com/mdo.png" alt="image-profile" width="120" height="120" class="rounded-circle">
                            </div>
                        </div>
                        <div class="mb-4">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe expedita, asperiores quos ullam fugiat culpa mollitia a voluptate repellat amet vitae aliquam laboriosam est animi quo quaerat nostrum autem. Voluptatum.</p>
                        </div>
                        <div class="d-lg-block d-flex justify-content-between gap-3">
                            <button class="btn btn-light border tools-bw-btn flex-fill">Редактировать</button>
                            <!-- <button class="btn btn-warning tools-bw-btn flex-fill">Подписаться</button> -->
                            <button class="btn btn-light border ms-lg-3" id="share-profile" data-bs-trigger="click" data-bs-toggle="tooltip" data-bs-placement="left" title="Ссылка скопирована" data-bs-original-title="Ссылка скопирована" data-main-uri="https://where-go.ru/profile/444"><i class="bi bi-reply-fill"></i></button>
                        </div>
                    </div>
                    <!-- /Профиль -->



                    <!-- Карточка -->
                    <div class="card mb-3 main-light-shadow border-white postiton-relative">
                        <div class="row p-1 g-3">

                            <!-- Левая колонка / верхняя строка -->
                            <div class="col col-lg-6" style="min-width: 300px;">

                                <!-- Блок для мобильной версии -->
                                <div class="d-block d-sm-none position-relative p-0 mb-3">

                                    <!-- Автор -->
                                    <a href="#" class="d-flex align-items-center text-decoration-none text-reset">
                                        <img src="https://github.com/mdo.png" alt="image-profile" width="45" height="45" class="rounded-circle me-2">
                                        <strong>Reality of Zagursky</strong>
                                    </a>
                                    <!-- /Автор -->

                                    <!-- Закладка -->
                                    <div class="position-absolute top-0 end-0">
                                        <!-- <i class="card-icon bi bi-bookmark-fill"></i> -->
                                        <i class="card-icon bi bi-bookmark"></i>
                                    </div>
                                    <!-- /Закладка -->

                                </div>
                                <!-- /Блок для мобильной версии -->

                                <!-- Изображение -->
                                <img src="/public/img/previews/2021_12_25__04_24_30__wsapy.jpeg" class="img-fluid rounded" alt="image-event">
                                <!-- /Изображение -->

                            </div>
                            <!-- /Левая колонка / верхняя строка -->

                            <!-- Правая колонка / нижняя строка -->
                            <div class="col col-lg-6" style="min-width: 300px;">
                                <div class="card-body position-relative h-100 p-0 pb-3">

                                    <!-- Блок для десктопной версии -->
                                    <div class="d-none d-sm-block position-relative">

                                        <!-- Автор -->
                                        <a href="#" class="d-flex align-items-center text-decoration-none mb-3 text-reset">
                                            <img src="https://github.com/mdo.png" alt="image-profile" width="45" height="45" class="rounded-circle me-2">
                                            <strong>Reality of Zagursky</strong>
                                        </a>
                                        <!-- /Автор -->

                                        <!-- Закладка -->
                                        <div class="position-absolute top-0 end-0">
                                            <!-- <i class="card-icon bi bi-bookmark-fill"></i> -->
                                            <i class="card-icon bi bi-bookmark"></i>
                                        </div>
                                        <!-- /Закладка -->

                                    </div>
                                    <!-- /Блок для десктопной версии -->

                                    <!-- Заголовок -->
                                    <h5 class="card-title text-truncate mb-0">Заголовок карточки</h5>
                                    <!-- /Заголовок -->

                                    <!-- Категория -->
                                    <p class="card-text"><small class="text-muted">Развлечения | Бизнес</small></p>
                                    <!-- /Категория -->

                                    <!-- Информация -->
                                    <ul class="list-unstyled">
                                        <li>2 февраля в 19:00</li>
                                        <li>г. Красноярск, ул. Высотная, стр. 1</li>
                                        <li>Вход: бесплатно</li>
                                    </ul>
                                    <!-- /Информация -->

                                    <!-- Статистика -->
                                    <div class="position-absolute bottom-0">
                                        <span class="card-icon bi bi-eye-fill"> 562</span>
                                        <span class="card-icon bi bi-people-fill"> 25</span>
                                    </div>
                                    <!-- /Статистика -->

                                    <!-- Поделиться -->
                                    <div class="position-absolute bottom-0 end-0">
                                        <button class="card-icon" id="share-event-card" data-bs-trigger="click" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="Ссылка скопирована" data-main-uri="https://where-go.ru/profile/8765">
                                            <i class="bi bi-reply-fill"></i>
                                        </button>
                                    </div>
                                    <!-- /Поделиться -->

                                </div>
                            </div>
                            <!-- /Правая колонка / нижняя строка -->

                        </div>
                        <!-- Фон прошедшего события -->
                        <div class="position-absolute top-0 bottom-0 start-0 end-0 bg-white opacity-75"></div>
                        <!-- /Фон прошедшего события -->

                        <!-- Обозначение прошедшего события -->
                        <div class="position-absolute top-50 start-50 translate-middle bg-white rounded-circle opacity-100 main-strong-shadow d-flex flex-column justify-content-center align-items-center gap-2" style="height: 120px; width: 120px;">
                            <div><i class="bi bi-hourglass-bottom"></i></div>
                            <div class="text-center">Событие окончено</div>
                        </div>
                        <!-- /Обозначение прошедшего события -->

                    </div>
                    <!-- /Карточка -->



                    <!-- Страница события -->
                    <div class="position-relative mb-5">

                        <!-- Автор -->
                        <a href="#" class="d-flex align-items-center text-decoration-none mb-3 text-reset">
                            <img src="https://github.com/mdo.png" alt="" width="45" height="45" class="rounded-circle me-2">
                            <strong>Reality of Zagursky</strong>
                        </a>
                        <!-- /Автор -->

                        <!-- Закладка -->
                        <div class="position-absolute top-0 end-0">
                            <!-- <i class="card-icon bi bi-bookmark-fill"></i> -->
                            <i class="card-icon bi bi-bookmark"></i>
                        </div>
                        <!-- /Закладка -->

                        <!-- Заголовок -->
                        <h5 class="mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magni error, deserunt corporis labore consequuntur laborum architecto quia laboriosam delectus ratione nulla. Exercitationem ea ex doloremque eum excepturi cupiditate, maiores iusto.</h5>
                        <!-- /Заголовок -->

                        <!-- Категория -->
                        <p><small class="text-muted">Развлечения | Бизнес</small></p>
                        <!-- /Категория -->

                        <!-- Изображение -->
                        <img src="/public/img/previews/2021_12_25__04_24_30__wsapy.jpeg" class="img-fluid rounded w-100 mb-3" alt="event-image">
                        <!-- /Изображение -->

                        <!-- Информация -->
                        <ul class="list-unstyled">
                            <li>2 февраля в 19:00</li>
                            <li>г. Красноярск, ул. Высотная, стр. 1</li>
                            <li>Вход: бесплатно</li>
                        </ul>
                        <!-- /Информация -->

                        <!-- Связаться -->
                        <ul class="list-inline mb-3">
                            <li class="list-inline-item">
                                <img class="tools-bs-social" src="/public/img/social_icons/Telegram.svg">
                            </li>
                            <li class="list-inline-item">
                                <img class="tools-bs-social" src="/public/img/social_icons/Instagram.svg">
                            </li>
                            <li class="list-inline-item">
                                <img class="tools-bs-social" src="/public/img/social_icons/VK.svg">
                            </li>
                        </ul>
                        <!-- /Связаться -->

                        <!-- Описание -->
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores mollitia nemo aperiam et blanditiis fuga quos sint a dolorum voluptatibus porro, quae enim laborum rem eligendi perspiciatis non numquam expedita?</p>
                        <!-- /Описание -->

                        <!-- Статистика -->
                        <div class="mb-3">
                            <span class="card-icon bi bi-eye-fill"> 562</span>
                            <span class="card-icon bi bi-people-fill"> 25</span>
                        </div>
                        <!-- /Статистика -->

                        <!-- Действия -->
                        <div class="d-lg-block d-flex justify-content-between gap-3">
                            <button class="btn btn-warning tools-bw-btn flex-fill">Принять участие</button>
                            <button class="btn btn-light border ms-lg-3" id="share-event-page" data-bs-trigger="click" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="Ссылка скопирована" data-main-uri="https://where-go.ru/event/555"><i class="bi bi-reply-fill"></i></button>
                        </div>
                        <!-- /Действия -->

                    </div>
                    <!-- /Страница события -->



                    <!-- Лист подписок -->
                    <div class="mb-5">
                        <div class="follow main-light-shadow rounded p-2 mb-2 d-flex align-items-center">
                            <img src="https://github.com/mdo.png" alt="follwo-avatar" class="rounded-circle me-2 tools-md-avatar">
                            <strong>Reality of Zagursky</strong>
                        </div>
                        <div class="follow main-light-shadow rounded p-2 mb-2 d-flex align-items-center">
                            <img src="https://github.com/mdo.png" alt="follwo-avatar" class="rounded-circle me-2 tools-md-avatar">
                            <strong>Reality of Zagursky</strong>
                        </div>
                        <div class="follow main-light-shadow rounded p-2 mb-2 d-flex align-items-center">
                            <img src="https://github.com/mdo.png" alt="follwo-avatar" class="rounded-circle me-2 tools-md-avatar">
                            <strong>Reality of Zagursky</strong>
                        </div>
                    </div>
                    <!-- /Лист подписок -->



                    <!-- Фильтр -->
                    <div class="mt-3 mb-5 d-lg-none">
                        <form>
                            <div class="mb-3">
                                <label for="city" class="form-label">Город</label>
                                <select name="city" id="city" class="form-select">
                                    <option selected>Красноярск</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Город</label>
                                <select name="category" id="category" class="form-select">
                                    <option selected>Развлечения</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="date-start" class="form-label">Искать от даты</label>
                                <input name="date_start" id="date-start" class="form-control" type="date">
                            </div>
                            <button type="submit" class="btn btn-warning w-100 text-center"><i class="bi bi-search me-2"></i>Искать</button>
                        </form>
                    </div>
                    <!-- /Фильтр -->

                </div>
                <!-- /Правая колонка -->

            </div>



            <!-- Блок прокрутки в разработке -->
            <!-- <div class="container-fluid fixed-bottom" id="to-top" style="display: none;">
                <div class="container-content">
                    <div class="row" style="height: 0px;">
                        <div class="col-lg-3 d-none d-lg-block"></div>
                        <div class="col-lg-1 d-none d-lg-block"></div>
                        <div class="col-lg-8 position-relative">
                            <div class="position-absolute start-50 translate-middle" id=""></div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                #to-top {
                    width: 100px;
                    height: 100px;
                    background: pink;
                    bottom: 100px;
                }
            </style>

            <script>
                // Контейнер для значения высоты
                var maxHeight = 0;
                var luftToTop = 600;
                var luftToBottom = 300;

                // Запуск события при скролле
                $(window).scroll(function() {

                    // Текущая позиция
                    var currentScroll = $(this).scrollTop();

                    // Если текущая позиция больше значения в контейнере, то значение обновляется
                    if (currentScroll > maxHeight) {
                        maxHeight = currentScroll;
                    }

                    if (currentScroll < (maxHeight - luftToTop)) {
                        console.log('show');
                        $('#to-top').show();
                    }

                    if (currentScroll > (maxHeight - luftToBottom)) {
                        console.log('show');
                        $('#to-top').hide();
                    }

                    console.log(maxHeight - luftToTop);
                })
            </script> -->
            <!-- Блок прокрутки в разработке -->

        </div>
    </div>
    <!-- /Контент -->



    <!-- Форма авторизации -->
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="tools-bw-c">
            <p class="mb-3">Еще нет аккаунта? <a href="">Зарегистрируйтесь!</a></p>
            <form method="" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input name="password" type="password" class="form-control" id="password">
                </div>
                <p class="mb-5"><a href="/forgot-password">Забыли пароль?</a></p>
                <div>
                    <button type="submit" class="btn btn-warning w-100">Войти</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Форма авторизации -->



    <!-- Форма регистрации -->
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="tools-bw-c">
            <p class="mb-3">Уже есть аккаунт? <a href="">Войдите!</a></p>
            <form method="" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Никнейм</label>
                    <input name="email" type="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input name="password" type="password" class="form-control" id="password">
                </div>
                <div class="mb-5">
                    <label for="password" class="form-label">Подтверждение пароля</label>
                    <input name="password" type="password" class="form-control" id="password">
                </div>
                <div>
                    <button type="submit" class="btn btn-warning w-100">Регистрация</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Форма регистрации -->



    <!-- Форма восстановления пароля -->
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="tools-bw-c">
            <p class="mb-3">Забыли пароль? Не проблема. Просто сообщите нам свой адрес электронной почты, и мы пришлём ссылку для сброса пароля, которая позволит вам выбрать новый.</p>
            <p class="mb-3">Вспомнили пароль? <a href="">Войдите!</a></p>
            <form method="" action="">
                <div class="mb-5">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email">
                </div>
                <div>
                    <button type="submit" class="btn btn-warning w-100">Сбросить пароль</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Форма восстановления пароля -->



    <!-- Модальное окно созданного события -->
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">

        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#eventCreate">Событие создано</button>

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
                        <p>https://where-go.ru/event/10</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-warning w-100" id="share-event-modal" data-bs-trigger="click" data-bs-toggle="tooltip" data-bs-placement="top" title="Ссылка скопирована" data-bs-original-title="Ссылка скопирована" data-main-uri="https://where-go.ru/event/10">
                            Копировать ссылку
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Модальное окно созданного события -->



    <!-- Модальное окно подтверждения действия -->
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">

        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#actionConfirm">Подтвердите действие</button>

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
                            <button class="btn btn-warning flex-fill">Ой, я нечаяно</button>
                            <a href="#" class="btn btn-light border flex-fill">Да</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Модальное окно подтверждения действия -->



    <!-- 404 -->
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">

        <div class="text-center tools-bw-c">
            <h5>Что-то пошло не так!</h5>
            <p class="mb-5">Попробуйте еще раз. Если ошибка повторится, то опишите ее разработчику.</p>
            <div class="d-flex justify-content-between gap-3 w-100">
                <a href="#" class="btn btn-warning flex-fill">На главную</a>
                <a href="#" class="btn btn-light border flex-fill">К разработчику</a>
            </div>
        </div>

    </div>
    <!-- /404 -->


    <!-- Scripts -->
    <script src="/resources/js/costField.js"></script>
    <script src="/resources/js/openList.js"></script>
    <script src="/resources/js/addPoppers.js"></script>
    <script src="/resources/js/fork.js"></script>
    <!-- /Scripts -->

</body>

</html>