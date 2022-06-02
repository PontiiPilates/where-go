<?php

namespace App\Http\Controllers\rocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Подключение библиотеки собственных методов (функции)
use App\Models\library\Base;

// Подключение класса Auth для возможности получения данных о статусе пользователя
use Illuminate\Support\Facades\Auth;

class FavouritesController extends Controller
{
    /**
     * ? Организует представление для страницы любимых пользователей
     */
    public function getFavourites()
    {
        // Получение данных избранных пользователей
        $stdVarFavourites = Base::getQueries('favourites_user');

        // ! Снабжение стандартными данными
        // ! Если пользователь не авторизован, то такой запрос можно не выполнять
        // Получение данных пользователя
        $user = Base::getQueries('user', Auth::id());
        // Получение имени аватара авторизованного пользователя
        if ($user) {
            $std_avatar = $user->avatar;
        } else {
            $std_avatar = '';
        }

        // ! Снабжение стандартными данными
        $user_id = Auth::id();

        return view('rocketViews.favourites', [
            'stdVarFavourites' => $stdVarFavourites,
            'stdAvatar' => $std_avatar,
            'userId' => $user_id,
        ]);
    }

    /**
     * ? Организует подписку на любимого пользователя
     */
    public function addFavourites($user_id)
    {
        return Base::addSubscribe($user_id);
    }

    /**
     * ? Организует отписку от пользователя
     * TODO: Если у избранного пользователя отсутствует массив подписчиков, то отписаться от него не получается. У авторизованного пользователя нельзя удалить идентификатор избранного пользователя
     */
    public function removeFavourites($user_id)
    {
        return Base::removeSubscribe($user_id);
    }
}
