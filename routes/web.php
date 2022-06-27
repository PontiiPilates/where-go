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
    return '<strong>Что-то пошло не так.</strong><p>Пожалуйста попробуйте еще раз. Если ошибка повторится, то напишите об этом разработчику.</p>';
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



/**
 * Лог разработки
 */

// фронтенд
// TODO: подправить картинку изображения - сделать ее кадрирование по центру
// TODO: подправвить изображение аватарки - сделать ее кадрирование по центру
// TODO: поправить кнопки, у них какой-то ареол не нужный появляется, сделать на монер "еще"
// TODO: после создания события на мобилке модальное окно открывается сбоку

// продвижение
// TODO: как тут зарабатывать пока что можно скрыть
// TODO: 1 собственноеручное/с друзьями заполнение пространства событиями (сфу, городскими)
// TODO: Очередную версию стоит начинать с разработки путей и понимания того, что на каждом будет происходить
// TODO: анонсировать в соцсетях:
// * приходилось ли тебе думать о том куда и с кем сходить в пятницу вечером?
// * не обязательно в пятницу, можно в любой другой день.
// * попробуй сервис where-go.
// * тым найдется событие на любой вкус.
// * если вдруг событий для тебя на нашлось, то можешь создать их самомтоятельно

// бэкенд
// TODO: сделать общую страницу ошибки
// TODO: на фильтр нужна кнопочка сбросить
// TODO: создать таблицу городов
// TODO: создать таблицу категорий
// TODO: для упрощения организации запросов, имя пользователя можно хранить в таблице events либо перейти на построитель запросов без Eloquent
// TODO: организовать сброс пароля
// TODO: подумать на счет организации изменения никнейма - потм
// TODO: организовать обратную связь для пользователя - потом
// TODO: в форму создания события поместить ссылку: предложить категорию - потом
// TODO: сверстать загрузку файла - потом
// TODO: валидировать данные формы
// TODO: Отвалидировать форму фильтр на главной страницы на предмет принятия дат
// TODO: Валидировать формы, чтобы они не пропускали html-код
// TODO: Запретить редактирование профиля другого пользователя
// TODO: сделать 404 страницу

// сделано
// // TODO: сделать переход со страницы события на страницу пользователя
// // TODO: реализовать количество просмотров в карточке события и на странице события
// // TODO: реализовать человекопонятную дату на карточке события
// // TODO: на странице закладок применяется какой-то список событий не правильный, там количество участвующих пользователей не верное и на иду тоже
// // TODO: сделать фильтр на мобильной версии
// // TODO: сделать чтобы авторизованный пользователь мог смотреть статистику участников своих событий
// // TODO: разобраться с подсветкой пункта меню если находимся на другом пользователе
// // TODO: сделать просмотр своей странице доступным по пути selfprofile
// // TODO: наладить работу с базой данных: миграции и сидеры
// // TODO: освоить модели и Eloquent ORM
// // TODO: разработать контроллер обслуживания формы создания события
// // TODO: настроить авторизацию и регистрацию
// // TODO: сделать сидер для пользователей
// // TODO: организовать вывод событий на главной
// // TODO: дизайн mobile first
// // TODO: произошло несоответствие в соглашениях модели, сидера, миграции и имени базы данных users_data, в связи с чем пришлось указывать таблицу явно. Хорошо бы поправимть до стокового состояния.
// // TODO: рассмотреть переименование user как профиль авторизованного пользователя в profile
// // TODO: перевести события на 1 форму вместо двух
// // TODO: организовать вывод событий на странице профиля или нет если их нет
// // TODO: организовать вывод событий на странице пользователя или нет если их нет
// // TODO: организовать удаление события
// // TODO: организовать загрузку изображения события
// // TODO: организовать загрузку изображения пользователя
// // TODO: организовать фильтрацию событий на главной
// // TODO: определиться, что считать главной, свою страницу или список событий: для гостя - главная, для авторизованного пользователя - своя
// // TODO: организовать смену пароля, почты
// // TODO: подумать над пространством имен относительно всей системы профиля пользоватенля
// // TODO: получить id пользователя
// // TODO: затащить его в базу данных
// // TODO: переформировать таблицу в базе данных
// // TODO: различить сценарий создания и сценарий редактирования
// // TODO: после успешного создания перенаправить пользователя на страницу что событие успешно создано
// // TODO: настроить прием, обработку и хранение файлов формы
// // TODO: проверять на авторизованность, чтобы гарантировыанно в таблицу попал user id
// // TODO: предоставлять доступ к созданию и редактированию форм если пользователь авторизирован @auth