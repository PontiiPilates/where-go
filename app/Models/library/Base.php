<?php

namespace App\Models\library;

// Стандартные подключения
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Подключение DB для создания произвольных запросов к базе данных
use Illuminate\Support\Facades\DB;

// Подключение класса Auth для возможности получения данных о статусе пользователя
use Illuminate\Support\Facades\Auth;

// Подключение модели Profile для возможности получения данных из таблицы
use App\Models\Profile;

// Подключение модели Event для возможности получения данных из таблицы
use App\Models\Event;

// Подключение библиотеки собственных методов (помощники)
use App\Models\library\Tools;

use function PHPUnit\Framework\isType;

// Подключение класса Validator для управления валидацией
use Illuminate\Support\Facades\Validator;

// TODO: Нужно подумать как организовать отображение закладок в событиях. Дело в том, что карточка события требует для этого массива закладок для сличения идентификаторов. При нахождении совпадения, карточка подставляет управляющему элементу класс для придания ему соответствующего состояния. Таким образом в контроллере приходится передавать еще и массив идентификаторов закладок для каждой страницы, на которой есть карточка события. Это привело к неудобной связке getBookmarksIds, addBookmark, removeBookmark и контроллеров отвечающих за вывод событий. На первое время этого должно быть достаточно. Но нужно подумать над тем, как это организовать более архитектурно эргономично.

// TODO: Несколько представлений используют одну и ту же конструкцию для вывода событий. Нужно избавиться от копипаста, заменив это каким-то другим решением. Опять же, сейчас это работает, но нужно подумать о более качественном использовании кода. В этом участвуют general.blade.php, bookmarks.blade.php.

// ! Сейчас цель - запуск ! Работает и работает !



class Base extends Model
{

    /**
     * Конструктор запросов
     * Возвращает результат соответствующего запроса
     * @param $selector string селектор запроса
     * @param $id int любой идентификатор
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

            case 'list_event_run';
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
                // получение данных участников события
                $q = DB::table('profiles')
                    ->whereIn('user_id', unserialize($q1))
                    ->join('users', 'profiles.user_id', '=', 'users.id')
                    ->select('users.id', 'users.name', 'profiles.avatar')
                    ->get()
                    ->all();
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
        }

        return $q;
    }


    /**
     * TODO: тоже бы соединить со списком сырых запросов, сейчас используется контроллером
     */

    static function getEventPage($event_id)
    {
        $event = DB::table('events')
            ->where('events.id', $event_id)
            ->join('users', 'events.user_id', '=', 'users.id')
            ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
            ->select('users.name', 'profiles.*', 'events.*')
            ->get();


        return $event;
    }


    /**
     * TODO: это нужно соединить с методом запросов и сделать метод запросов, которыми питается система
     * * Возвращает данные пользователя
     * * Для отрисовки страницы любого пользователя
     */
    static function getUser($user_id)
    {
        // объявление массива (на случай отсутствия значений в таблице)
        $user = array();

        // получение данных пользователя
        $user = DB::table('profiles')
            ->where('user_id', $user_id)
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

        // преобразование данных пользователя
        $user[0]->count_events      = self::getCountEvents($user_id);
        $user[0]->count_follovers   = self::getCountFollovers($user_id);

        // возвращение полученных данных
        return $user[0];
    }


    /**
     * Формирует / обновляет данные сессии
     * Для осуществления сквозного доступа к данным авторизованного пользователя
     * ! Refactored
     */
    static function sessionRefresh()
    {
        // получение идентификатора авторизованного пользователя
        $user_id = Auth::id();

        // получение данных авторизованного пользователя
        $auth = DB::table('profiles')
            ->where('user_id', $user_id)
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

        // преобразование списка идентификаторов избранных пользователей
        $favourites_list = unserialize($auth->favourites);
        // получение некоторых данных избранных пользователей на основе преобразованных значений
        $favourites_obj = DB::table('profiles')
            ->whereIn('user_id', $favourites_list)
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.name',
                'profiles.avatar'
            )
            ->get();

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
















    /**
     * 
     */
    static function getPostQuery($query)
    {
    }








































    /**
     * * Возвращает идентификаторы из указанного столбца (идентификаторы закладок, подписок, участий в событиях)
     * ! Нужно переписать этот метод. Сейчас он жестко привязан к таблице, в то время, как массивы с данными находятся уже в двух таблицах
     * bookmarks
     * favourites
     * going
     */
    static function getIds($column)
    {
        // Id авторизованного пользователя
        $user_id = Auth::id();

        // Получение модели профиля для извлечения данных
        $profile = Profile::firstWhere('user_id', $user_id);

        // ! Предохранитель
        // Случилось так, что запись в таблице profiles не была создана, поэтому можно выполнить проверку перед дальнейшим выполнением

        if ($profile) {
            // Извлечение массива с данными
            $data = $profile->$column;
            // dd($data);
            $data = unserialize($data);
        } else {
            $data = array();
        }

        // dd($profile);


        // ! Если в таблице поле указано NULL, то при первой итерации значение переменной будет false, а view нужен array
        if (!$data) {
            $data = array();
        }

        // Возвращает результат запроса
        return $data;
    }















































