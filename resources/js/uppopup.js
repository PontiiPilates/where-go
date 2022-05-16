/**
 * Поднимает модальное окно после создания события с предложением поделиться им
 */

// Получение параметров URL
url = window.location.search;
// Получение чистой команды
directive = url.replace('?', '');

if (directive == 'uppopup') {
    // Клик по элементу
    $('#eventCreateTrigger').click();
}