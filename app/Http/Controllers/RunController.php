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
        $events = Base::getFirstQuery('list_event_run');

        // обработка списка событий
        $events = Base::getEventsFinished($events);

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
        return Base::addRun($event_id, 'going', 'goes');
    }

    /**
     * Удаляет участника события
     * @param $event_id int идентификатор события, от участия в котором авторизованный пользователь отказывается
     * @return string
     */
    public function removeRun($event_id)
    {
        return Base::removeRun($event_id, 'going', 'goes');
    }
}