    /**
     * ! Чувствую из этого можно сделать цельный кусок
     */




















    /**
     * Отмена регистрации на участие в событии
     * @param $event_id int идентификатор события
     * @param string $profile_column имя колонки в таблице profiles
     * @param string $event_column имя колонки в таблице events
     * @return string сообщение
     * TODO: из этого можно сделать нечто среднее с закладками
     */
    static function removeRun($event_id, $profile_column, $event_column)
    {
        // Получение модели профиля для извлечения массива идентификаторов
        $profile = Profile::firstWhere('user_id', Auth::id());


        // Получение идентификаторов событий, на которые зарегистрировался пользователь
        $profile_ids = $profile->$profile_column;
        $profile_ids = unserialize($profile_ids);

        // Удаление идентификатора события, на которое зарегистрировался пользователь
        foreach ($profile_ids as $key => $item) {
            if ($item == $event_id) {
                unset($profile_ids[$key]);
            }
        }

        // Упаковка нового массива
        $profile_ids = serialize($profile_ids);
        $profile->$profile_column = $profile_ids;

        // Сохранение в базу данных
        if ($profile->save()) {
            $msg = 'Profile id is removed<br>';
        }

        // Получение модели события для извлечения массива идентификаторов зарегистрировавшихся пользователей
        $event = Event::find($event_id);

        // Получение идентификаторов событий, на которые зарегистрировался пользователь
        $event_ids = $event->$event_column;
        $event_ids = unserialize($event_ids);

        // Удаление идентификатора пользователя из массива зарегистрировавшихся пользователей
        foreach ($event_ids as $key => $item) {
            if ($item == Auth::id()) {
                unset($event_ids[$key]);
            }
        }

        // Упаковка нового массива
        $event_ids = serialize($event_ids);
        $event->$event_column = $event_ids;

        // Сохранение в базу данных
        if ($event->save()) {
            $msg .= 'Event id is removed';
        }

        // return $msg;
        return $msg;
    }

    /**
     * * Добавляет идентификатор в указанный столбец (идентификаторы закладок, подписок, участий в событиях)
     */
    static function addRun($event_id, $profile_column, $event_column)
    {
        // Получение модели профиля для извлечения массива идентификаторов
        $profile = Profile::firstWhere('user_id', Auth::id());

        // Получение идентификаторов событий, на которые зарегистрировался пользователь
        $profile_ids = $profile->$profile_column;
        $profile_ids = unserialize($profile_ids);

        // Добавление идентификатора события, на которое зарегистрировался пользователь
        $profile_ids[] = $event_id;
        $profile_ids = serialize($profile_ids);
        $profile->$profile_column = $profile_ids;

        // Сохранение в базу данных
        if ($profile->save()) {
            $msg = 'Profile id is added<br>';
        }

        // Получение модели события для извлечения массива идентификаторов зарегистрировавшихся пользователей
        $event = Event::find($event_id);

        // Получение идентификаторов событий, на которые зарегистрировался пользователь
        $event_ids = $event->$event_column;
        $event_ids = unserialize($event_ids);

        // Добавление идентификатора пользователя к событию, на которое он зарегистрировался
        $event_ids[] = Auth::id();
        $event_ids = serialize($event_ids);
        $event->$event_column = $event_ids;

        // Сохранение в базу данных
        if ($event->save()) {
            $msg .= 'Event id is added';
        }

        return $msg;
    }

    /**
     * * Удаляет идентификатор из указанного столбца (идентификаторы закладок, подписок, участий в событиях)
     * bookmarks
     * favourites
     * going
     */
    static function removeIds($event_id, $column)
    {
        // Получение модели профиля для извлечения закладок
        $profile = Profile::firstWhere('user_id', Auth::id());

        // Получение массива с закладками авторизованного поьзователя
        $data = self::getIds($column);

        // Удаление элемента из массива
        foreach ($data as $key => $item) {
            if ($item == $event_id) {
                unset($data[$key]);
            }
        }

        // Упаковка нового массива
        $data = serialize($data);
        $profile->$column = $data;

        // Сохранение в базу данных
        if ($profile->save()) {
            return 'removeded';
        }
    }

    /**
     * * Добавляет идентификатор в указанный столбец (идентификаторы закладок, подписок, участий в событиях)
     * bookmarks
     * favourites
     * going
     */
    static function addIds($event_id, $column)
    {
        // Получение модели профиля для извлечения массива идентификаторов
        $profile = Profile::firstWhere('user_id', Auth::id());
        // dd(Auth::id());

        // Получение массива с закладками авторизованного поьзователя
        $data = self::getIds($column);


        // Добавление нового элемента в массив идентификаторов
        $data[] = $event_id;
        $data = serialize($data);
        $profile->$column = $data;

        // Сохранение в базу данных
        if ($profile->save()) {
            return 'added';
        }
    }

    /**
     * * Удалить подписку
     */

