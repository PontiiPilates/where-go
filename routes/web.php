<?php

use Illuminate\Support\Facades\Route;
use Psr\Container\ContainerInterface;

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

// Поиск событий (главная)
// Route::get('/', [EventsListController::class, 'getGeneral']);
Route::match(['get', 'post'], '/', [EventsListController::class, 'getGeneral']);

// Создание события
Route::match(['get', 'post'], '/event/create', [FormEventController::class, 'create']);

// Правка события
Route::match(['get', 'post'], '/event/edit/{id}', [FormEventController::class, 'edit']);

// Смотреть профиль пользователя
Route::get('/profile/{user_id}', [ProfileController::class, 'get']);

// Правка профиля
Route::match(['get', 'post'], '/edit/profile', [FormProfileController::class, 'edit'])->name('profile');

// Удаление события
Route::match(['get', 'post'], '/delete/event/{event_id}', [DeleteEventController::class, 'delete']);

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
    return 'Событие успешно создано <br> <a href="/event/create">Вернуться</a>';
})->name('eventSuccess');

// ? Страница успешного удаления события
Route::get('/success/delete/event', function() {
    return 'Событие успешно удалено <br> <a href="/">Вернуться</a>';
})->name('deleteEvent');


/**
 * Development
 */
use App\Http\Controllers\StartController;

Route::get('d', [StartController::class, 'models']);

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
// TODO: перевести события на 1 форму вместо двух

// // TODO: организовать вывод событий на странице профиля или нет если их нет
// // TODO: организовать вывод событий на странице пользователя или нет если их нет
// // TODO: организовать удаление события
// ! TODO: организовать загрузку изображения события
// ! TODO: организовать загрузку изображения пользователя
// // TODO: организовать фильтрацию событий на главной
// ? TODO: для упрощения организации запросов, имя пользователя можно хранить в таблице events либо перейти на построитель запросов без Eloquent

// TODO: организовать смену пароля, почты, никнейма - потом
// TODO: организовать обратную связь для пользователя - потом
// TODO: в форму создания события поместить ссылку: предложить категорию - потом

// // TODO: подумать над пространством имен относительно всей системы профиля пользоватенля


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



























// ! Изменение имени контроллера:
// Изменение имени файла контроллера
// Изменение имени класса контроллера в файле
// Изменение имени класса контроллера в роутинге
// Изменение имени подключаемого класса в роутинге


// таблица в базе данных во множественном числе
// файл модели в единственном числе
// класс модели в единственном числе
// имя подключаемого класса в контроллере

// имя файла миграции
// имя класса миграции
// имя схемы в классе миграции

// имя файла сидера во множественном числе
// имя класса сидера во множественном числе
// имя таблицы в классе сидера во множественном числе
// имя подключаемого сидера в DatabaseSeeder