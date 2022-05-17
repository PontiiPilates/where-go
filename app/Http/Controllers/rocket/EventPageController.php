<?php

namespace App\Http\Controllers\rocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Подключение библиотеки собственных методов (функции)
use App\Models\library\Base;

// Подключение класса Auth для возможности получения данных о статусе пользователя
use Illuminate\Support\Facades\Auth;

class EventPageController extends Controller
{
    // public function getEventPage($event_id)
    // {
    //     // Обеспечение стандартными данными: избранные пользователти
    //     $stdVarFavourites = Base::getQueries('favourites_user');
    //     // Обеспечение стандартными данными: избранные события
    //     $stdVarBookmarks = Base::getIds('bookmarks');

    //     // Получение данных одного события
    //     $event = Base::getQueries('one_event', $event_id);

    //     // Получение количества пользователей, зарегистрировавшихся на событие
    //     $count = Base::elements_count('events', $event_id, 'goes');

    //     // Получение идентификатора пользователя для возможности определения для него состояния управляющего элемента
    //     $user_id = Auth::id();

    //     // Получение идентификаторов пользователей, зарегистрировавшихся на событие для возможности определения состояния управляющего элемента для авторизованного пользователя
    //     $run_users_ids = Base::getQueries('run_users_ids', $event_id);

    //     // Предохранитель на случай того, если переменная окажется пустой
    //     if(!$run_users_ids) {
    //         $run_users_ids = array();
    //     }

    //     return view('rocketViews.eventPage', [
    //         'stdVarBookmarks' => $stdVarBookmarks,
    //         'stdVarFavourites' => $stdVarFavourites,
    //         'event' => $event,
    //         'count' => $count,
    //         'user_id' => $user_id,
    //         'run_users_ids' => $run_users_ids
    //     ]);
    // }
}
