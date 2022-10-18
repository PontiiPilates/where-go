<?php

namespace App\Models\library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// подключение помощников
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;
use App\Models\Event;
use App\Models\User;

class Base extends Model
{
    /**
     * Конструктор запросов
     * Возвращает результат соответствующего запроса
     * Предназначен для хранения всех запросов к базе в одном методе
     * @param $selector string селектор запроса
     * @param $id mixed любой идентификатор или массив идентификаторов
     * @param $facets array набор фасетов
     * @return object результат запроса
     */
    static function getFirstQuery($selector, $id = null, $facets = null)
    {
        $limit = 20;
        $q = '';
        switch ($selector) {

                // селекторы первой строки
            case 'selector__бесплатно_или_донат';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.cost', NULL)
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'selector__можно_с_детьми';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.facet_child', 1)
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'selector__в_эти_выходные';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.facet_weekends', 1)
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

                // селекторы второй строки
            case 'selector__активный_отдых';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', 'Активный отдых')
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'selector__бизнес_карьера';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', 'Бизнес, карьера')
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'selector__выставки_экскурсии';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', 'Выставки, экскурсии')
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'selector__йога_медитации';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', 'Йога, медитации')
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'selector__концерты_выступления';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', 'Концерты, выступления')
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'selector__лекции_мастерклассы';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', 'Лекции, мастер-классы')
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'selector__психология_саморазвитие';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', 'Психология, саморазвитие')
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'selector__спорт_здоровье';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', 'Спорт, здоровье')
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'selector__ярмарки_фестивали';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', 'Ярмарки, фестивали')
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'selector__другое';
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', 'Другое ...')
                    // ->where('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'unfiltrated';
                // без фильтра
                $q = DB::table('events')
                    ->where('status', 1)
                    // ->where('date_start', '>=', date('Y-m-d'))
                    // ->where('date_end', '>=', date('Y-m-d'))
                    // ->orWhere('date_start', '>=', date('Y-m-d'))
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;
            case 'list_users_favourites';
                // получение некоторых данных избранных пользователей
                $q = DB::table('profiles')
                    ->whereIn('user_id', $id)
                    ->join('users', 'profiles.user_id', '=', 'users.id')
                    ->select(
                        'users.id',
                        'users.name',
                        'profiles.avatar'
                    )
                    ->get();
                break;
            case 'list_events_run';
                // получение списка событий, на которые зарегистрирован пользователь
                $q = DB::table('events')
                    ->whereIn('events.id', session('going'))
                    ->where('status', 1)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->get()
                    ->all();
                break;
            case 'list_users_run';
                // получение идентификаторов участников события
                $q1 = DB::table('events')
                    ->where('id', $id)
                    ->where('status', 1)
                    ->select('goes')
                    ->get()
                    ->all()[0]
                    ->goes;
                // получение некоторых данных участников события
                $q = self::getFirstQuery('list_users_favourites', unserialize($q1))->all();
                break;
            case 'list_events_user';
                // получение всех событий пользователя
                $q = DB::table('events')
                    ->where('events.status', 1)
                    ->where('events.user_id', $id)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select(
                        'events.id',
                        'events.title',
                        'events.preview',
                        'events.user_id',
                        'users.name',
                        'profiles.avatar',
                        'events.category',
                        'events.description',
                        'events.city',
                        'events.adress',
                        'events.date_start',
                        'events.date_end',
                        'events.time_start',
                        'events.time_end',
                        'events.price_type',
                        'events.cost',
                        'events.goes',
                        'events.witness',
                        'events.source',
                        'events.counter',
                        'events.counter_fake',
                    )
                    ->orderByDesc('date_start')
                    ->simplePaginate($limit);
                break;
            case 'list_events_bookmarks';
                // получение событий, добавленных в закладки авторизованным пользователем
                $q = DB::table('events')
                    ->whereIn('events.id', session('bookmarks'))
                    ->where('status', 1)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select(
                        'events.id',
                        'events.title',
                        'events.preview',
                        'events.user_id',
                        'users.name',
                        'profiles.avatar',
                        'events.category',
                        'events.description',
                        'events.city',
                        'events.adress',
                        'events.date_start',
                        'events.date_end',
                        'events.time_start',
                        'events.time_end',
                        'events.price_type',
                        'events.cost',
                        'events.goes',
                        'events.witness',
                        'events.source',
                        'events.counter',
                        'events.counter_fake',
                    )
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;
            case 'page_event';
                // получение данных для формирования страницы события
                $q = DB::table('events')
                    ->where('events.id', $id)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('users.name', 'profiles.*', 'events.*')
                    ->get();
                break;
            case 'page_user';
                // получение данных для формирования страницы пользователя
                $q = DB::table('profiles')
                    ->where('user_id', $id)
                    ->join('users', 'profiles.user_id', '=', 'users.id')
                    ->select(
                        'profiles.user_id',
                        'profiles.avatar',
                        'profiles.about',
                        'profiles.phone',
                        'profiles.phone_checked',
                        'profiles.telegram',
                        'profiles.telegram_checked',
                        'profiles.vk',
                        'profiles.vk_checked',
                        'profiles.whatsapp',
                        'profiles.whatsapp_checked',
                        'users.name'
                    )
                    ->get();
                break;
            case 'session';
                // получение данных авторизованного пользователя
                $q = DB::table('profiles')
                    ->where('user_id', $id)
                    ->join('users', 'profiles.user_id', '=', 'users.id')
                    ->select(
                        'users.name',
                        'users.email',
                        'profiles.avatar',
                        'profiles.about',
                        'profiles.bookmarks',
                        'profiles.favourites',
                        'profiles.follovers',
                        'profiles.going',
                        'profiles.witness',
                        'profiles.phone',
                        'profiles.phone_checked',
                        'profiles.telegram',
                        'profiles.telegram_checked',
                        'profiles.whatsapp',
                        'profiles.whatsapp_checked',
                        'profiles.vk',
                        'profiles.vk_checked',
                        'profiles.notifications',
                    )
                    ->get()[0];
                break;
        }
        return $q;
    }

