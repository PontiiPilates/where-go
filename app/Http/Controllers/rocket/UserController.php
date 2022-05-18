<?php

namespace App\Http\Controllers\rocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Подключение библиотеки собственных методов (функции)
use App\Models\library\Base;

// Подключение класса Validator для управления валидацией
use Illuminate\Support\Facades\Validator;

// Подключение модели таблицы Profile
use App\Models\Profile;

// Подулючение класса Image для обработки изображений
use App\Models\library\Images;

class UserController extends Controller
{
    /**
     * * Передает во view данные для рендеринга страниц пользователей
     */
    public function getUser($user_id)
    {
        // Получение данных пользователя
        $user = Base::getQueries('user', $user_id);

        // Получение списка событий
        $events = Base::getQueries('user_events', $user_id);

        // Получение списка идентификаторов событий, которые пользователь добавил в закладки
        $bookmarks = Base::getIds('bookmarks');

        // Получение списка идентификаторов избранных пользователей
        $favourites = Base::getIds('favourites');

        // Получение данных избранных пользователей
        $stdVarFavourites = Base::getQueries('favourites_user');

        // Получение имени аватара авторизованного пользователя
        $std_avatar = $user->avatar;

        // Передача данных на представление
        return view('rocketViews.user', [
            'user' => $user,
            'events' => $events,
            'bookmarks' => $bookmarks,
            'favourites' => $favourites,
            'stdVarFavourites' => $stdVarFavourites,
            'user_id' => $user_id,
            'std_avatar' => $std_avatar,



        ]);
    }

    /**
     * * Обеспечивает редактирование профиля авторизованного пользователя
     * @param int $user_id идентификатор авторизованного пользователя
     * @param object $r  данные отправленные из формы
     * @return mixed в зависимости от ситуации, метод отправляет данные в представление либо перенаправляет на страницу авторизованного пользователя
     */
    public function edit(Request $r, $user_id)
    {
        // Снабжение стандартными данными (подписки)
        $stdVarFavourites = Base::getQueries('favourites_user');
        // Снабжение контроллера процедурными данными
        $profile = Profile::find($user_id);
        // Получение имени аватара авторизованного пользователя
        $std_avatar = $profile->avatar;

        // Если произошла отправка формы
        if ($r->isMethod('post')) {

            if ($r->form_name == 'profile') {
                // dd($r->all());

                // Определение правил валидации
                $validator = Validator::make($r->all(), [
                    'avatar'                => 'mimes:jpeg,png',                                        // должно быть в формате jpeg или png
                    'about'                 => 'min:10',                                                // должно быть в формате jpeg или png
                    'city'                  => 'required',                                              // обязательно
                    'phone_checked'         => 'nullable',                                              // TODO: проверить регулярным выражением на 0 или 1
                    'phone'                 => 'nullable',                                              // TODO: проверить на номер телефона
                    'telegram_checked'      => 'nullable',                                              // TODO: проверить регулярным выражением на 0 или 1
                    'telegram'              => 'nullable',                                              // TODO: проверить на номер телефона или никнейм
                    'vk_checked'            => 'nullable',                                              // TODO: проверить регулярным выражением на 0 или 1
                    'vk'                    => 'nullable',                                              // TODO: проверить на никнейм или id
                ]);

                // Если есть ошибки валидации
                if ($validator->fails()) {

                    // Вернуть пользователя обратно на форму
                    return redirect("/user/$user_id/edit")
                        ->withErrors($validator)
                        ->withInput();

                    // Если нет ошибок валидации
                } else {

                    // Наполнение модели данными
                    $profile->about                = $r->about;                                                        // описание
                    $profile->city                 = $r->city;                                                         // город
                    $profile->phone_checked        = $r->phone_checked;                                                // отметка о доступности видя связи
                    $profile->phone                = $r->phone;                                                        // телефон
                    $profile->telegram_checked     = $r->telegram_checked;                                             // отметка о доступности видя связи
                    $profile->telegram             = $r->telegram;                                                     // телеграм
                    $profile->vk_checked           = $r->vk_checked;                                                   // отметка о доступности видя связи
                    $profile->vk                   = $r->vk;                                                           // вконтакте

                    // Если пользователь загрузил изображение
                    if ($r->avatar) {
                        $profile->avatar               = Images::image(575, 575, 'avatar', '../public/img/avatars/');      // загруженное изображение
                    }

                    // Сохранение модели в таблицу
                    if ($profile->save()) {
                        // Перенаправить ползователя на его страницу
                        return redirect("/user/$user_id/");
                    }
                }
            }
        }

        // Передача данных на представление
        return view(
            'rocketViews.userEdit',
            [
                'stdVarFavourites' => $stdVarFavourites,
                'std_avatar' => $std_avatar,
                'user_id' => $user_id,
                'profile' => $profile,
            ]
        );
    }
}
