<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// подключение библиотеки кастомных методов
use App\Models\library\Base;
// подключение модели Profile
use App\Models\Profile;
// подключение модели Users
use App\Models\User;
// подулючение класса Image
use App\Models\library\Images;
// подулючение класса Hash
use Illuminate\Support\Facades\Hash;
// подключение класса Auth
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Страница любого пользователя
     * @param $user_id int идентификатор пользователя, страница которгго посещается в данный момент
     * @return mixed
     */
    public function getUser($user_id)
    {
        // проверка существования профиля, иначе 404
        Base::checkIsset('user', $user_id);

        // формирование сессии из данных авторизованного пользователя
        Base::sessionRefresh();
        // обращение к временному хранилищу
        $localstorage = Base::getLocalstorage();

        // объявление массива (на случай отсутствия значений в таблице)
        $user = array();

        // получение данных пользователя, к странице которого ведет запрос
        $user = Base::getFirstQuery('page_user', $user_id);

        // преобразование данных пользователя
        $user[0]->count_events      = Base::getCountEvents($user_id);
        $user[0]->count_follovers   = Base::getCountFollovers($user_id);

        // получение списка событий пользователя, к странице которого ведет запрос
        $events = Base::getFirstQuery('list_events_user', $user_id);
        $events = Base::eventsFinished($events);

        // формирование meta-тегов
        $description = mb_substr($user[0]->about, 0, 170);
        $description = mb_strtolower($description);
        $description = preg_replace("/[^А-Яа-яA-Za-z0-9 ]/u", '', $description);
        $localstorage['meta']['title'] = $user[0]->name;
        $localstorage['meta']['description'] = $description;

        return view('pageUser', [
            'user' => $user[0],
            'events' => $events,
            'localstorage' => $localstorage
        ]);
    }

    /**
     * Страница с формами для редактирования данных пользователя
     * @param $user_id int идентификатор авторизованного пользователя
     * @param $r object экземпляр класса Request
     * @return mixed
     */
    public function editUser(Request $r, $user_id)
    {
        // проверка принадлежности запрошенного профиля авторизованному пользователю
        Base::checkOwner($user_id);

        // формирование сессии из данных авторизованного пользователя
        Base::sessionRefresh();
        // обращение к временному хранилищу
        $localstorage = Base::getLocalstorage();

        // получение данных авторизованного пользователя
        $profile = Profile::firstWhere('user_id', $user_id);

        // получение данных авторизованного пользователя
        $user = User::find($user_id);

        // dd($profile);

        // если произошла отправка формы
        if ($r->isMethod('post')) {

            // если отправлены данные из формы редактирования профиля
            if ($r->form_name == 'control_profile') {

                // валидация отправленных данных
                $validator = Base::validates('form_control_profile', $r->all());

                if ($validator->fails()) {
                    // если данные не валидны, то вернуть пользователя обратно на форму
                    return redirect("/user/$user_id/edit")->withErrors($validator)->withInput();
                } else {
                    // иначе наполнение данными
                    $profile->about                = $r->about;
                    $profile->phone                = $r->phone;
                    $profile->phone_checked        = $r->phone_checked;
                    $profile->telegram             = $r->telegram;
                    $profile->telegram_checked     = $r->telegram_checked;
                    $profile->vk                   = $r->vk;
                    $profile->vk_checked           = $r->vk_checked;
                    $profile->whatsapp             = $r->whatsapp;
                    $profile->whatsapp_checked     = $r->whatsapp_checked;
                    // если пользователь загрузил изображение
                    if ($r->avatar) {
                        $profile->avatar           = Images::image(512, 512, 'avatar', '../public/img/avatars/');
                    }
                    // если сохранение модели прошло успешно
                    if ($profile->save()) {
                        return redirect("/user/$user_id/");
                    }
                }
            }

            // если отправлены данные из формы изменения пароля
            if ($r->form_name == 'change_password') {

                // валидация отправленных данных
                $validator = Base::validates('form_change_password', $r->all());

                if ($validator->fails()) {
                    // если данные не валидны, то вернуть пользователя обратно на форму
                    return redirect("/user/$user_id/edit?password=active")->withErrors($validator)->withInput();
                } else {
                    // иначе наполнение данными
                    $user->password = Hash::make($r->password_confirmation);
                    // если сохранение модели прошло успешно
                    if ($user->save()) {
                        Auth::logout();
                        return redirect('login');
                    }
                }
            }

            // если отправлены данные из формы изменения почты
            if ($r->form_name == 'change_email') {

                // валидация отправленных данных
                $validator = Base::validates('form_change_email', $r->all());

                if ($validator->fails()) {
                    // если данные не валидны, то вернуть пользователя обратно на форму
                    return redirect("/user/$user_id/edit?email=active")->withErrors($validator)->withInput();
                } else {
                    // иначе наполнение данными
                    $user->email = $r->email;
                    // если сохранение модели прошло успешно
                    if ($user->save()) {
                        Auth::logout();
                        return redirect('login');
                    }
                }
            }
        }

        // определение активной вкладки
        if ($r->password) {
            $active = 'password';
        } elseif ($r->email) {
            $active = 'email';
        } else {
            $active = 'profile';
        }

        return view('controlUser', [
            'localstorage' => $localstorage,
            'profile' => $profile,
            'active' => $active
        ]);
    }
}
