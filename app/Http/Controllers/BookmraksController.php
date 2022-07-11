<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// подключение библиотеки кастомных методов
use App\Models\library\Base;
// подключение помощника
use Illuminate\Support\Facades\Auth;

class BookmraksController extends Controller
{
    /**
     * Страница закладок
     * @return mixed
     */
    public function getEvents()
    {
        // сборка данных со стороны авторизованного пользователя
        Base::sessionRefresh();
        // сборка данных со стороны сервиса
        $localstorage = Base::getLocalstorage();

        // получение идентификатора авторизованного пользователя
        $user_id = Auth::id();

        // получение списка событий, которые авторизованный пользователь добавил в закладки
        $events = Base::getFirstQuery('list_events_bookmarks', $user_id);
        $events = Base::eventsFinished($events);

        // формирование meta-тегов
        $user_name = session('name');
        $localstorage['meta']['title'] = $user_name;
        $localstorage['meta']['description'] = "События, которые $user_name добавил в закладки";

        return view('listEvents', [
            'localstorage' => $localstorage,
            'events' => $events
        ]);
    }

    /**
     * Добавляет событие в закладки
     * @param $event_id int идентификатор события
     * @return string
     */
    public function addBookmark($event_id)
    {
        // проверка существования события, иначе 404
        Base::checkIsset('event', $event_id);

        return Base::reversible('bookmarks', 'add', (int) $event_id);
    }

    /**
     * Удаляет событие из закладок
     * @param $event_id int идентификатор события
     * @return string
     */
    public function removeBookmark($event_id)
    {
        // проверка существования события, иначе 404
        Base::checkIsset('event', $event_id);

        return Base::reversible('bookmarks', 'remove', (int) $event_id);
    }
}
