<?php

namespace App\Http\Controllers\rocket;

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
        $events = Base::getQueries('run_events');
        // обработка списка событий
        $events = Base::getEventsFinished($events);

        return view('rocketViews.general', [
            'localstorage' => $localstorage,
            'events' => $events,
        ]);
    }

    /**
     * Страница просмотра участников события
     * @return mixed
     */
    public function getUsers($event_id)
    {
        // сборка данных со стороны авторизованного пользователя
        Base::sessionRefresh();
        // сборка данных со стороны сервиса
        $localstorage = Base::getLocalstorage();

        // получение списка пользователей, зарегистрировавшихся на событие
        $users = Base::getQueries('run_users', $event_id);

        return view('rocketViews.userList', [
            'localstorage' => $localstorage,
            'users' => $users,
        ]);
    }

    /**
     * Добавляет участника события
     * @return string 
     */
    public function add($event_id)
    {
        return Base::addRun($event_id, 'going', 'goes');
    }

    /**
     * Удаляет участника события
     * @return string
     */
    public function remove($event_id)
    {
        return Base::removeRun($event_id, 'going', 'goes');
    }
}
