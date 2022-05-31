<?php

namespace App\Http\Controllers\rocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Подключение библиотеки собственных методов (функции)
use App\Models\library\Base;

// Подключение класса Auth для возможности получения данных о статусе пользователя
use Illuminate\Support\Facades\Auth;

// Подключение модели таблицы Events
use App\Models\Event;

// Подключение модели таблицы Profile
use App\Models\Profile;

// Подулючение класса Image для обработки изображений
use App\Models\library\Images;

// Подключение класса Validator для управления валидацией
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * * Вывод страницы события
     */
    public function get($event_id)
    {
        // * Снабжение контроллера стандартными данными авторизованного пользователя (идентификатор авторизованного пользователя)
        $auth_id = Auth::id();

        // * Снабжение контроллера стандартными данными авторизованного пользователя (подписки)
        $stdVarFavourites = Base::getQueries('favourites_user');

        // * Снабжение контроллера стандартными данными авторизованного пользователя (закладки)
        $stdVarBookmarks = Base::getIds('bookmarks');

        $std_avatar = '';
        if ($auth_id) {
            // * Получение данных пользователя
            $user = Base::getQueries('user', $auth_id);
            // * Получение имени аватара авторизованного пользователя
            $std_avatar = $user->avatar;
        }


        // Получение данных одного события
        $event = Base::getQueries('one_event', $event_id);

        // Получение количества пользователей, зарегистрировавшихся на событие
        $count = Base::elements_count('events', $event_id, 'goes');

        // Получение идентификаторов пользователей, зарегистрировавшихся на событие для возможности определения состояния управляющего элемента для авторизованного пользователя
        $run_users_ids = Base::getQueries('run_users_ids', $event_id);

        // Предохранитель на случай того, если переменная окажется пустой
        if (!$run_users_ids) {
            $run_users_ids = array();
        }

        // Добавить просмотр события и вывести новое значение
        $views_count = Base::addView($event_id);

        return view('rocketViews.eventPage', [
            'stdVarBookmarks' => $stdVarBookmarks,
            'stdVarFavourites' => $stdVarFavourites,
            'event' => $event,
            'count' => $count,
            'user_id' => $auth_id,
            'run_users_ids' => $run_users_ids,
            'std_avatar' => $std_avatar,
            'views_count' => $views_count,
        ]);
    }

    /**
     * * Добавление события
     */
    public function add(Request $r)
    {
        // * Снабжение контроллера идентификатором авторизованного пользователя
        // * Лучше сделать это сразу, поскольку он используется далее несколько раз
        $auth_id = Auth::id();

        // * Снабжение контроллера стандартными данными авторизованного пользователя (подписки)
        $stdVarFavourites = Base::getQueries('favourites_user');

        // * Снабжение контроллера данными авторизованного пользователя, необходимыми для обеспечения функционала формы
        $user_witness = Profile::firstWhere('user_id', $auth_id);
        // Получение отметки о том, может ли авторизованный пользователь быть свидетелем
        $user_witness = $user_witness->witness;

        // Если произошла отправка формы
        if ($r->isMethod('post')) {

            // Определение правил валидации
            $validator = Validator::make($r->all(), [
                'preview'           => 'mimes:jpeg,png',                                        // должно быть в формате jpeg или png
                'title'             => 'required|min:3',                                        // TODO: указать нежелательные символы
                'description'       => 'required|min:10',                                       // TODO: указать нежелательные символы
                'city'              => 'required',                                              // обязательно
                'category'          => 'required',                                              // обязательно
                'adress'            => 'required',                                              // обязательно
                'date_start'        => 'required',                                              // обязательно
                'time_start'        => 'nullable',                                              // проверяемое поле может быть NULL
                'date_end'          => 'nullable',                                              // проверяемое поле может быть NULL
                'time_end'          => 'nullable',                                              // проверяемое поле может быть NULL
                'price_type'        => 'required',                                              // обязательно
                'cost'              => 'required_if:price_type,==,price|regex:/^[0-9]+$/',      // обязательно если выбран радио + целое число
            ]);

            // Реализации валидации
            if ($validator->fails()) {

                // Если есть ошибки, то вернуть пользователя обратно на форму
                return redirect("/event/add")
                    ->withErrors($validator)
                    ->withInput();

                // Если нет ошибок валидации
            } else {

                // Создание модели для таблицы Events
                $event = new Event;

                // Наполнение модели данными
                $event->user_id         = $auth_id;                                                         // создатель события
                $event->title           = $r->title;                                                        // заголовок
                $event->description     = $r->description;                                                  // описание
                $event->city            = $r->city;                                                         // город
                $event->category        = $r->category;                                                     // категория
                $event->adress          = $r->adress;                                                       // адрес
                $event->date_start      = $r->date_start;                                                   // дата начала события
                $event->date_end        = $r->date_end;                                                     // дата окончания события
                $event->time_start      = $r->time_start;                                                   // время начала события
                $event->time_end        = $r->time_end;                                                     // время окончания события
                $event->preview         = Images::image(575, 575, 'preview', '../public/img/previews/');    // загруженное изображение
                $event->price_type      = $r->price_type;                                                   // форма оплаты за участие
                $event->cost            = $r->cost;                                                         // стомсость участия
                $event->goes            = 'a:0:{}';                                                         // зарегистрировавшиеся
                $event->witness         = 0;                                                                // свидетель события
                $event->status          = 1;                                                                // статус опубликованности события

                // Если пользователь указал, что он свидетель
                if ($r->event_witness) {
                    $event->witness     = 1;
                }

                // Сохранение модели в таблицу
                if ($event->save()) {
                    // Получение идентификатора только что созданной записи в базе данных
                    $new_event_id = $event->id;
                    // Перенаправить ползователя на страницу созданного события
                    return redirect("/event/$new_event_id?uppopup");
                }
            }
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

        // Передача данных во view
        return view('rocketViews.eventAdd', [
            'stdVarFavourites' => $stdVarFavourites,
            'user_witness' => $user_witness,
            'stdAvatar' => $std_avatar,
            'userId' => $user_id,
        ]);
    }

    /**
     * * Редактирование события
     * TODO: сделать проверку на то, что материал принадлежит авторизованному пользователю
     * TODO: сделать маршруту проверку на авторизованность
     */
    public function edit(Request $r, $event_id)
    {
        // * Снабжение контроллера идентификатором авторизованного пользователя
        // * Лучше сделать это сразу, поскольку он используется далее несколько раз
        $auth_id = Auth::id();

        // * Снабжение контроллера стандартными данными авторизованного пользователя (подписки)
        $stdVarFavourites = Base::getQueries('favourites_user');

        // * Снабжение контроллера данными авторизованного пользователя, необходимыми для обеспечения функционала формы
        $user_witness = Profile::firstWhere('user_id', $auth_id);
        // Получение отметки о том, может ли авторизованный пользователь быть свидетелем
        $user_witness = $user_witness->witness;

        // * Снабжение контроллера данными редактируемого события
        $event = Event::find($event_id);

        $std_avatar = '';
        if ($auth_id) {
            // * Получение данных пользователя
            $user = Base::getQueries('user', $auth_id);
            // * Получение имени аватара авторизованного пользователя
            $std_avatar = $user->avatar;
        }

        // Если произошла отправка формы
        if ($r->isMethod('post')) {

            // Определение правил валидации
            $validator = Validator::make($r->all(), [
                'preview'           => 'mimes:jpeg,png',                                        // должно быть в формате jpeg или png
                'title'             => 'required|min:3',                                        // TODO: указать нежелательные символы
                'description'       => 'required|min:10',                                       // TODO: указать нежелательные символы
                'city'              => 'required',                                              // обязательно
                'category'          => 'required',                                              // обязательно
                'adress'            => 'required',                                              // обязательно
                'date_start'        => 'required',                                              // обязательно
                'time_start'        => 'nullable',                                              // проверяемое поле может быть NULL
                'date_end'          => 'nullable',                                              // проверяемое поле может быть NULL
                'time_end'          => 'nullable',                                              // проверяемое поле может быть NULL
                'price_type'        => 'required',                                              // обязательно
                'cost'              => 'required_if:price_type,==,price|regex:/^[0-9]+$/',      // обязательно если выбран радио + целое число
            ]);

            // Реализации валидации
            if ($validator->fails()) {

                // Если есть ошибки, то вернуть пользователя обратно на форму
                return redirect("/event/$event_id/edit")
                    ->withErrors($validator)
                    ->withInput();

                // Если нет ошибок валидации
            } else {

                $event->user_id         = $auth_id;                                                         // создатель события
                $event->title           = $r->title;                                                        // заголовок
                $event->description     = $r->description;                                                  // описание
                $event->city            = $r->city;                                                         // город
                $event->category        = $r->category;                                                     // категория
                $event->adress          = $r->adress;                                                       // адрес
                $event->date_start      = $r->date_start;                                                   // дата начала события
                $event->date_end        = $r->date_end;                                                     // дата окончания события
                $event->time_start      = $r->time_start;                                                   // время начала события
                $event->time_end        = $r->time_end;                                                     // время окончания события
                $event->price_type      = $r->price_type;                                                   // форма оплаты за участие
                $event->cost            = $r->cost;                                                         // стомсость участия
                $event->witness         = 0;                                                                // свидетель события
                $event->status          = 1;                                                                // статус опубликованности события

                // Если пользователь указал, что он свидетель
                if ($r->event_witness) {
                    $event->witness     = 1;
                }

                // Если пользователь загрузил новое изображение
                if ($r->preview) {
                    $event->preview     = Images::image(575, 575, 'preview', '../public/img/previews/');
                }

                // Сохранение модели в таблицу
                if ($event->save()) {
                    // Перенаправить ползователя на страницу редактируемого события
                    return redirect("/event/$event_id");
                }
            }
        }

        // Передача данных во view
        return view('rocketViews.eventEdit', [
            'stdVarFavourites' => $stdVarFavourites,
            'event' => $event,
            'user_witness' => $user_witness,
            'std_avatar' => $std_avatar,
            'user_id' => $auth_id,
        ]);
    }

    /**
     * * Удаление события путем изменения его статуса опубликованности
     */
    public function remove($event_id)
    {
        // * Снабжение контроллера идентификатором авторизованного пользователя
        // * Лучше сделать это сразу, поскольку он используется далее несколько раз
        $auth_id = Auth::id();

        // * Снабжение контроллера данными редактируемого события
        $event = Event::find($event_id);

        // статус опубликованности события
        $event->status = 0;

        // Сохранение модели в таблицу
        if ($event->save()) {
            // Перенаправить ползователя на страницу редактируемого события
            // return "Event id: $event_id is publication status $event->status";
            return redirect("/user/$auth_id");
        }
    }
}