    /**
     * Постобработчик
     * Преобразует список событий до удобно применяемого состояния
     * Содержит все обработки, которые ранее выполнялись представлением
     * @param $events object список событий, которые вернул сырой запрос
     * @return mixed список событий с обработанными данными
     */
    static function eventsFinished($events)
    {
        // вспомогательный массив имен месяцев
        $month = [
            1 => 'января',
            2 => 'февраля',
            3 => 'марта',
            4 => 'апреля',
            5 => 'мая',
            6 => 'июня',
            7 => 'июля',
            8 => 'августа',
            9 => 'сентября',
            10 => 'октября',
            11 => 'ноября',
            12 => 'декабря',
        ];

        // обход полученных событий
        foreach ($events as $event) {

            // получение списка идентификаторов участников
            $goes = unserialize($event->goes);

            // формирование списка идентификаторов участников
            $event->goes = $goes;

            // формирование счетчика участников
            $event->count_goes = count($goes);

            // преобразование категории
            // $event->category = explode(',', $event->category);

            // формирование отметки о том, что событие прошло: когда дата окончания и дата начала больше текущей
            if (strtotime($event->date_end) + 86400 < time() && strtotime($event->date_start) + 86400 < time()) {
                $event->last = 1;
            } else {
                $event->last = 0;
            }

            // преобразование даты начала
            $date_start = strtotime($event->date_start);
            $d = date('d', $date_start);
            $n = date('n', $date_start);
            $m = $month[$n];
            $y = date('Y', $date_start);
            // $event->date_start = $d . ' ' . $m . ' ' . $y;
            $event->date_start = $d . ' ' . $m;

            // преобразование даты окончания
            if ($event->date_end) {
                $date_end = strtotime($event->date_end);
                $d = date('d', $date_end);
                $n = date('n', $date_end);
                $m = $month[$n];
                $y = date('Y', $date_end);
                // $event->date_end = $d . ' ' . $m . ' ' . $y;
                $event->date_end = $d . ' ' . $m;
            }

            // dd($event->date_end);

            // преобразование времени начала
            if ($event->time_start) {
                $time_start = substr($event->time_start, 0, 5);
                $event->time_start = 'в ' . $time_start;
            }

            // преобразование времени окончания
            if ($event->time_end) {
                $time_end = substr($event->time_end, 0, 5);
                $event->time_end = 'в ' . $time_end;
            }

            // если пользователь авторизован, то добавить к наполнению localstorage его данные
            if (Auth::id()) {

                // преобразование состояния закладки в зависимости от наличия события в закладках авторизованного полььзователя
                if (in_array($event->id, session('bookmarks'))) {
                    $event->state_bookmark = 'bi-bookmark-check-fill';
                } else {
                    $event->state_bookmark = 'bi-bookmark';
                }

                // проверка участия авторизованного пользователя в событии
                if (in_array(Auth::id(), $goes)) {
                    $event->run = 1;
                } else {
                    $event->run = 0;
                }

                // проверка: является ли событие созданным авторизованным пользователем
                if (Auth::id() == $event->user_id) {
                    $event->my = 1;
                } else {
                    $event->my = 0;
                }
            }

            // формирование условия участия
            if ($event->price_type == 'free') {
                $event->participant = 'бесплатно';
            } elseif ($event->price_type == 'donate') {
                $event->participant = 'за донат';
            } elseif ($event->price_type == 'price') {
                $event->participant = "$event->cost руб.";
            }
        }
        return $events;
    }

