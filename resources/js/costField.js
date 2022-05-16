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