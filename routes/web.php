<?php

use Illuminate\Support\Facades\Route;
use Psr\Container\ContainerInterface;


// Подключение класса Auth для возможности получения данных о статусе пользователя
use Illuminate\Support\Facades\Auth;

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

// Home
// Route::get('/', function () {
//     return view('welcome');
// });

// Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

/**
 * Custome routes
 */

use App\Http\Controllers\project\EventsListController;
use App\Http\Controllers\project\FormEventController;
use App\Http\Controllers\project\FormProfileController;
use App\Http\Controllers\project\ProfileController;
// use App\Http\Controllers\project\UserController;
use App\Http\Controllers\project\DeleteEventController;
use App\Http\Controllers\project\FormSecurityController;
use App\Http\Controllers\project\PageEventController;

// Поиск событий (главная)
// Route::match(['get', 'post'], '/', [EventsListController::class, 'getGeneral']);

// Создание события
Route::match(['get', 'post'], '/create/event', [FormEventController::class, 'create']);

// Правка события
Route::match(['get', 'post'], '/edit/event/{event_id}', [FormEventController::class, 'edit']);

// Смотреть свой профиль или профиль пользователя
// TODO: Нужно обязательно доставить идентификатор в урл профиля пользователя
Route::get('/profile/{user_id?}', [ProfileController::class, 'get'])->name('profileView');

// Правка профиля
Route::match(['get', 'post'], '/edit/profile', [FormProfileController::class, 'edit'])->name('profile');

// Удаление события
Route::match(['get', 'post'], '/delete/event/{event_id}', [DeleteEventController::class, 'delete']);

// Настройки безопасности
Route::match(['get', 'post'], '/edit/security', [FormSecurityController::class, 'edit']);

// Страница просмотра события
Route::get('r/event/{event_id}', [PageEventController::class, 'get']);

use App\Http\Controllers\project\PastEventsController;
// Страница вывода прошедших событий
Route::get('/past/{user_id}', [PastEventsController::class, 'get']);

// use App\Http\Controllers\project\BookmarksController;
// // Страница добавления в закладки
// Route::get('/add/bookmarks/{event_id}', [BookmarksController::class, 'add']);
// // Страница удаления из закладок
// Route::get('/remove/bookmarks/{event_id}', [BookmarksController::class, 'remove']);
// // Страница просмотра закладок
// Route::get('/get/bookmarks/', [BookmarksController::class, 'get']);

use App\Http\Controllers\project\FollowsController;
use App\Http\Controllers\project\SitemapController;
// use App\Http\Controllers\rocket\GeneralController;

// Страница подписки на пользователя
Route::get('/followed/{user_id}', [FollowsController::class, 'followed']);
// Страница отписки от пользователя
Route::get('/unfollowed/{user_id}', [FollowsController::class, 'unfollowed']);
// Просмотр подписок
Route::get('/follow', [FollowsController::class, 'follow']);
// Просмотр подписавшихся
Route::get('/followers/{user_id}', [FollowsController::class, 'followers']);

// Подтверждение правообладания сайтом для Яндекс
Route::get('/yandex_55160e05f8349cf0.html', function () {
    return view('project.webmaster');
});

// Выдача Sitemap
Route::get('/sitemap', [SitemapController::class, 'getSitemap']);



// ! Организация пространства имен
// 1. Функциональный идентификатор: view, create, edit, delete
// 2. Имя архитектурной сущности: user, profile, event
// 3. Системмный модификатор: Controller, Seeder, _table


// ? Закладки
Route::get('bookmarks', function () {
    return view('project.bookmarks');
});

// ? Страница успешного создания/обновления события
Route::get('/event/success', function () {
    return 'Событие успешно создано <br> <a href="/">Вернуться</a>';
})->name('eventSuccess');

// ? Страница успешного удаления события
Route::get('/success/delete/event', function () {
    return 'Событие успешно удалено <br> <a href="/">Вернуться</a>';
})->name('deleteEvent');

Route::get('/success', function () {
    return 'Успешно!';
})->name('success');

Route::get('/error', function () {
    return '
    <strong>Что-то пошло не так.</strong>
    <p>Пожалуйста попробуйте еще раз. Если ошибка повторится, то напишите об этом разработчику.</p>';
})->name('error');


/**
 * Development
 */