    /**
     * Отметка о прочтении уведомления
     * @param int 
     */
    static function notificationRead($event_id)
    {
        // ! проверка: авторизован ли пользователь
        if (Auth::id()) {
            // обход уведомлений
            foreach (session('notifications_unread') as $k => $notification) {
                if ($notification->data['event'] == $event_id) {
                    // отметка о прочтении
                    session('notifications_unread')[$k]->markAsRead();
                }
            }
        }
    }

    /**
     * Пользовательское сфойство сортировки массива
     * Для сортировки элементов на основе наличия уведомлений:
     * Сверху те, у которых есть маркер
     */
    static function sort_nmu($a, $b)
    {
        $a = $a->id;
        $b = session('notifications_marks_users');

        if (!in_array($a, $b)) {
            return 1;
        }
    }

    /**
     * Сессия
     * Обновляет данные сессии при каждом новом запросе
     * Для осуществления сквозного доступа к данным авторизованного пользователя
     */
    static function sessionRefresh()
    {
        // получение идентификатора авторизованного пользователя
        $user_id = Auth::id();

        // если пользователь авторизован, то продолжить формирование сессии
        if ($user_id) {

            // получение данных авторизованного пользователя
            $auth = self::getFirstQuery('session', $user_id);

            // получение модели авторизованного пользователя
            $user = User::find($user_id);

            // преобразование списка идентификаторов избранных пользователей
            $favourites_list = unserialize($auth->favourites);

            // формирование списка пользователей, от которых есть уведомления
            $notifications_marks_users = array();
            foreach ($user->unreadNotifications as $k => $v) {
                if (!in_array($v->data['author'], $notifications_marks_users)) {
                    $notifications_marks_users[] = $v->data['author'];
                }
            }
            session(['notifications_marks_users' => $notifications_marks_users]);

            // формирование списка новых событий
            $notifications_marks_events = array();
            foreach ($user->unreadNotifications as $k => $v) {
                if (!in_array($v->data['event'], $notifications_marks_events)) {
                    $notifications_marks_events[] = $v->data['event'];
                }
            }
            session(['notifications_marks_events' => $notifications_marks_events]);

            // получение некоторых данных избранных пользователей на основе преобразованных значений
            $favourites_obj = self::getFirstQuery('list_users_favourites', $favourites_list);
            // подготовка данных
            $favourites_obj = $favourites_obj->all();
            // если есть непрочитанные уведомления
            if ($user->unreadNotifications) {
                // сортировка массива на основе наличия уведомлений
                usort($favourites_obj, [Base::class, 'sort_nmu']);
            }
            session(['favourites_obj' => $favourites_obj]);

            // сборка сессии
            session(['user_id' => $user_id]);
            session(['name' => $auth->name]);
            session(['email' => $auth->email]);
            session(['avatar' => $auth->avatar]);
            session(['about' => $auth->about]);
            session(['bookmarks' => unserialize($auth->bookmarks)]);
            session(['favourites_list' => $favourites_list]);
            session(['follovers' => unserialize($auth->follovers)]);
            session(['going' => unserialize($auth->going)]);
            session(['witness' => $auth->witness]);
            session(['phone' => $auth->phone]);
            session(['phone_checked' => $auth->phone_checked]);
            session(['telegram' => $auth->telegram]);
            session(['telegram_checked' => $auth->telegram_checked]);
            session(['whatsapp' => $auth->whatsapp]);
            session(['whatsapp_checked' => $auth->whatsapp_checked]);
            session(['vk' => $auth->vk]);
            session(['vk_checked' => $auth->vk_checked]);

            // группа уведомлений
            session(['notifications_unread' => $user->unreadNotifications]);
        }
    }

