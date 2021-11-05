<?php

use Illuminate\Support\Facades\Route;
use Psr\Container\ContainerInterface;

use App\Http\Controllers\StartController;

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

// Главная: просмотр и поиск событий
Route::get('/', function () {
    return view('project.general');
});

// Создание события
Route::get('/event/create', function () {
    return view('project.eventEdit');
});

// Правка события
Route::get('/event/edit', function () {
    return view('project.eventEdit');
});

// Закладки
Route::get('bookmarks', function () {
    return view('project.bookmarks');
});

// Пользователь
Route::get('/user/id', function () {
    return view('project.user');
});

// Правка пользователя
Route::get('/user/edit', function () {
    return view('project.userEdit');
});

// Development
Route::get('d', function () {

    $data = [
        'Поход в пещеру',
        'Заход в бухту',
        'Полет в шерегеш',
        'Залет в бангладэш',
    ];

    return view('templates.bookmarksList', ['data' => $data]);
});