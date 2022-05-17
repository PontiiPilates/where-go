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

                // Получение имени аватара авторизованного пользователя
                $std_avatar = $user->avatar;

        // Передача данных на представление
        return view('rocketViews.user', [
            'user' => $user,
            'events' => $events,
            'bookmarks' => $bookmarks,
            'favourites' => $favourites,
            'stdVarFavourites' => $stdVarFavourites,
            'user_id' => $user_id,
            'std_avatar' => $std_avatar,



        ]);
    }

    public function edit($user_id)
    {
        // Снабжение стандартными данными (подписки)
        $stdVarFavourites = Base::getQueries('favourites_user');

        // Снабжение контроллера процедурными данными
        $user = Base::getQueries('user', $user_id);

        // Получение имени аватара авторизованного пользователя
        $std_avatar = $user->avatar;

        // Передача данных на представление
        return view(
            'rocketViews.userEdit',
            [
                'stdVarFavourites' => $stdVarFavourites,
                'std_avatar' => $std_avatar,
                'user_id' => $user_id,
                'user' => $user,
            ]
        );
    }
}
