<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// подключение библиотеки кастомных методов
use App\Models\library\Base;
// подключение модели
use App\Models\Event;
// подулючение обработчика изображений
use App\Models\library\Images;
// подключение помощника Auth
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Страница события
     * @param $event_id string идентификатор события
     * @return mixed передача данных в представление
     */
    public function getEvent($event_id)
    {
        if (Auth::id()) {
            // если пользователь авторизован, то формирование сессии из его данных
            Base::sessionRefresh();
        }

        // сборка данных со стороны сервиса
        $localstorage = Base::getLocalstorage();

        // получение данных одного события
        $event = Base::getEventPage($event_id);
        $event = Base::getEventsFinished($event);
        $event = $event->all()[0];

        // dd($event);

        // добавить просмотр события
        Base::addView($event_id);

        return view('pageEvent', [
            'localstorage' => $localstorage,
            'event' => $event,
        ]);
    }

    /**
     * Страница создания события
     * @param $r class содержит данные, отправленные из формы
     * @return mixed содержит перенаправления и передачу данных в представление
     */
    public function addEvent(Request $r)
    {
        // сборка данных со стороны авторизованного пользователя
        Base::sessionRefresh();
        // сборка данных со стороны сервиса
        $localstorage = Base::getLocalstorage();

        // если произошла отправка формы
        if ($r->isMethod('post')) {

            // валидация отправленных данных
            $validator = Base::validates('form_control_event', $r->all());

            if ($validator->fails()) {
                // если данные не валидны, то вернуть пользователя обратно на форму
                return redirect("/event/add")->withErrors($validator)->withInput();
            } else {
                // иначе создать модель события
                $event = new Event;
                // иначе наполнение данными
                $event->user_id         = session('user_id');
                $event->title           = $r->title;
                $event->description     = $r->description;
                $event->city            = $r->city;
                $event->category        = $r->category;
                $event->adress          = $r->adress;
                $event->date_start      = $r->date_start;
                $event->date_end        = $r->date_end;
                $event->time_start      = $r->time_start;
                $event->time_end        = $r->time_end;
                $event->preview         = Images::image(700, 700, 'preview', '../public/img/previews/');
                $event->price_type      = $r->price_type;
                $event->cost            = $r->cost;
                $event->goes            = 'a:0:{}';
                $event->witness         = 0;
                $event->source          = $r->source;
                $event->status          = 1;

                // преобразование селекторов формата участия
                switch ($event->price_type) {
                    case ('free');
                        $event->free    = 'checked';
                        $event->donate  = NULL;
                        $event->price   = NULL;
                        break;
                    case ('donate');
                        $event->free    = NULL;
                        $event->donate  = 'checked';
                        $event->price   = NULL;
                        break;
                    case ('price');
                        $event->free    = NULL;
                        $event->donate  = NULL;
                        $event->price   = 'checked';
                        break;
                }

                // если пользователь указал себя свидетелем
                if ($r->witness) {
                    $event->witness     = 1;
                }

                // если сохранение модели прошло успешно
                if ($event->save()) {
                    return redirect("/event/$event->id?uppopup");
                }
            }
        }

        return view('controlEvent', [
            'localstorage' => $localstorage,
            'event' => NULL
        ]);
    }

    /**
     * Страница редактирования события
     * @param $r class содержит данные, отправленные из формы
     * @param $event_id идентификатор редактируемого события
     * @return mixed содержит перенаправления и передачу данных в представление
     */
    public function editEvent(Request $r, $event_id)
    {
        // сборка данных со стороны авторизованного пользователя
        Base::sessionRefresh();
        // сборка данных со стороны сервиса
        $localstorage = Base::getLocalstorage();

        // получение модели редактируемого события
        $event = Event::find($event_id);

        // проверка: принодлежность события редактируемому пользователю (иначе можно удалять чужие события)
        if (session('user_id') != $event->user_id) {
            return redirect("/error");
        }

        // преобразование даты начала
        $date_start = explode(' ', $event->date_start);
        $date_start = $date_start[0];
        $event->date_start = $date_start;

        // преобразование даты окончания
        $date_end = explode(' ', $event->date_end);
        $date_end = $date_end[0];
        $event->date_end = $date_end;

        // если произошла отправка формы
        if ($r->isMethod('post')) {

            // валидация отправленных данных
            $validator = Base::validates('form_control_event', $r->all());

            if ($validator->fails()) {
                // если данные не валидны, то вернуть пользователя обратно на форму редактирования события
                return redirect("/event/$event_id/edit")->withErrors($validator)->withInput();
            } else {
                // иначе наполнение данными
                $event->user_id         = session('user_id');
                $event->title           = $r->title;
                $event->description     = $r->description;
                $event->city            = $r->city;
                $event->category        = $r->category;
                $event->adress          = $r->adress;
                $event->date_start      = $r->date_start;
                $event->date_end        = $r->date_end;
                $event->time_start      = $r->time_start;
                $event->time_end        = $r->time_end;
                $event->price_type      = $r->price_type;
                $event->cost            = $r->cost;
                $event->witness         = 0;
                $event->source          = $r->source;
                $event->status          = 1;

                // преобразование селекторов формата участия
                switch ($event->price_type) {
                    case ('free');
                        $event->free    = 'checked';
                        $event->donate  = NULL;
                        $event->price   = NULL;
                        break;
                    case ('donate');
                        $event->free    = NULL;
                        $event->donate  = 'checked';
                        $event->price   = NULL;
                        break;
                    case ('price');
                        $event->free    = NULL;
                        $event->donate  = NULL;
                        $event->price   = 'checked';
                        break;
                }

                // если пользователь указал себя свидетелем
                if ($r->witness) {
                    $event->witness     = 1;
                }

                // если пользователь загрузил новое изображение
                if ($r->preview) {
                    $event->preview     = Images::image(700, 700, 'preview', '../public/img/previews/');
                }

                // если сохранение модели прошло успешно
                if ($event->save()) {
                    return redirect("/event/$event_id");
                }
            }
        }

        return view('controlEvent', [
            'localstorage' => $localstorage,
            'event' => $event
        ]);
    }

    /**
     * Удаление события путем изменения его статуса опубликованности
     * @param $event_id int идентификатор редактируемого события
     * @return mixed выполняет редирект
     */
    public function removeEvent($event_id)
    {
        $user_id = session('user_id');

        // получение модели редактируемого события
        $event = Event::find($event_id);

        // изменение статуса опубликованности события
        $event->status = 0;

        // если сохранение модели прошло успешно
        if ($event->save()) {
            return redirect("/user/$user_id");
        }
    }
}
