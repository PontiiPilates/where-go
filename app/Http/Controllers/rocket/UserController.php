<?php

namespace App\Http\Controllers\rocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Подключение библиотеки собственных методов (функции)
use App\Models\library\Base;

class UserController extends Controller
{
    /**
     * ? Передает во view данные для рендеринга страниц пользователей
     */
    public function getUser($user_id)
    {
        // Получение данных пользователя
        $user = Base::getQueries('user', $user_id);

        // Получение списка событий
        $events = Base::getQueries('user_events', $user_id);

        // Получение списка идентификаторов событий, которые пользователь добавил в закладки
        $bookmarks = Base::getIds('bookmarks');

        // Получение списка идентификаторов избранных пользователей
        $favourites = Base::getIds('favourites');

        // Получение данных избранных пользователей
        $stdVarFavourites = Base::getQueries('favourites_user');

        return view('rocketViews.user', ['user' => $user, 'events' => $events, 'bookmarks' => $bookmarks, 'favourites' => $favourites, 'stdVarFavourites' => $stdVarFavourites]);
    }
}
