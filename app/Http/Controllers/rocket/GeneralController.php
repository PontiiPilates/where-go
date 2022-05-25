<?php

namespace App\Http\Controllers\rocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Подключение библиотеки собственных методов (функции)
use App\Models\library\Base;

// Подключение класса Auth для возможности получения данных о статусе пользователя
use Illuminate\Support\Facades\Auth;

// Подключение DB для создания произвольных запросов к базе данных
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    /**
     * ? Передает во view данные для рендеринга главной страницы
     */
    public function general(Request $r)
    {


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


        if (Auth::id()) {
            $user_id = Auth::id();
        } else {
            $user_id = 0;
        }

        /**
         * * Организация фильтрации событий
         */

        // Если произошла отправка отправка формы "Фильтр"
        if ($r->filter === 'true') {

            $city = $r->city;
            $category = $r->category;
            $date_start = $r->date_start;
            
            // Вывод по городу
            // Вывод по категории
            // Вывод по дате

            // Вывод по городу и категории
            // Вывод по городу и дате
            // Вывод по категории и дате

            // Вывод по городу категории и дате

            $events = DB::table('events')
                ->where('status', 1)

                // ->where('events.category', $category)
                // ->where('events.city', $city)
                ->where('date_start', '>=', $date_start)

                ->join('users', 'events.user_id', '=', 'users.id')
                ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                ->select('events.*', 'users.name', 'profiles.avatar')
                ->orderBy('date_start')
                ->simplePaginate(30);
        } else {
            // Иначе просто вывод списка событий
            $events = Base::getQueries('all_events');
        }





        return view('rocketViews.general', [
            'events' => $events,
            'bookmarks' => $bookmarks,
            'stdVarFavourites' => $stdVarFavourites,
            'stdAvatar' => $std_avatar,
            'userId' => $user_id,
        ]);
    }
}
