<?php

namespace App\Http\Controllers\rocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// подключение библиотеки собственных методов
use App\Models\library\Base;

class GeneralController extends Controller
{
    /**
     * * Главная страница
     */
    public function general(Request $r)
    {
        // формирование сессии из данных авторизованного пользователя
        Base::sessionRefresh();

        // обращение к временному хранилищу
        $localstorage = Base::getLocalstorage();

        // получение GET-параметров
        $city = $r->city;
        $category = $r->category;
        $date_start = $r->date_start;

        // фильтрация событий
        if ($city && !$category && !$date_start) {
            // если есть город        
            $events = Base::getEventsFiltrated('filtrated_city', $city, $category, $date_start);
            $events = Base::getEventsFinished($events);
        } elseif ($category && !$city && !$date_start) {
            // если есть категория
            $events = Base::getEventsFiltrated('filtrated_category', $city, $category, $date_start);
            $events = Base::getEventsFinished($events);
        } elseif ($date_start && !$city && !$category) {
            // если есть дата
            $events = Base::getEventsFiltrated('filtrated_date', $city, $category, $date_start);
            $events = Base::getEventsFinished($events);
        } elseif ($city && $category && !$date_start) {
            // если есть город и категория
            $events = Base::getEventsFiltrated('filtrated_city_category', $city, $category, $date_start);
            $events = Base::getEventsFinished($events);
        } elseif ($city && $date_start && !$category) {
            // если есть город и дата
            $events = Base::getEventsFiltrated('filtrated_city_date', $city, $category, $date_start);
            $events = Base::getEventsFinished($events);
        } elseif ($category && $date_start && !$city) {
            // если есть категория и дата
            $events = Base::getEventsFiltrated('filtrated_category_date', $city, $category, $date_start);
            $events = Base::getEventsFinished($events);
        } elseif ($city && $category && $date_start) {
            // если есть город, категория и дата
            $events = Base::getEventsFiltrated('filtrated_city_category_date', $city, $category, $date_start);
            $events = Base::getEventsFinished($events);
        } else {
            // если ничего не выбрано
            $events = Base::getQueries('all_events');
            $events = Base::getEventsFinished($events);
        }

        // передача данных в представление
        return view('rocketViews.general', [
            'events' => $events,
            'localstorage' => $localstorage
        ]);
    }
}