use App\Http\Controllers\StartController;

Route::match(['get', 'post'], '/d/{id?}', [StartController::class, 'filters']);


/**
 * Rocket
 */

//  Это просто вёрстка, сплошная вёрстка всего
Route::get('/l', function () {
    return view('rocketViews.layout');
});

//  Подключение контроллера для главной страницы
use App\Http\Controllers\rocket\GeneralController;
// Главная страница
Route::get('/', [GeneralController::class, 'general'])->name('general');

// Подключение контроллера для обеспечения работы закладок
use App\Http\Controllers\rocket\BookmraksController;
// Закладки
Route::get('bookmarks', [BookmraksController::class, 'bookmarks'])->name('bookmarks')->middleware('auth');
// Добавление в закладки
Route::get('bookmarks/{id}/add', [BookmraksController::class, 'addBookmark'])->middleware('auth');
// Удаление из закладок
Route::get('bookmarks/{id}/remove', [BookmraksController::class, 'removeBookmark'])->middleware('auth');

// Подключение контроллера для избранных пользователей
use App\Http\Controllers\rocket\FavouritesController;
// Избранные пользователи
Route::get('favourites', [FavouritesController::class, 'getFavourites'])->name('favourites')->middleware('auth');
// Добавление в избранные пользователи
Route::get('favourites/{user_id}/add', [FavouritesController::class, 'addFavourites']);
// Удаление из избранных пользователей
Route::get('favourites/{user_id}/remove', [FavouritesController::class, 'removeFavourites']);


// Подключение контроллера управляющего событиями
use App\Http\Controllers\rocket\EventController;
// Возвращает страницу события
Route::get('event/{id}', [EventController::class, 'get'])->whereNumber('id'); // Явно указываю, что id - это число!
// Добавляет событие
Route::match(['get', 'post'], 'event/add', [EventController::class, 'add'])->name('event.add')->middleware('auth');
// Редактировать событие
Route::match(['get', 'post'], 'event/{id}/edit', [EventController::class, 'edit'])->middleware('auth');
// Удаляет событие
Route::get('event/{id}/remove', [EventController::class, 'remove']);



// Подключение контроллера для регистрации на событие
use App\Http\Controllers\rocket\RunController;
// Возвращает список событий, на которые идет пользователь
Route::get('run', [RunController::class, 'getEvents'])->middleware('auth');
// Зарегистрировать пользователя на событие
Route::get('run/{event_id}/add', [RunController::class, 'add']);
// Отменить регистрацию пользователя на событие
Route::get('run/{event_id}/remove', [RunController::class, 'remove']);
// Показать пользователей, которые идут на событие
Route::get('run/{event_id}/users', [RunController::class, 'getUsers']);

// Подключение контроллера для управления авторизованным пользователем
use App\Http\Controllers\rocket\UserController;
// Страница пользователя
Route::get('user/{id}', [UserController::class, 'getUser'])->name('user');
// // Своя страница
// Route::get('self', function () {
//     $user_id = Auth::id();
//     return redirect("user/$user_id");
// })->name('self');
// Страница управления данными пользователя
Route::match(['get', 'post'], 'user/{id}/edit', [UserController::class, 'edit']);

// // TODO: Сделать переход со страницы события на страницу пользователя
// // TODO: Реализовать количество просмотров в карточке события и на странице события
// // TODO: Реализовать человекопонятную дату на карточке события
// // TODO: на странице закладок применяется какой-то список событий не правильный, там количество участвующих пользователей не верное и на иду тоже
// // TODO: сделать фильтр на мобильной версии
// // TODO: сделать чтобы авторизованный пользователь мог смотреть статистику участников своих событий
// // TODO: разобраться с подсветкой пункта меню если находимся на другом пользователе
// // TODO: сделать просмотр своей странице доступным по пути selfprofile

// Фронтенд
// TODO: Подправить картинку изображения - сделать ее кадрирование по центру
// TODO: Подправвить изображение аватарки - сделать ее кадрирование по центру
// TODO: поправить кнопки, у них какой-то ареол не нужный появляется, сделать на монер "еще"
// TODO: после создания события на мобилке модальное окно открывается сбоку

// Продвижение
// TODO: как тут зарабатывать пока что можно скрыть

