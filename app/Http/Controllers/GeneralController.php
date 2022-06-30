<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// подключение библиотеки кастомных методов
use App\Models\library\Base;
// подключение помощника Auth
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    /**
     * Главная страница
     * @param $r object объект класса Request
     * @return mixed
     */
    public function getEvents(Request $r)
    {
        if (Auth::id()) {
            // если пользователь авторизован, то формирование сессии из его данных
            Base::sessionRefresh();
        }

        // обращение к временному хранилищу
        $localstorage = Base::getLocalstorage();

        // получение GET-параметров
        $city = $r->city;
        $category = $r->category;
        $date_start = $r->date_start;

        // фильтрация событий
        if ($city && !$category && !$date_start) {
            // если есть город        
            $events = Base::getFirstQuery('filtrated_city', null, ['city' => $city, 'category' => $category, 'date_start' => $date_start]);
            $events = Base::eventsFinished($events);
        } elseif ($category && !$city && !$date_start) {
            // если есть категория
            $events = Base::getFirstQuery('filtrated_category', null, ['city' => $city, 'category' => $category, 'date_start' => $date_start]);
            $events = Base::eventsFinished($events);
        } elseif ($date_start && !$city && !$category) {
            // если есть дата
            $events = Base::getFirstQuery('filtrated_date', null, ['city' => $city, 'category' => $category, 'date_start' => $date_start]);
            $events = Base::eventsFinished($events);
        } elseif ($city && $category && !$date_start) {
            // если есть город и категория
            $events = Base::getFirstQuery('filtrated_city_category', null, ['city' => $city, 'category' => $category, 'date_start' => $date_start]);
            $events = Base::eventsFinished($events);
        } elseif ($city && $date_start && !$category) {
            // если есть город и дата
            $events = Base::getFirstQuery('filtrated_city_date', null, ['city' => $city, 'category' => $category, 'date_start' => $date_start]);
            $events = Base::eventsFinished($events);
        } elseif ($category && $date_start && !$city) {
            // если есть категория и дата
            $events = Base::getFirstQuery('filtrated_category_date', null, ['city' => $city, 'category' => $category, 'date_start' => $date_start]);
            $events = Base::eventsFinished($events);
        } elseif ($city && $category && $date_start) {
            // если есть город, категория и дата
            $events = Base::getFirstQuery('filtrated_city_category_date', null, ['city' => $city, 'category' => $category, 'date_start' => $date_start]);
            $events = Base::eventsFinished($events);
        } else {
            // если ничего не выбрано
            $events = Base::getFirstQuery('unfiltrated', null, ['city' => $city, 'category' => $category, 'date_start' => $date_start]);
            $events = Base::eventsFinished($events);
        }

        return view('listEvents', [
            'localstorage' => $localstorage,
            'events' => $events
        ]);
    }
}
