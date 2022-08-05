<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// подключение библиотеки кастомных методов
use App\Models\library\Base;

class NotificationsController extends Controller
{
    /**
     * Страница уведомлений
     */
    public function getNotifications()
    {
        // сборка данных со стороны авторизованного пользователя
        Base::sessionRefresh();
        // сборка данных со стороны сервиса
        $localstorage = Base::getLocalstorage();

        return view('listNotifications', [
            'localstorage' => $localstorage
        ]);
    }
}
