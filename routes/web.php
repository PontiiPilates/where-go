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
use App\Http\Controllers\EventCommentsController;

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
Route::match(['get', 'post'], '/event/{id}', [EventController::class, 'getEvent'])->whereNumber('id'); // Явно указываю, что id - это число!
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

use App\Http\Controllers\NotificationsController;
// список уведомлений
Route::get('/notifications', [NotificationsController::class, 'getNotifications']);



// комментарии
// Route::get('comments', [EventCommentsController::class, 'getComments'])->name('comments.event');

// статистика
use Illuminate\Support\Facades\DB;

// подключение модели
use App\Models\Event;

Route::get('/statistics/273076', function () {

    // получение количества событий в поиске
    $event_count = DB::table('events')
        ->where('status', 1)
        // ->where('date_end', '>=', date('Y-m-d'))
        ->where('date_start', '>=', date('Y-m-d'))
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


use App\Http\Controllers\TgBotController;

// отправить сообщение
Route::get('/tgsm/{chat_id}/{message}', [TgBotController::class, 'sendMessage']);

// отправить сообщение с кнопкой
Route::get('/tgsb/{chat_id}/{message}', [TgBotController::class, 'sendMessage']);