<?php

namespace App\Http\Controllers;

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
    public function getUsers()
    {
        // сборка данных со стороны авторизованного пользователя
        Base::sessionRefresh();
        // сборка данных со стороны сервиса
        $localstorage = Base::getLocalstorage();

        // получение подписок
        $users = session('favourites_obj');

        // формирование meta-тегов
        $user_name = session('name');
        $localstorage['meta']['title'] = $user_name;
        $localstorage['meta']['description'] = "пользователи, на которых подписан $user_name";

        return view('listUsers', [
            'localstorage' => $localstorage,
            'users' => $users,
        ]);
    }

    /**
     * Добавляет подписки на пользователя
     * @param $user_id int идентификатор избранного пользователя
     * @return string
     */
    public function addFavourites($user_id)
    {
        return Base::reversible('favourites', 'add', (int) $user_id);
    }

    /**
     * Удаляет подписки на пользователя
     * @param $user_id int идентификатор избранного пользователя
     * @return string
     */
    public function removeFavourites($user_id)
    {
        return Base::reversible('favourites', 'remove', (int) $user_id);
    }
}
