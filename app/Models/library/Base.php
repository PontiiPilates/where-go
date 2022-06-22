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
     * * Удаляет идентификатор из указанного столбца
     * @param num $event_id идентификатор события, с которым происходит управление
     * @param string $profile_column имя колонки в таблице profiles
     * @param string $event_column имя колонки в таблице events
     * @return string сообщение
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
     * * Возвращает список событий в соответствии с заданными константами
     * all
     * bookmarks
     * user
     */
    static function getQueries($direction, $id = NULL, $limit = 30)
    {
        $data = '';

        switch ($direction) {

            case 'all_events';
                $date = date('Y-m-d');
                // dd($date);
                // ? Получение всех событий: для главной страницы 
                $data = DB::table('events')
                    ->where('status', 1) // Выводить только опубликованные события
                    ->where('date_start', '>', $date) // Не выводить события, которые прошли
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'one_event';
                // ? Получение одного события: для страницы события
                $data = DB::table('events')
                    ->where('events.id', $id)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('users.name', 'profiles.*', 'events.*')
                    ->get();
                // Оптимизация данных
                $data = $data->all()[0];
                break;

            case 'bookmarks_events';
                // ? Получение массива идентификаторов событий, добавленных в закладки авторизованным пользователем
                $bookmarks = self::getIds('bookmarks');
                // Получени событий, которые пользователь добавил в закладки: для страницы вывода закладок
                $data = DB::table('events')
                    ->whereIn('events.id', $bookmarks)
                    ->where('status', 1)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'run_events';
                // ? Получение массива идентификаторов событий, добавленных в закладки авторизованным пользователем
                $bookmarks = self::getIds('going');
                // Это предохранитель на тот случай, если не окажется элеметов в переменной
                if (!$bookmarks) {
                    $data = array();
                    break;
                }
                // dd($bookmarks);
                // Получени событий, которые пользователь добавил в закладки: для страницы вывода закладок
                $data = DB::table('events')
                    ->whereIn('events.id', $bookmarks)
                    ->where('status', 1)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->get();
                // Оптимизация данных
                $data = $data->all();
                // dd($data);
                break;

            case 'user_events';
                // ? Получение всех событий пользователя
                $data = DB::table('events')
                    ->where('events.status', 1)
                    ->where('events.user_id', $id)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'favourites_user';
                // ? Получение идентификаторов избранных пользователей
                $user_ids = self::getFavourites();
                // ! Предохранитель на случай, если массив окажется пустым. Возможно лучше сделать в таблице хотя бы один нулевой элемент.
                if (!$user_ids) {
                    $user_ids = array(0);
                }
                // Получение некоторых данных избранных пользователей
                $data = DB::table('profiles')
                    ->whereIn('user_id', $user_ids)
                    ->join('users', 'profiles.user_id', '=', 'users.id')
                    ->select('users.id', 'users.name', 'profiles.avatar')
                    ->get();
                // Оптимизация данных
                $data = $data->all();
                break;

            case 'run_users';
                // Получение идентификаторов пользователей, зарегистрировавшихся на событие
                $goes = DB::table('events')
                    ->where('id', $id)
                    ->where('status', 1)
                    ->select('goes')
                    ->get();
                // Оптимизация данных
                $goes = $goes->all()[0]->goes;
                // Получение идентификаторов
                $goes = unserialize($goes);
                // Получение данных пользователей
                $data = DB::table('profiles')
                    ->whereIn('user_id', $goes)
                    ->join('users', 'profiles.user_id', '=', 'users.id')
                    ->select('users.id', 'users.name', 'profiles.avatar')
                    ->get();
                // Оптимизация данных
                $data->all()[0];
                break;

            case 'run_users_ids';
                // ? Получение идентификаторов пользователей, зарегистрировавшихся на событие
                $data = DB::table('events')
                    ->where('id', $id)
                    ->where('status', 1)
                    ->select('goes')
                    ->get();
                // Оптимизация данных
                $data = $data->all()[0]->goes;
                // Получение идентификаторов
                $data = unserialize($data);
                break;

            case 'user';
                // ? Получение данных пользователя
                $data = DB::table('profiles')
                    ->where('user_id', $id)
                    ->join('users', 'profiles.user_id', '=', 'users.id')
                    ->select('profiles.*', 'users.name')
                    ->get();
                // Оптимизация данных

                // ! Опять костыль, связанный с тем, что данных по запросу может и не быть.
                if ($data->all()) {
                    $data = $data->all()[0];
                } else {
                    $data = array();
                }
                break;
        }

        // Возвращает результат запроса
        return $data;
    }

    /**
     * * Возвращает количество элементов массива, хранящегося в таблице
     * 
     * @param table string имя таблицы, к которой происходит обращение
     * @param id num идентификатор пользователя или события
     * @param column string имя колонки, в которой содержится массив идентфикаторов
     * @return data num возвращает количество элементов массива
     */
    static function elements_count($table, $id, $column)
    {
        // Получение данных из таблицы
        $data = DB::table($table)
            ->where('id', $id)
            ->select($column)
            ->get();

        // Оптимизация данных
        $data = $data->all()[0]->goes;

        // Получение чистого массива
        $data = unserialize($data);

        // Предохранитель на случай того, если переменная окажется пустой
        if (!$data) {
            $data = array();
        }

        // Получение количества элементов массива
        $data = count($data);

        return $data;
    }

    /**
     * Раздел посвящен форме создания события
     * Как это работает?
     * Прежде всего происходит создание записи в таблице
     * Изначально - это пустая строка
     * Затем, тет же происходит ее получение и редактирование
     * И это оказалось хуйнёй, поскольку если так сделать, то на странице ползователя получим пустое событие и нахер оно спрашивается нужно
     */

    /**
     * Возвращает данные авторизованного пользователя
     * @param $user_id int идентификатор авторизованного пользователя
     */
    static function getUserSet($user_id)
    {
        return Base::getQueries('favourites_user');
    }
















































































    /**
     * * Временное хранилище
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
     * * Возвращает результат сырого запроса события из базы данных
     * * Для страниц, где требуется вывод событий пользователя:
     * * - все события пользователя
     * * - закладки пользователя
     * * - события, в которых участвует пользователь
     */

    static function getEventsList($selector, $user_id)
    {
        // ограничение количества выводимых элементов
        $limit = 30;

        switch ($selector) {

            case 'list_events_user';
                // получение всех событий пользователя
                $events = DB::table('events')
                    ->where('events.status', 1)
                    ->where('events.user_id', $user_id)
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
                $bookmarks = session('bookmarks');
                $events = DB::table('events')
                    ->whereIn('events.id', $bookmarks)
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

        return $events;
    }

    /**
     * * Возвращает результат сырого запроса из базы данных в зависимости от выбранного фильтра
     * * Для главной страницы, где существует фильтрация событий
     * ! Отрефакторено
     * @param $direction string
     * @param $city string
     * @param $category string
     * @param $date_start string
     * @return $events object
     * TODO: поправить запросы, чтобы не показывать прошедшие события
     */

    static function getEventsFiltrated($selector, $city, $category, $date_start)
    {
        // ограничение количества выводимых элементов
        $limit = 30;

        switch ($selector) {

            case 'filtrated_city';
                // фильтр по городу
                $events = DB::table('events')
                    ->where('status', 1)
                    ->where('events.city', $city)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'filtrated_category';
                // фильтр по категории
                $events = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', $category)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'filtrated_date';
                // фильтр по дате
                $events = DB::table('events')
                    ->where('status', 1)
                    ->where('date_start', '>=', $date_start)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'filtrated_city_category';
                // фильтр по городу и категории
                $events = DB::table('events')
                    ->where('status', 1)
                    ->where('events.city', $city)
                    ->where('events.category', $category)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'filtrated_city_date';
                // фильтр по городу и дате
                $events = DB::table('events')
                    ->where('status', 1)
                    ->where('events.city', $city)
                    ->where('date_start', '>=', $date_start)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'filtrated_category_date';
                // фильтр по категории и дате
                $events = DB::table('events')
                    ->where('status', 1)
                    ->where('events.category', $category)
                    ->where('date_start', '>=', $date_start)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;

            case 'filtrated_city_category_date';
                // фильтр по городу, категории и дате
                $events = DB::table('events')
                    ->where('status', 1)
                    ->where('events.city', $city)
                    ->where('events.category', $category)
                    ->where('date_start', '>=', $date_start)
                    ->join('users', 'events.user_id', '=', 'users.id')
                    ->join('profiles', 'events.user_id', '=', 'profiles.user_id')
                    ->select('events.*', 'users.name', 'profiles.avatar')
                    ->orderBy('date_start')
                    ->simplePaginate($limit);
                break;
        }

        // dd($events);


        return $events;
    }




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
     * * Возвращает обработанный список событий
     * * Содержит в себе все обработки, ранее использовавшиеся в шаблоне
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

            // преобразование состояния закладки в зависимости от наличия события в закладках авторизованного полььзователя
            if (in_array($event->id, session('bookmarks'))) {
                $event->state_bookmark = 'bi-bookmark-check-fill';
            } else {
                $event->state_bookmark = 'bi-bookmark';
            }

            // формирование условия участия
            if ($event->price_type == 'free') {
                $event->participant = 'бесплатно';
            } elseif ($event->price_type == 'donate') {
                $event->participant = 'за донат';
            } elseif ($event->price_type == 'price') {
                $event->participant = "$event->cost руб.";
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

            // dd($event);
        }

        // передача данных в представление
        return $events;
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
     * * Подписаться на пользователя
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
     * * Получить идентификаторы избранных пользователей
     */

    static function getFavourites()
    {
        // Получение идентификатора авторизованного пользователя
        $auth_id = Auth::id();

        // Получение данных авторизованного пользователя
        $auth = Profile::firstWhere('user_id', $auth_id);

        // ! Предохранитель, который срабатывает в случае, если посетитель - гость
        if ($auth_id) {
            // Получение идентификаторов избранных пользователей у авторизованного пользователя
            $favourites = $auth->favourites;
            $favourites = unserialize($favourites);
        } else {
            $favourites = array();
        }

        return $favourites;
    }

    /**
     * * Получить количество подписчиков
     */

    static function getCountFollovers($user_id)
    {
        // Получение модели профиля пользователя
        $profile = Profile::firstWhere('user_id', $user_id);

        // Получение данных из колонки "Подписчики"
        $follovers = $profile->follovers;

        // Преобразование данных
        $follovers = unserialize($follovers);

        // Подсчёт элементов
        $count = count($follovers);

        // Передача данных
        return $count;
    }

    /**
     * * Получить количество событий, созданных пользователем
     */

    static function getCountEvents($user_id)
    {
        // Получение модели и сразу получение количества событий, созданных пользователем
        $events = Event::where('user_id', $user_id)->count();

        // Передача данных
        return $events;
    }


    /**
     * * Добавляет просмотр события
     */

    static function addView($event_id)
    {
        // Получение модели события
        $action = Event::find($event_id);
        // Извлечение количества просмотров
        $views_count = $action->counter;
        // Добавление 1-го просмотра
        $views_count++;
        // Применение нового количества просмотров к модели
        $action->counter = $views_count;
        // Запись модели в базу данных
        $action->save();
    }




    /**
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
     * * Формирует сессию
     * * Для осуществления сквозного доступа к данным авторизованного пользователя
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
                'profiles.avatar',
                'profiles.bookmarks',
                'profiles.favourites',
                'profiles.follovers',
                'profiles.going',
                'profiles.witness'
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
        session(['avatar' => $auth->avatar]);
        session(['bookmarks' => unserialize($auth->bookmarks)]);
        session(['favourites_list' => $favourites_list]);
        session(['favourites_obj' => $favourites_obj->all()]);
        session(['follovers' => unserialize($auth->follovers)]);
        session(['going' => unserialize($auth->going)]);
        session(['witness' => $auth->witness]);
    }

    /**
     * Валидирует
     * @param $fields object принимает метод: $r->all()
     */
    static function validates($fields)
    {
        $validator = Validator::make($fields, [
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



        return $validator;
    }

    /**
     * Проверка материала на принадлежность авторизованному пользователю
     */
    static function owner($event_id) {
        
        if(session('user_id'))

    }
}

