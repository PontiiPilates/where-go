/**
 * Управление раскрывающимся списком подписок
 * Изменяет высоту контейнера до натуральной, чтобы затем ее установить
 * Производит анимированную трансформацию высоты контейнера
 */
$('#drop-down').click(function () {

    // Скрытие кнопки
    $(this).hide()

    var element = $('#drop-list'),
        // Текущая высота
        currentHeight = element.height(),
        // Высота контента
        invisibleHeight = element.css('height', 'auto').height();

    element.height(currentHeight).animate({
        // Анимированное изменение параметра высоты
        height: invisibleHeight + 30
    }, 300);

})