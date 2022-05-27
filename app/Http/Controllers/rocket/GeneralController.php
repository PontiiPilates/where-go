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
            // $stdVarFavourites = Base::getFavourites();
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
         * * Написано хорошо, переделывать не нужно
         */

        $city = $r->city;
        $category = $r->category;
        $date_start = $r->date_start;

        if ($city && !$category && !$date_start) {
            // Если есть город        
            $events = Base::getEvents('filtrated_city', $city, $category, $date_start);
        } elseif ($category && !$city && !$date_start) {
            // Если есть категория
            $events = Base::getEvents('filtrated_category', $city, $category, $date_start);
        } elseif ($date_start && !$city && !$category) {
            // Если есть дата
            $events = Base::getEvents('filtrated_date', $city, $category, $date_start);
        } elseif ($city && $category && !$date_start) {
            // Если есть город и категория
            $events = Base::getEvents('filtrated_city_category', $city, $category, $date_start);
        } elseif ($city && $date_start && !$category) {
            // Если есть город и дата
            $events = Base::getEvents('filtrated_city_date', $city, $category, $date_start);
        } elseif ($category && $date_start && !$city) {
            // Если есть категория и дата
            $events = Base::getEvents('filtrated_category_date', $city, $category, $date_start);
        } elseif ($city && $category && $date_start) {
            // Если есть город, категория и дата
            $events = Base::getEvents('filtrated_city_category_date', $city, $category, $date_start);
        } else {
            // Если ничего не выбрано
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
