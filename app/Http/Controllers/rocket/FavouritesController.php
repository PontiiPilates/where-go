<?php

namespace App\Http\Controllers\rocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// подключение библиотеки кастомных методов
use App\Models\library\Base;

class FavouritesController extends Controller
{
    /**
     * Страница подписок
     * @return mixed
     */
    public function getFavourites()
    {
        // сборка данных со стороны авторизованного пользователя
        Base::sessionRefresh();

        // сборка данных со стороны сервиса
        $localstorage = Base::getLocalstorage();

        return view('rocketViews.favourites', [
            'localstorage' => $localstorage
        ]);
    }

    /**
     * Добавляет подписки на пользователя
     * @return string
     */
    public function addFavourites($user_id)
    {
        return Base::addSubscribe($user_id);
    }

    /**
     * Удаляет подписки на пользователя
     * @return string
     */
    public function removeFavourites($user_id)
    {
        return Base::removeSubscribe($user_id);
    }
}