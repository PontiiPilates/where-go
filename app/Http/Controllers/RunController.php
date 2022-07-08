<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// подключение библиотеки кастомных методов
use App\Models\library\Base;

class RunController extends Controller
{
    /**
     * Страница событий, в которых пользователь принимает участие
     * @return mixed
     */
    public function getEvents()
    {
        // сборка данных со стороны авторизованного пользователя
        Base::sessionRefresh();
        // сборка данных со стороны сервиса
        $localstorage = Base::getLocalstorage();

        // получение списка событий
        $events = Base::getFirstQuery('list_events_run');

        // обработка списка событий
        $events = Base::eventsFinished($events);

        // формирование meta-тегов
        $user_name = session('name');
        $localstorage['meta']['title'] = $user_name;
        $localstorage['meta']['description'] = "события, в которых пользователь $user_name принимает участие";

        return view('listEvents', [
            'localstorage' => $localstorage,
            'events' => $events,
        ]);
    }

    /**
     * Страница просмотра участников события
     * @param $event_id int идентификатор события, в котором пользователи принимают участие
     * @return mixed
     */
    public function getUsers($event_id)
    {
        // сборка данных со стороны авторизованного пользователя
        Base::sessionRefresh();
        // сборка данных со стороны сервиса
        $localstorage = Base::getLocalstorage();

        // получение списка пользователей, зарегистрировавшихся на событие
        $users = Base::getFirstQuery('list_users_run', $event_id);

        return view('listUsers', [
            'localstorage' => $localstorage,
            'users' => $users,
        ]);
    }

    /**
     * Добавляет участника события
     * @param $event_id int идентификатор события, в котором авторизованный пользователь принимает участие
     * @return string 
     */
    public function addRun($event_id)
    {
        return Base::reversible('run', 'add', (int) $event_id);
    }

    /**
     * Удаляет участника события
     * @param $event_id int идентификатор события, от участия в котором авторизованный пользователь отказывается
     * @return string
     */
    public function removeRun($event_id)
    {
        return Base::reversible('run', 'remove', (int) $event_id);
    }
}