    /**
     * Проверка: существует ли целевой объект
     * @param string $selector селктор выбора кейса
     * @param int $id идентификатор целевого объекта
     */
    static function checkIsset($selector, $id)
    {
        switch ($selector) {
            case 'event';
                // проверка существования события, иначе 404
                Event::findOrFail($id);
                break;
            case 'user';
                // проверка существования пользователя, иначе 404
                User::findOrFail($id);
                break;
        }
    }

    /**
     * Проверка: принадлежит ли событие авторизованному пользователю
     * Важно для безопасности
     * Используется при:
     * - редактировании профиля
     * - редактировании события
     * - удалении события
     * @param int $user_id
     */
    static function checkOwner($user_id)
    {
        if (Auth::id() != $user_id) {
            abort(403);
        }
    }

    /**
     * * Соглашение о терминологии
     * 
     * * auth - авторизованный пользователь
     * * user - другой зарегистрированный пользователь
     * * author - автор события
     * * guest - гость
     *
     * * subscribe - подписка
     * * favourite - избранный пользователь
     * * follover - подписчик
     */

    /**
     * Реверсивный
     * Производит запись в базу и / или удаление этой записи
     * Предназначен для реализации (регистрации участия, подписок, закладок)
     * @param $selector string
     * @param $control string
     * @param $id int
     * @return $msg array
     * TODO: если указать id не существующего пользователя, то скрипт не сможет обратиться к этой строке в базе данных
     */
    static function reversible($selector, $control, $id)
    {
        // итерация
        $i = 0;
        // формирование групп дпнных для обхода и применения (порядок имеет значение)
        switch ($selector) {
            case 'run';
                // для участия
                $models = [
                    Event::find($id),
                    Profile::firstWhere('user_id', session('user_id')),
                ];
                $columns = [
                    'goes',
                    'going',
                ];
                $values = [
                    session('user_id'),
                    $id
                ];
                break;
            case 'bookmarks';
                // для закладок
                $models = [
                    Profile::firstWhere('user_id', session('user_id')),
                ];
                $columns = [
                    'bookmarks',
                ];
                $values = [
                    $id
                ];
                break;
            case 'favourites';
                // для подписок
                $models = [
                    Profile::firstWhere('user_id', $id),
                    Profile::firstWhere('user_id', session('user_id')),
                ];
                $columns = [
                    'follovers',
                    'favourites',
                ];
                $values = [
                    session('user_id'),
                    $id
                ];
                break;
        }
        // сценарий добавления
        if ($control == 'add') {
            // обход групп данных
            foreach ($models as $model) {
                // извлечение данных из модели
                $column = $columns[$i];
                $data = $model->$column;
                $data = unserialize($data);
                // добавление
                $data[] = $values[$i];
                // упаковка обновлённых данных
                $data = serialize($data);
                $model->$column = $data;
                // если модель сохранена успешно, то создать сообщение
                if ($model->save()) {
                    // для отладки
                    // $msg[] = "Добавлено значение <b>$values[$i]</b> в колонку <b>$column</b>";
                    // для продакшена
                    $msg = '';
                }
                // итерация
                $i++;
            }
        }
        // сценарий удаления
        if ($control == 'remove') {
            // обход групп данных
            foreach ($models as $model) {
                // извлечение данных из модели
                $column = $columns[$i];
                $data = $model->$column;
                $data = unserialize($data);
                // удаление
                foreach ($data as $k => $v) {
                    if ($v == $values[$i]) {
                        unset($data[$k]);
                    }
                }
                // упаковка обновлённых данных
                $data = serialize($data);
                $model->$column = $data;
                // если модель сохранена успешно, то создать сообщение
                if ($model->save()) {
                    // для отладки
                    // $msg[] = "Удалено значение <b>$values[$i]</b> из колонки <b>$column</b>";
                    // для продакшена
                    $msg = '';
                }
                // итерация
                $i++;
            }
        }
        return $msg;
    }