    static function removeSubscribe($user_id)
    {
        // Приведение идентификатора пользователя к типу
        $user_id = (int) $user_id;

        // Получение идентификатора авторизованного пользователя
        $auth_id = Auth::id();

        // Получение данных авторизованного пользователя
        $auth = Profile::firstWhere('user_id', $auth_id);

        // Получение данных избранного пользователя
        $user = Profile::firstWhere('user_id', $user_id);

        // Получение идентификаторов избранных пользователей у авторизованного пользователя
        $favourites = $auth->favourites;
        $favourites = unserialize($favourites);

        // Получение идентификаторов подписчиков у избранного пользователя
        $follovers = $user->follovers;
        $follovers = unserialize($follovers);

        // Удаление идентификатора избранного пользователя из данных авторизованного пользователя
        foreach ($favourites as $k => $v) {
            if ($v == $user_id) {
                unset($favourites[$k]);
            }
        }

        // Добавление избранному пользователю идентификатора авторизованного пользователя
        foreach ($follovers as $k => $v) {
            if ($v == $auth_id) {
                unset($follovers[$k]);
            }
        }

        // Применение новых данных к модели авторизованного пользователя
        $favourites = serialize($favourites);
        $auth->favourites = $favourites;

        // Применение новых данных к модели избранного пользователя
        $follovers = serialize($follovers);
        $user->follovers = $follovers;

        // Сохранение данных
        if ($auth->save() && $user->save()) {
            return 'removed';
        }
    }


    /**
     * * Соглашение о терминологии
     * 
     * * auth - авторизованный пользователь
     * * user - другой пользователь
     * * guest - гость
     * 
     * * subscribe - подписка
     * * favourite - избранный пользователь
     * * follover - подписчик
     * 
     * * Написано хорошо, переделывать не нужно
     */

    /**
     * Добавление подписки
     * TODO: Если в строке запроса указать $user_id не существующего пользователя, то скрипт не сможет обратиться к этой строке в базе данных. Нужно пропатчить.
     */

    static function addSubscribe($user_id)
    {
        // Приведение идентификатора пользователя к типу
        $user_id = (int) $user_id;

        // Получение идентификатора авторизованного пользователя
        $auth_id = Auth::id();

        // Получение данных авторизованного пользователя
        $auth = Profile::firstWhere('user_id', $auth_id);

        // Получение данных избранного пользователя
        $user = Profile::firstWhere('user_id', $user_id);

        // Получение идентификаторов избранных пользователей у авторизованного пользователя
        $favourites = $auth->favourites;
        $favourites = unserialize($favourites);

        // Получение идентификаторов подписчиков у избранного пользователя
        $follovers = $user->follovers;
        $follovers = unserialize($follovers);

        // Добавление идентификатора избранного пользователя авторизованному пользователю
        $favourites[] = $user_id;

        // Добавление избранному пользователю идентификатора авторизованного пользователя
        $follovers[] = $auth_id;

        // Применение новых данных к модели авторизованного пользователя
        $favourites = serialize($favourites);
        $auth->favourites = $favourites;

        // Применение новых данных к модели избранного пользователя
        $follovers = serialize($follovers);
        $user->follovers = $follovers;

        // Сохранение данных
        if ($auth->save() && $user->save()) {
            return 'added';
        }
    }






























    /**
     * ! Все, что ниже - хорошо отрефакторено
     */




















    /**
     * Централизованное хранилище данных не до конца определенных данных
     * Для каждой страницы
     * @return mixed
     * ! Refactored
     */
    static function getLocalstorage()
    {
        $localstorage = array(
            'cityes' => array(
                'Ачинск',
                'Артемовск',
                'Боготол',
                'Бородино',
                'Енисейск',
                'Железногорск',
                'Дивногорск',
                'Дудинка',
                'Заозерный',
                'Зеленогорск',
                'Игарка',
                'Иланский',
                'Канск',
                'Кодинск',
                'Красноярск',
                'Лесосибирск',
                'Минусинск',
                'Назарово',
                'Норильск',
                'Сосновоборск',
                'Ужур',
                'Уяр',
                'Шарыпово',
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
                'Эзотерика',
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
                'Хобби',
                'Шоу',
                'Другое',
            ),
        );

        return $localstorage;
    }



    /**
     * Преобразует список событий
     * Содержит все обработки, которые ранее выполнялись представлением
     * @param object $events список событий, которые вернул сырой запрос
     * @return mixed список событий с обработанными данными
     * ! Refaсtored
     */
    static function getEventsFinished($events)
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
     * Получает количество подписчиков
     * @param int $user_id идентификатор пользователя
     * @return int количество подписчиков
     * ! Refactored
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
     * Получает количество событий, созданных пользователем
     * @param $user_id int идентификатор пользователя
     * @return int количество событий
     * ! Refactored
     */
    static function getCountEvents($user_id)
    {
        // получение модели и сразу получение количества событий
        $events = Event::where('user_id', $user_id)->count();

        return $events;
    }


    /**
     * Добавляет 1 просмотр события
     * @param $event_id идентификатор события
     * ! Refactored
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
     * Валидирует данные выбранной формы
     * @param $selector string селктор набора валидирующих правил
     * @param $fields object экземпляр коасса Request: $r->all()
     * @return mixed
     * ! Refactored
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
