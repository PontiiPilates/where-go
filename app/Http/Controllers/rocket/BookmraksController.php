<?php

namespace App\Http\Controllers\rocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Подключение библиотеки собственных методов (функции)
use App\Models\library\Base;

class BookmraksController extends Controller
{
    /**
     * ? Передает во view данные для рендеринга закладок пользователя
     */
    public function bookmarks()
    {
        // Обеспечение стандартными данными: избранные пользователти
        $stdVarFavourites = Base::getQueries('favourites_user');
        
        // Получение списка событий
        $events = Base::getQueries('bookmarks_events');

        // Получение списка идентификаторов событий, которые пользователь добавил в закладки
        $bookmarks = Base::getIds('bookmarks');

        return view('rocketViews.bookmarks', ['stdVarFavourites' => $stdVarFavourites, 'events' => $events, 'bookmarks' => $bookmarks]);
    }

    /**
     * ? Передает идентификатор события на скрипт, который добавляет его в закладки пользователя
     */
    public function addBookmark($event_id)
    {
        // Добавление идентификатора события в закладки
        return Base::addIds($event_id, 'bookmarks');
    }

    /**
     * ? Передает идентификатор события на скрипт, который удаляет его из закладок пользователя
     */
    public function removeBookmark($event_id)
    {
        // Удаление идентификатора события из закладок
        return Base::removeIds($event_id, 'bookmarks');
    }
}