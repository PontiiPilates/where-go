<?php

namespace App\Http\Controllers\rocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Подключение библиотеки собственных методов (функции)
use App\Models\library\Base;

// Подключение класса Auth для возможности получения данных о статусе пользователя
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    /**
     * ? Передает во view данные для рендеринга главной страницы
     */
    public function general()
    {
        // Получение списка событий
        $events = Base::getQueries('all_events');

        // Переменная для неавторизованного пользователя
        $stdVarFavourites = array();

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
}
