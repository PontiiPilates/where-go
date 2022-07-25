<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__ . '/auth.php';

/**
 * Служебные пути
 */

// подтверждение правообладания
Route::get('/yandex_55160e05f8349cf0.html', function () {
    return view('webmaster');
});

// карта сайта
use App\Http\Controllers\SitemapController;

Route::get('/sitemap', [SitemapController::class, 'getSitemap']);

// успешно
Route::get('/success', function () {
    return 'Успешно!';
})->name('success');

// неудачно
Route::get('/error', function () {
    return '<strong>Что-то пошло не так.</strong> <p>Пожалуйста попробуйте еще раз. Если ошибка повторится, то напишите об этом разработчику.</p>';
})->name('error');

/**
 * Для тестов
 */

use App\Http\Controllers\DevelopmentController;
// для разработки
Route::match(['get', 'post'], '/d', [DevelopmentController::class, 'get']);

/**
 * Where-go
 */

use App\Http\Controllers\GeneralController;
// главная 
Route::get('/', [GeneralController::class, 'getEvents'])->name('general');

use App\Http\Controllers\BookmraksController;
// помеченные события
Route::get('/bookmarks', [BookmraksController::class, 'getEvents'])->name('bookmarks')->middleware('auth');
// добавление в закладки
Route::get('/bookmarks/{id}/add', [BookmraksController::class, 'addBookmark'])->middleware('auth');
// удаление из закладок
Route::get('/bookmarks/{id}/remove', [BookmraksController::class, 'removeBookmark'])->middleware('auth');

use App\Http\Controllers\FavouritesController;
// список избранных пользователей
Route::get('/favourites', [FavouritesController::class, 'getUsers'])->name('favourites')->middleware('auth');
// добавление подписки
Route::get('/favourites/{user_id}/add', [FavouritesController::class, 'addFavourites']);
// удаление подписки
Route::get('/favourites/{user_id}/remove', [FavouritesController::class, 'removeFavourites']);

use App\Http\Controllers\EventController;
// данные о событии
Route::get('/event/{id}', [EventController::class, 'getEvent'])->whereNumber('id'); // Явно указываю, что id - это число!
// создание события
Route::match(['get', 'post'], '/event/add', [EventController::class, 'addEvent'])->name('event.add')->middleware('auth');
// редактирование события
Route::match(['get', 'post'], '/event/{id}/edit', [EventController::class, 'editEvent'])->middleware('auth');
// удаление события
Route::get('/event/{id}/remove', [EventController::class, 'removeEvent']);

use App\Http\Controllers\RunController;
// список участий
Route::get('/run', [RunController::class, 'getEvents'])->middleware('auth');
// регистрация на событие
Route::get('/run/{event_id}/add', [RunController::class, 'addRun']);
// отмена регистрации
Route::get('/run/{event_id}/remove', [RunController::class, 'removeRun']);
// список участвующих
Route::get('/run/{event_id}/users', [RunController::class, 'getUsers']);

use App\Http\Controllers\UserController;
// данные о пользователе
Route::get('/user/{id}', [UserController::class, 'getUser'])->name('user');
// редактирование профиля
Route::match(['get', 'post'], '/user/{id}/edit', [UserController::class, 'editUser']);

// статистика
use Illuminate\Support\Facades\DB;
Route::get('/statistics/273076', function () {

    // получение количества событий в поиске
    $event_count = DB::table('events')
        ->where('status', 1)
        ->where('date_end', '>=', date('Y-m-d'))
        ->orWhere('date_start', '>=', date('Y-m-d'))
        ->count();

    print "<b>Событий в поиске:</b> $event_count</br>";

    // получение количества зарегистрированных пользователей
    $user_count = DB::table('users')
        ->select('id', 'name')
        ->get();

    echo '<ul>';
    foreach ($user_count as $user) {
        print '<li>' . $user->id . ' ' . $user->name . '</li>';
    }
    echo '</ul>';

});

/**
 * Лог разработки
 */

// фронтенд
// TODO: подправить картинку изображения - сделать ее кадрирование по центру
// TODO: подправвить изображение аватарки - сделать ее кадрирование по центру
// TODO: поправить кнопки, у них какой-то ареол не нужный появляется, сделать на монер "еще"
// TODO: после создания события на мобилке модальное окно открывается сбоку
// продвижение
// TODO: добавить - как тут зарабатывать
// TODO: 1 собственноеручное/с друзьями заполнение пространства событиями (сфу, городскими)
// TODO: анонсировать
// 1. Как только наберется 30-50 событий в моменте, то я опубликую на стене пост о запуске проекта, попрошу друзей рассказать о нем и посмотрю, какой отклик это даст.
// 2. Анализ результата, устранение ошибок, подготовка к следующему шагу.
// 3. Запуск таргетированной рекламы в вк. Там проще сегментировать аудиторию. Можно запустить рекламу на подписчиков походных групп. Возможно на организаторов. Посмотрю, что это даст.
// 4. Анализ результата, устранение ошибок, подготовка к следующему шагу.
// 5. Запуск рекламы в яндекс-директе на Красноярск. Посмотрю, что даст этот ход.
// 6. Анализ результата, устранение ошибок, подготовка к следующему шагу.
// 7. Опишу проект на VC.RU и Яндекс-Дзен.
// -. Что-то дальше, пока не получается заглянуть дальше, слишком много неизвестного.
// бэкенд
// TODO: сделать общую страницу ошибки
// TODO: на фильтр нужна кнопочка сбросить
// TODO: создать таблицу городов
// TODO: создать таблицу категорий
// TODO: для упрощения организации запросов, имя пользователя можно хранить в таблице events либо перейти на построитель запросов без Eloquent
// TODO: подумать на счет организации изменения никнейма - потм
// TODO: организовать обратную связь для пользователя - потом
// TODO: в форму создания события поместить ссылку: предложить категорию - потом
// TODO: сверстать загрузку файла - потом
// TODO: валидировать данные формы
// TODO: Отвалидировать форму фильтр на главной страницы на предмет принятия дат
// TODO: Валидировать формы, чтобы они не пропускали html-код


// Фестивали, праздники, ярмарки
// Выступления, концерты, стендап
// Спорт, соревнования, чемпионат
// Культура, поэзия, орекстр, выставка
// Тест-драйв, пробные занятия

// Встреча с режиссером
// Квартира академика, встреча на ней попоём музыку
// Спектакль
// Кинопоказ в доме кино
// Дизайн, показ мод, конкурс, фотоконкурс
// Объявления, типа состояится конкурс принимаем заявки: // https://where-go.ru/event/146

// Концерты и выступления
// Праздники, фестивали и ярморки
// Соревнования и чемпионаты
// Спорт
// Здоровье
// Красота