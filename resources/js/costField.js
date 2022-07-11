/**
 * Управление полем ввода стоимости события
 */

// Если выбрано "бесплатно", поле заблокировано
$("#free").change(function () {
    $('#cost').prop('disabled', true);
});

// Если выбран "донат", поле заблокировано
$("#donate").change(function () {
    $('#cost').prop('disabled', true);
});

// Если выбрана цена, то поле доступно для ввода
$("#price").change(function () {
    $('#cost').prop('disabled', false);
});

/**
 * Управление полем ввода информации об организаторе
 */
$("#witness").click(function () {
    if ($(this).is(':checked')) {
        $('#source').prop('disabled', false);
    } else {
        $('#source').prop('disabled', true);
    }
});
