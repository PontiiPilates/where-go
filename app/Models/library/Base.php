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
        $profile = Profile::find($user_id);

        // ! Предохранитель
        // Случилось так, что запись в таблице profiles не была создана, поэтому можно выполнить проверку перед дальнейшим выполнением
        if ($profile) {
            // Извлечение массива с данными
            $data = $profile->$column;
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
        $profile = Profile::find(Auth::id());

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
        $profile = Profile::find(Auth::id());

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
        $profile = Profile::find(Auth::id());

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
        $profile = Profile::find(Auth::id());

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
                // ? Получение всех событий: для главной страницы 
                $data = DB::table('events')
                    ->where('status', 1)
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
                $user_ids = self::getIds('favourites');
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
}