    /**
     * Локалсторадж
     * Централизованное хранилище не до конца определенных данных
     * Для каждой страницы
     * @return mixed
     */
    static function getLocalstorage()
    {







        $localstorage = array(
            'meta' => array(
                'title' => NULL,
                // 'title_default' => 'Where-go',
                // 'title_default' => 'Куда сходить в Красноярске - лента событий и мероприятий | Where-go',
                'title_default' => 'Where-go | поиск мероприятий в Красноярске',
                'description' => NULL,
                // 'description_default' => 'Лента событий Красноярска. Ищишь куда сходить? Здесь все мероприятия собраны в одном месте. Просто найди подходящее.',
                // 'description_default' => 'Хочешь найти куда сходить в Красноярске в 2022 году? Все события собраны здесь! Удобный фильтр по дате и категории. Смотри ленту и выбирай что нравится.',
                // 'description_default' => 'Социальная сеть для создания и поиска событий и мероприятий в Красноярске: туры, походы, экскурсии, выставки, ярмарки, фестивали, сплавы, выходные, с детьми.',
                'description_default' => 'Поиск мероприятий в Красноярске. Походы, сплавы, экскурсии, фестивали, выставки, тренинги, мастер-классы, ярмарки, выходные, с детьми. Бесплатное размещение мероприятий.',
                // 'keywords' => 'куда сходить, куда сходить в красноярске, куда можно сходить в красноярске, мероприятия сегодня, мероприятия в красноярске, события, свежие события, события сегодня, события лента, события красноярск',
                'keywords' => 'поиск, мероприятия, экскурсии, выставки, походы, сплавы, хайкинг, тренинги, мастер-классы, бесплатно, торгашинский хребет, столбы, мана, енисей, красноярское море, красноярск',
            ),

            'categories' => array(
                'Активный отдых',
                'Бизнес, карьера',
                'Выставки, экскурсии',
                'Йога, медитации',
                'Концерты, выступления',
                'Лекции, мастер-классы',
                'Психология, саморазвитие',
                'Спорт, здоровье',
                'Ярмарки, фестивали',
                'Другое ...',
            ),

            'selectors' => array(
                'row_first' => array(
                    'Бесплатно или донат' => Base::getFirstQuery('selector__бесплатно_или_донат')->count(),
                    'Можно с детьми' => Base::getFirstQuery('selector__можно_с_детьми')->count(),
                    'В эти выходные' => Base::getFirstQuery('selector__в_эти_выходные')->count(),
                ),
                'row_second' => array(
                    'Активный отдых' => Base::getFirstQuery('selector__активный_отдых')->count(),
                    'Бизнес, карьера' => Base::getFirstQuery('selector__бизнес_карьера')->count(),
                    'Выставки, экскурсии' => Base::getFirstQuery('selector__выставки_экскурсии')->count(),
                    'Йога, медитации' => Base::getFirstQuery('selector__йога_медитации')->count(),
                    'Концерты, выступления' => Base::getFirstQuery('selector__концерты_выступления')->count(),
                    'Лекции, мастер-классы' => Base::getFirstQuery('selector__лекции_мастерклассы')->count(),
                    'Психология, саморазвитие' => Base::getFirstQuery('selector__психология_саморазвитие')->count(),
                    'Спорт, здоровье' => Base::getFirstQuery('selector__спорт_здоровье')->count(),
                    'Ярмарки, фестивали' => Base::getFirstQuery('selector__ярмарки_фестивали')->count(),
                    'Другое ...' => Base::getFirstQuery('selector__другое')->count(),
                ),

            ),
        );
        return $localstorage;
    }

    /**
     * Счетчик подписчиков
     * Получает количество подписчиков
     * @param int $user_id идентификатор пользователя
     * @return int количество подписчиков
     */
    static function getCountFollovers($user_id)
    {
        // получение модели
        $profile = Profile::firstWhere('user_id', $user_id);
        // получение данных о подписчиках
        $follovers = $profile->follovers;
        // преобразование данных
        $follovers = unserialize($follovers);
        // подсчёт элементов
        $count = count($follovers);
        return $count;
    }

