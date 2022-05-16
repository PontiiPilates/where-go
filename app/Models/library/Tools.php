<?php

namespace App\Models\library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Подключение DB для возможности формировать запросы, выходящие за рамки одной модели
use Illuminate\Support\Facades\DB;

// Подключение модели Profile для возможности получения данных из таблицы
use App\Models\Profile;

// Подключение класса Auth для возможности получения данных о статусе пользователя
use Illuminate\Support\Facades\Auth;


class Tools extends Model
{

    // /**
    //  * * Возвращает массив идентификаторов событий, которые авторизованный пользователь добавил в закладки
    //  */
    // static function getBookmarksIds()
    // {
    //     // Id авторизованного пользователя
    //     $user_id = Auth::id();

    //     // Получение модели профиля для извлечения закладок
    //     $profile = Profile::find($user_id);

    //     // Извлечение массива с закладками
    //     $bookmarks = $profile->bookmarks;
    //     $bookmarks = unserialize($bookmarks);

    //     // Возвращает результат запроса
    //     return $bookmarks;
    // }

}
