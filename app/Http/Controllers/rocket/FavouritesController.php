<?php

namespace App\Http\Controllers\rocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Подключение библиотеки собственных методов (функции)
use App\Models\library\Base;

class FavouritesController extends Controller
{
    /**
     * ? Организует представление для страницы любимых пользователей
     */
    public function getFavourites()
    {
        // Получение данных избранных пользователей
        $stdVarFavourites = Base::getQueries('favourites_user');

        return view('rocketViews.favourites', ['stdVarFavourites' => $stdVarFavourites]);
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
     */
    public function removeFavourites($user_id)
    {
        return Base::removeSubscribe($user_id);
    }
}
