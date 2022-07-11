/**
 * * Обеспечивает отправку идентификатора события на скрипты добавления и удаления
 * * Изменяет состояние управляющего элемента
 * 
 * Поскольку принцип кода универсален для множества функций, то потребовалось использовать множество параметров:
 * type - '.' или '#'
 * selector - имя класса или идентификатора
 * before - класс для начального состояния
 * after - класс для конечного состояния
 * path - адрес
 * command - завершающий фрагмент адреса, отражающий тип действия скрипта по этому адресу
 */
function bookmarks(type, selector, before, after, path, command, text) {

    // Определение элемента
    element = $(type + selector);

    // Работа с тем элементом, по которому произошел клик
    element.bind('click', function () {

        // Извлечение идентификатора
        id = $(this).attr('id');

        // Определение внутреннего элемента
        state = $(this).find('i');

        // Если внутренний элемент класса: .bi-bookmark
        if (state.is(type + before)) {

            // Отправка запроса
            $.ajax({
                type: "GET",
                url: "/" + path + "/" + id + "/" + command,
                // data: { name: "John", location: "Boston" }
            }).done(function (msg) {
                // Изменение состояния интерфейса
                if (text) {
                    state.text(text);
                }
                state.removeClass(before).addClass(after);
            });

        }

    });

}

// Реализация добавления в закладки
bookmarks('.', 'bookmark', 'bi-bookmark', 'bi-bookmark-check-fill', 'bookmarks', 'add');
// Реализация удаления из закладок
bookmarks('.', 'bookmark', 'bi-bookmark-check-fill', 'bi-bookmark', 'bookmarks', 'remove');

/**
 * * Обеспечивает отправку идентификатора пользователя на скрипты добавления и удаления
 * * Изменяет состояние управляющего элемента
 * ! Есть косяк. При отмене регистрации нужно удалать 2 класса: btn-light и border. Нужно сделать так, чтобы отменялся лишь один класс.
 * 
 * Поскольку принцип кода универсален для множества функций, то потребовалось использовать множество параметров:
 * selector - имя идентификатора элемента
 * before - класс, определяющий начальное состояние
 * after - класс, определяющий конечное состояние
 * text - текст для элемента
 * directive - add или remove
 */
function favourites(selector, before, after, text, directive) {

    // Получение элемента
    element = $(selector);

    // Работа начинавется после клика по элементу
    element.click(function () {

        // Получение пути
        path = window.location.pathname;
        // Разбор адреса
        parse = path.split('/');
        // Получение идентификатора
        id = parse[2];

        // Перелпределение элемента для передачи его вглубь кода
        element = $(this);

        // Проверка соответствия начального состояния элемента искомому
        if (element.is('.' + before)) {

            // Отправка данных
            $.ajax({
                type: "GET",
                url: "/favourites/" + id + "/" + directive,
                // data: { name: "John", location: "Boston" }
            }).done(function (msg) {
                // Изменение элемента
                element.removeClass(before).addClass(after).text(text);
            });

        }

    });

}

// Добавление пользователя в список
favourites('#subscribe', 'btn-light', 'btn-warning', 'Подписаться', 'remove');
// Удаление пользователя из списка
favourites('#subscribe', 'btn-warning', 'btn-light border', 'Отписаться', 'add');

/**
 * * Обеспечивает отправку идентификатора события на скрипт регистрации пользователя на событие
 * * Изменяет состояние управляющего элемента
 * ! Есть косяк. При отмене регистрации нужно удалать 2 класса: btn-light и border. Нужно сделать так, чтобы отменялся лишь один класс.
 * 
 * selector - имя идентификатора элемента run
 * before - класс, определяющий начальное состояние
 * after - класс, определяющий конечное состояние
 * text - текст для элемента
 * directive - add или remove
 */
function run(selector, before, after, text, directive) {

    // Получение элемента
    element = $(selector);

    // Работа начинавется после клика по элементу
    element.click(function () {

        // Получение пути
        path = window.location.pathname;
        // Разбор адреса
        parse = path.split('/');
        // Получение идентификатора
        id = parse[2];


        // Переопределение элемента для передачи его вглубь кода
        element = $(this);

        // Проверка соответствия начального состояния элемента искомому
        if (element.is('.' + before)) {

            // Отправка данных
            $.ajax({
                type: "GET",
                url: "/run/" + id + "/" + directive,
                // data: { name: "John", location: "Boston" }
            }).done(function (msg) {
                // Изменение элемента
                element.removeClass(before).addClass(after).text(text);
            });

        }

    });

}

// Регистрация пользователя на событие
run('#run', 'btn-warning', 'btn-light border', 'Отменить участие', 'add');
// Отмена реристрациии пользователя на событие
run('#run', 'btn-light', 'btn-warning', 'Принять участие', 'remove');