// Бэкенд
// TODO: сделать общую страницу ошибки
// TODO: на фильтр нужна кнопочка сбросить














// // TODO: наладить работу с базой данных: миграции и сидеры
// // TODO: освоить модели и Eloquent ORM
// // TODO: разработать контроллер обслуживания формы создания события
// // TODO: настроить авторизацию и регистрацию
// // ! TODO: сделать сидер для пользователей
//    // Сергей
//    // zloileshii@gmail.com
//    // $2y$10$k9AiRDQo9GmO4.M8gp3p9.nyghodGYC7D/Q1onb2ephsSt5ThrZbO
//    // $2y$10$GrolbZQd1R532/wh5XGitOZb5Ov8GVRIR440/mv2/THldJwI.WqGy
// // TODO: организовать вывод событий на главной
// TODO: дизайн mobile first
// ! Выход из сессии осуществляется из формы с методом post
// // TODO: произошло несоответствие в соглашениях модели, сидера, миграции и имени базы данных users_data, в связи с чем пришлось указывать таблицу явно. Хорошо бы поправимть до стокового состояния.
// // TODO: рассмотреть переименование user как профиль авторизованного пользователя в profile
// TODO: создать таблицу городов
// TODO: создать таблицу категорий
// // TODO: перевести события на 1 форму вместо двух

// // TODO: организовать вывод событий на странице профиля или нет если их нет
// // TODO: организовать вывод событий на странице пользователя или нет если их нет
// // TODO: организовать удаление события
// // TODO: организовать загрузку изображения события
// // TODO: организовать загрузку изображения пользователя
// // TODO: организовать фильтрацию событий на главной
// ? TODO: для упрощения организации запросов, имя пользователя можно хранить в таблице events либо перейти на построитель запросов без Eloquent

// // ! TODO: организовать смену пароля, почты
// ! TODO: организовать сброс пароля

// TODO: подумать на счет организации изменения никнейма - потм
// TODO: организовать обратную связь для пользователя - потом
// TODO: в форму создания события поместить ссылку: предложить категорию - потом
// TODO: сверстать загрузку файла - потом
// TODO: определиться, что считать главной, свою страницу или список событий

// // TODO: подумать над пространством имен относительно всей системы профиля пользоватенля

// // TODO: получить id пользователя
// // TODO: затащить его в базу данных
// // TODO: переформировать таблицу в базе данных
// // TODO: различить сценарий создания и сценарий редактирования
// // TODO: после успешного создания перенаправить пользователя на страницу что событие успешно создано

// TODO: валидировать данные формы
// // TODO: настроить прием, обработку и хранение файлов формы
// // TODO: проверять на авторизованность, чтобы гарантировыанно в таблицу попал user id
// // TODO: предоставлять доступ к созданию и редактированию форм если пользователь авторизирован @auth


// TODO: Отвалидировать форму фильтр на главной страницы на предмет принятия дат
// TODO: Сделать кнопку читать полностью на карточке события
// TODO: Валидировать формы, чтобы они не пропускали html-код
// TODO: Облагородить интерфейс формы редактирования профиля
// TODO: Проверять путь /edit/profile на аутентификацию. Сделать это с помощью middleware


// TODO: Создать форму выхода logout
// TODO: Еще раз пробежаться по настройке вывода сообщений при аутентификации
// TODO: Запретить редактирование профиля другого пользователя








// ! Концепция пространства имен:
// со стороны разработчика все - пользователи
// авторизованный пользователь сам для себя - профиль
// со стороны авторизованного пользователя равные ему - пользователи
// существенная поправка: со стороны представлений такого разделения нет, есть только элементы доступные для ролей, разделение происходит на уровне контроллера и роутинга



/**
 * ! ---------------------------------------------------- +
 * ! План развития                                        |
 * ! ---------------------------------------------------- +
 */

// TODO: 1 собственноеручное/с друзьями заполнение пространства событиями (сфу, городскими)
// TODO: Очередную версию стоит начинать с разработки путей и понимания того, что на каждом будет происходить









// приходилось ли тебе думать о том куда и с кем сходить в пятницу вечером?
// не обязательно в пятницу, можно в любой другой день.
// попробуй сервис where-go.
// тым найдется событие на любой вкус.
// если вдруг событий для тебя на нашлось, то можешь создать их самомтоятельно
