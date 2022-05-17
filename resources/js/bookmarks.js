/**
 * * Обеспечивает отправку идентификатора события на скрипты добавления и удаления
 * * Изменяет состояние управляющего элемента
 * 
 * * Поскольку принцип кода универсален для множества функций, то потребовалось использовать множество параметров:
 * * type - '.' или '#'
 * * selector - имя класса или идентификатора
 * * before - класс для начального состояния
 * * after - класс для конечного состояния
 * * path - адрес
 * * command - завершающий фрагмент адреса, отражающий тип действия скрипта по этому адресу
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
                if(text) {
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

// favourites('#', 'subscribe', 'btn-warning', 'btn-light', 'favourites', 'add');