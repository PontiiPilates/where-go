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

// Подключение модели таблицы Users
use App\Models\User;

// Подулючение класса Image для обработки изображений
use App\Models\library\Images;

// Подулючение класса Hash для изменения пароля
use Illuminate\Support\Facades\Hash;

// Подключение класса Auth для возможности получения данных о статусе пользователя
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * * Передает во view данные для рендеринга страниц пользователей
     */
    public function getUser($user_id)
    {
        // Получение данных пользователя
        $user = Base::getQueries('user', $user_id);

        // dd($user);

        // Получение списка событий
        $events = Base::getQueries('user_events', $user_id);

        // Получение списка идентификаторов событий, которые пользователь добавил в закладки
        $bookmarks = Base::getIds('bookmarks');

        // Получение списка идентификаторов избранных пользователей
        $favourites = Base::getFavourites();
        // dd($favourites);




        // Получение данных избранных пользователей
        $stdVarFavourites = Base::getQueries('favourites_user');

        // Получение данных пользователя
        $self = Base::getQueries('user', Auth::id());

        // Получение имени аватара авторизованного пользователя
        $std_avatar = $self->avatar;

        $events_count = 'x';
        $follovers_count = 'y';

        // Передача данных на представление
        return view('rocketViews.user', [
            'user' => $user,
            'events' => $events,
            'bookmarks' => $bookmarks,
            'favourites' => $favourites,
            'stdVarFavourites' => $stdVarFavourites,
            'user_id' => $user_id,
            'std_avatar' => $std_avatar,
            'events_count' => $events_count,
            'follovers_count' => $follovers_count
        ]);
    }

    /**
     * * Обеспечивает редактирование профиля авторизованного пользователя
     * @param int $user_id идентификатор авторизованного пользователя
     * @param object $r  данные отправленные из формы
     * @return mixed в зависимости от ситуации, метод отправляет данные в представление либо перенаправляет на страницу авторизованного пользователя
     * TODO: стоит лучше продумать архитектуру настроек. Возможно их следует разнести по страницам "Редактировать профиль" и "Настройки (на одной странице разные формы)"
     */
    public function edit(Request $r, $user_id)
    {
        // Снабжение стандартными данными (подписки)
        $stdVarFavourites = Base::getQueries('favourites_user');
        // Снабжение контроллера процедурными данными
        $profile = Profile::firstWhere('user_id', $user_id);
        // Снабжение контроллера процедурными данными
        $user = User::find($user_id);
        // Получение имени аватара авторизованного пользователя
        $std_avatar = $profile->avatar;
        $email = $user->email;

        // Если произошла отправка формы
        if ($r->isMethod('post')) {

            // * Если отправка произошла с формы редактирования профиля
            if ($r->form_name == 'profile') {

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

            // * Если отправка произошла с формы изменения пароля
            if ($r->form_name == 'sequrity') {

                // Определение правил валидации
                $validator = Validator::make($r->all(), [
                    'current_password'          => 'current_password|min:3',            // проверяет введенный пароль на соответствие текущему
                    'password_confirmation'     => 'min:3',                             // валидация введенного пароля
                    'password'                  => 'confirmed|min:3',                   // проверка введенного пароля на соответсвие введенному ранее
                ]);

                // Если есть ошибки валидации
                if ($validator->fails()) {

                    // Вернуть пользователя обратно на форму
                    return redirect("/user/$user_id/edit?password=active")
                        ->withErrors($validator)
                        ->withInput();

                    // Если нет ошибок валидации
                } else {

                    // Изменение пароля
                    $user->password = Hash::make($r->password_confirmation);

                    // Сохранение
                    if ($user->save()) {
                        return redirect('logout');
                    }
                }
            }

            // * Если отправка произошла с формы изменения почты
            if ($r->form_name == 'email') {

                // Определение правил валидации
                $validator = Validator::make($r->all(), [
                    'email'         => 'email:rfc,dns',             // валидирует email, в том числе на соответствие доменных зон
                ]);

                // Если есть ошибки валидации
                if ($validator->fails()) {

                    // Вернуть пользователя обратно на форму
                    return redirect("/user/$user_id/edit?email=active")
                        ->withErrors($validator)
                        ->withInput();

                    // Если нет ошибок валидации
                } else {

                    // Изменение пароля
                    $user->email = $r->email;

                    // Сохранение
                    if ($user->save()) {
                        return redirect('logout');
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
                'email' => $email,
            ]
        );
    }
}
