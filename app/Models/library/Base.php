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
        $limit = 30;

        switch ($selector) {

            case 'filtrated_city';
                // фильтр по городу
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.city', $facets['city'])
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'filtrated_category';
                // фильтр по категории
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', $facets['category'])
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'filtrated_date';
                // фильтр по дате
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('date_start', '>=', $facets['date_start'])
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'filtrated_city_category';
                // фильтр по городу и категории
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.city', $facets['city'])
                    ->where('events.category', $facets['category'])
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'filtrated_city_date';
                // фильтр по городу и дате
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.city', $facets['city'])
                    ->where('date_start', '>=', $facets['date_start'])
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'filtrated_category_date';
                // фильтр по категории и дате
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', $facets['category'])
                    ->where('date_start', '>=', $facets['date_start'])
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'filtrated_city_category_date';
                // фильтр по городу, категории и дате
                $q = DB::table('events')
                    ->where('status', 1)
                    ->where('events.city', $facets['city'])
                    ->where('events.category', $facets['category'])
                    ->where('date_start', '>=', $facets['date_start'])
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
                    ->where('date_start', '>=', date('Y-m-d'))
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
                    )
                    ->orderBy('date_start')
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
                    )
                    ->get()[0];
                break;
        }

        return $q;
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

            // преобразование списка идентификаторов избранных пользователей
            $favourites_list = unserialize($auth->favourites);
    
            // получение некоторых данных избранных пользователей на основе преобразованных значений
            $favourites_obj = self::getFirstQuery('list_users_favourites', $favourites_list);
    
            // сборка сессии
            session(['user_id' => $user_id]);
            session(['name' => $auth->name]);
            session(['email' => $auth->email]);
            session(['avatar' => $auth->avatar]);
            session(['about' => $auth->about]);
            session(['bookmarks' => unserialize($auth->bookmarks)]);
            session(['favourites_list' => $favourites_list]);
            session(['favourites_obj' => $favourites_obj->all()]);
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
        }

    }

    /**
     * * Соглашение о терминологии
     * 
     * * user - любой пользователь
     * * auth - авторизованный пользователь
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
                    $msg[] = "Добавлено значение <b>$values[$i]</b> в колонку <b>$column</b>";
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
                    $msg[] = "Удалено значение <b>$values[$i]</b> из колонки <b>$column</b>";
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
                'title_default' => 'Where-go',
                'description' => NULL,
                'description_default' => 'не знаете куда сходить? подберите событие по вкусу',
            ),
            'cityes' => array(
                'Красноярск',
                'Ачинск',
                'Дивногорск',
                'Железногорск',
                'Минусинск',
                'Сосновоборск',
            ),
            'categories' => array(
                'Активный отдых',
                'Бизнес',
                'Вечеринка',
                'Выставка',
                'Досуг',
                'Дети',
                'Здоровье',
                'Игры',
                'Искусство',
                'Карьера',
                'Кино',
                'Конференция',
                'Концерт',
                'Культура',
                'Курсы',
                'Мастер-классы',
                'Музыка',
                'Наука',
                'Общение',
                'Образование',
                'Отдых',
                'Онлайн',
                'Поход',
                'Развлечения',
                'Семинар',
                'Спорт',
                'Стендап',
                'Туризм',
                'Тренинг',
                'Фестиваль',
                'Эзотерика',
                'Экскурсия',
                'Хобби',
                'Шоу',
                'Другое',
            ),
        );

        return $localstorage;
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
            $event->category = explode(',', $event->category);

            // формирование отметки о том, что событие прошло
            if (strtotime($event->date_start) + 86400 < time()) {
                $event->last = 1;
            } else {
                $event->last = 0;
            }

            // преобразование даты
            $date_start = strtotime($event->date_start);
            $d = date('d', $date_start);
            $n = date('n', $date_start);
            $m = $month[$n];
            $y = date('Y', $date_start);
            $event->date_start = $d . ' ' . $m . ' ' . $y;

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
                    'city'                      => 'required',                                                  // обязательно
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