    /**
     * Счетчик событий
     * Получает количество событий, созданных пользователем
     * @param $user_id int идентификатор пользователя
     * @return int количество событий
     */
    static function getCountEvents($user_id)
    {
        // получение модели и сразу получение количества событий
        $events = Event::where('user_id', $user_id)->count();
        return $events;
    }

    /**
     * Просмотр
     * Добавляет 1 просмотр события
     * @param $event_id идентификатор события
     */
    static function addView($event_id)
    {
        // получение модели события
        $action = Event::find($event_id);
        // извлечение количества просмотров
        $views_count = $action->counter;
        // добавление 1-го просмотра
        $views_count++;
        // применение нового количества просмотров к модели
        $action->counter = $views_count;
        // запись модели в базу данных
        $action->save();
    }

    /**
     * Валидатор
     * Валидирует данные выбранной формы
     * @param $selector string селктор набора валидирующих правил
     * @param $fields object экземпляр коасса Request: $r->all()
     * @return mixed
     */
    static function validates($selector, $fields)
    {
        switch ($selector) {
            case 'form_control_event';
                // правила валидации формы управления событием
                $validator = Validator::make($fields, [
                    'preview'                   => 'mimes:jpeg,png',                                            // должно быть в формате jpeg или png
                    'title'                     => 'required|min:3',                                            // TODO: указать нежелательные символы
                    'description'               => 'required|min:10',                                           // TODO: указать нежелательные символы
                    // 'city'                      => 'required',                                                  // обязательно
                    'category'                  => 'required',                                                  // обязательно
                    'adress'                    => 'required',                                                  // обязательно
                    'date_start'                => 'required',                                                  // обязательно
                    'time_start'                => 'nullable',                                                  // проверяемое поле может быть NULL
                    'date_end'                  => 'nullable',                                                  // проверяемое поле может быть NULL
                    'time_end'                  => 'nullable',                                                  // проверяемое поле может быть NULL
                    'price_type'                => 'required',                                                  // обязательно
                    'cost'                      => 'required_if:price_type,==,price|regex:/^[0-9]+$/',          // обязательно если выбран радио + целое число
                ]);
                break;
            case 'form_control_profile';
                // правила валидации формы управления профилем авторизованного пользователя
                $validator = Validator::make($fields, [
                    'avatar'                    => 'mimes:jpeg,png',                                            // должно быть в формате jpeg или png
                    'about'                     => 'min:10',                                                    // должно быть в формате jpeg или png
                    'phone'                     => 'nullable',                                                  // TODO: проверить на номер телефона
                    'phone_checked'             => 'nullable',                                                  // TODO: проверить регулярным выражением на 0 или 1
                    'telegram'                  => 'nullable',                                                  // TODO: проверить на номер телефона или никнейм
                    'telegram_checked'          => 'nullable',                                                  // TODO: проверить регулярным выражением на 0 или 1
                    'vk'                        => 'nullable',                                                  // TODO: проверить на никнейм или id
                    'vk_checked'                => 'nullable',                                                  // TODO: проверить регулярным выражением на 0 или 1
                    'whatsapp'                  => 'nullable',                                                  // TODO: проверить на никнейм или id
                    'whatsapp_checked'          => 'nullable',                                                  // TODO: проверить регулярным выражением на 0 или 1
                ]);
                break;
            case 'form_change_password';
                // правила валидации для формы изменения пароля
                $validator = Validator::make($fields, [
                    'current_password'          => 'current_password|min:3',                                    // проверяет введенный пароль на соответствие текущему
                    'password_confirmation'     => 'min:3',                                                     // валидация введенного пароля
                    'password'                  => 'confirmed|min:3',                                           // проверка введенного пароля на соответсвие введенному ранее
                ]);
                break;
            case 'form_change_email';
                // правила валидации для формы изменения почты
                $validator = Validator::make($fields, [
                    'email'                     => 'email:rfc,dns',                                             // валидирует email, в том числе на соответствие доменных зон
                ]);
                break;
        }
        return $validator;
    }
}
