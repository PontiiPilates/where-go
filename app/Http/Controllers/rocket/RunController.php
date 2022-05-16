<?php

namespace App\Http\Controllers\rocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Подключение библиотеки собственных методов (функции)
use App\Models\library\Base;

use Illuminate\Support\Facades\Auth;

class RunController extends Controller
{
    public function getEvents()
    {

        // Получение данных избранных пользователей
        
        // return view('rocketViews.userList', ['events' => $events]);
        
        // Получение списка событий
        $events = Base::getQueries('run_events');
        // $events = Base::getQueries('all_events');

        // Получение списка идентификаторов событий, которые пользователь добавил в закладки
        // ! Здесь должна быть проверка на авторизованность, которую уместно перенести в Tools и которая часто будет использоваться
        // ! По умолчанию bookmarks путьс будет array, поскольку шаблон ожидавет именно этого типа переменной
        $bookmarks = array();
        $favourites = array();
        if (Auth::id()) {
            $bookmarks = Base::getIds('bookmarks');
            $stdVarFavourites = Base::getQueries('favourites_user');
        }

        return view('rocketViews.general', ['events' => $events, 'bookmarks' => $bookmarks, 'stdVarFavourites' => $stdVarFavourites]);
    }
    public function add($event_id)
    {
        return Base::addRun($event_id, 'going', 'goes');
    }
    public function remove($event_id)
    {
        return Base::removeRun($event_id, 'going', 'goes');
    }
    public function getUsers($event_id)
    {
        // Обеспечение стандартными данными: избранные пользователти
        $stdVarFavourites = Base::getQueries('favourites_user');

        // Получение списка пользователей, зарегистрировавшихся на событие
        $users = Base::getQueries('run_users', $event_id);

        return view('rocketViews.userList', [
            'stdVarFavourites' => $stdVarFavourites,
            'users' => $users
        ]);
    }
}
