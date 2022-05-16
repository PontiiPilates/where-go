<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Where-go</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- /bootstrap -->

    <!-- styles -->
    <link rel="stylesheet" href="/resources/css/style.css">
    <!-- /styles -->

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <!-- /icons -->

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(70201489, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>

    <noscript>
        <div><img src="https://mc.yandex.ru/watch/70201489" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->

    <!-- jq -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- /jq -->

    {{-- Фавиконка --}}
    <link rel="icon" href="/public/favicon.png" type="image/png">

</head>

<body>

    {{-- <!-- Навигация для одной колонки --> --}}
    <div class="container-fluid sticky-top d-lg-none">
        <div class="row">
            <x-project.navigationMobile>
            </x-project.navigationMobile>
        </div>
    </div>

    {{-- <!-- Хайлайтер --> --}}
    <div class="navbar navbar-dark bg-primary sticky-top mb-3 d-none d-lg-block p-3">
        <div class="container-fluid align-self-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <span class="navbar-text">
                            <a class="navbar-brand" href="/">
                                Navbar text with an inline element
                                {{-- Найди событие по душе, создай своё или расскажи всем про событие о котором узнал! --}}
                            </a>
                        </span>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Страница --> --}}
    <div class="container mb-5">
        <div class="row position-relative">
            {{ $slot }}
        </div>
    </div>


    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- /bootstrap -->

</body>

</html>

{{-- <!-- Доработка яндекс-поделиться --> --}}
<style>
    .ya-share2__item_more.ya-share2__item_has-pretty-view .ya-share2__icon_more {
        background-image: url(/public/img/icons/Share.svg);
        background-size: 16px 16px;
        width: 16px;
        height: 16px;
    }

    .ya-share2__item_more.ya-share2__item_has-pretty-view .ya-share2__badge_more {
        background-color: transparent;
    }

    .ya-share2__container_size_s .ya-share2__item_more.ya-share2__item_has-pretty-view .ya-share2__link_more.ya-share2__link_more-button-type_short {
        background-color: transparent;
        padding: 0;
        /* padding-right: 12px; */
    }

    .ya-share2__container_shape_round .ya-share2__badge {
        border-radius: 0;
    }
</style>

{{-- <!-- Реализация функции: "читать дальше" --> --}}
<script>
    // улавливаем клик по элементу
    $('.text-short').bind('click', function() {

        // и сразу скрываем его
        $(this).hide();

        // запоминаем его идентификатор
        id = $(this).attr('id');

        // ранее скрытый на уровне вёрстки текстовый блок - показываем
        $('#text-long-' + id).show();

    });
</script>

{{-- <!-- Реализация функции "закладки"  --> --}}
<script>
    // Определение элемента
    bookmark = $('.bookmark');

    // Работа с тем элементом, по которому произошел клик
    bookmark.bind('click', function() {

        // Если элемент класса: .bi-bookmark
        if ($(this).is('.bi-bookmark')) {

            // Извлечение идентификатора
            id = $(this).attr('id');

            // Для передачи этого элемента вглубь функций
            bookmark = $(this);

            // Отправка запроса
            $.ajax({
                type: "GET",
                url: "/add/bookmarks/" + id,
                // data: { name: "John", location: "Boston" }
            }).done(function(msg) {
                // Изменение состояния интерфейса
                bookmark.removeClass("bi-bookmark").addClass("bi-bookmark-check-fill");
            });

        }

        // Если элемент класса: .bi-bookmark-check-fill
        if ($(this).is('.bi-bookmark-check-fill')) {

            // Извлечение идентификатора
            id = $(this).attr('id');

            // Для передачи этого элемента вглубь функций
            bookmark = $(this);

            // Отправка запроса
            $.ajax({
                type: "GET",
                url: "/remove/bookmarks/" + id,
                // data: { name: "John", location: "Boston" }
            }).done(function(msg) {
                // Изменение состояния интерфейса
                bookmark.removeClass("bi-bookmark-check-fill").addClass("bi-bookmark");
            });
        }

    });
</script>

<script>
    /**
     * Изменение интерфейса в соответствии с добавлением / удалением
     */
    function add_remoover(element, element_fill, element_empty, add_path, remove_path) {

        // Помощник в функции
        dot = '.'

        // Работа с тем элементом, по которому произошел клик
        $(dot + element).bind('click', function() {

            // Если элемент активный
            if ($(this).is(dot + element_fill)) {

                // Получение идентификатора пользователя
                id = $(this).attr('id');

                // Для передачи элемента в ajax-функцию
                element_depth = $(this);

                $.ajax({
                    type: "GET",
                    url: remove_path + id,
                }).done(function(msg) {
                    // Изменение состояния интерфейса
                    element_depth.removeClass(element_fill).addClass(element_empty);
                });

            }

            // Если элемент пассивный
            if ($(this).is(dot + element_empty)) {

                // Получение идентификатора пользователя
                id = $(this).attr('id');

                // Для передачи элемента в ajax-функцию
                element_depth = $(this);

                // Отправка запроса
                $.ajax({
                    type: "GET",
                    url: add_path + id,
                }).done(function(msg) {
                    // Изменение состояния интерфейса
                    element_depth.removeClass(element_empty).addClass(element_fill);
                });
            }

        });
    }

    // Реализация подписки
    add_remoover('follow', 'bi-person-check-fill', 'bi-person', '/followed/', '/unfollowed/');
</script>