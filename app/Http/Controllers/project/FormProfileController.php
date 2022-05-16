<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\library\Images;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;



class FormProfileController extends Controller
{
    // проверка наличия строки в таблице
    static function checkRow()
    {
        // получение идентификатора пользователя
        $id = Auth::id();

        // получение результата запроса по условию
        $count = Profile::where('user_id', $id)->count();

        // возврат полученного значения
        return $count;
    }

    // создание строки пользователя с дополнительными данными о нем
    static function createRow()
    {
        // создание экземпляра класса Profile
        $profile = new Profile;

        // получение и запись идентификатора пользователя
        $profile->user_id = Auth::id();

        // сохранение строки в базу данных, true или false
        return $profile->save();
    }

    // правка профиля
    public function edit(Request $r)
    {
        // если строки с дополнительными данными для пользователя еще нет
        if (self::checkRow() == 0) {
            self::createRow();
        }

        // проверка авторизации
        if (Auth::id()) {
            $id = Auth::id();
        } else {
            return redirect('/');
        }


        // Потребность этого костыля в виде применения такого запроса из двух таблиц потребовалась тогда, когда я решил вывести информацию в двух колонках
        // Поэтому вот этот конский запрос исполняется сейчас для вывода всей инфы, а запрос чисто на сохранение информации чуть ниже
        // здесь мы берем данные из базы и возвращаем их пользователю, не важно, пустые они или полные, на это будет реагировать уже сам шаблон
        $profiles = DB::table('profiles')->where('user_id', $id)->join('users', 'profiles.user_id', '=', 'users.id')->select('profiles.*', 'users.name')->get();

        // так приходится распаковывать данные полученные из базы, поскольку запрос происходит не из модели
        // а не из модели происходит он потому, что нужен джоин, а как из модели сделать джоин я хз
        foreach ($profiles as $profile) {
            $profile = $profile;
        }



        // Делаю так, чтобы переменная всегда была и шаблон не ругался.
        $message = NULL;
        // Проверяю заполненность профиля.
        if ($profile->avatar == NULL && $profile->about == NULL && $profile->city == NULL) {
            // Если основные поля профиля пусты, то возвращаю пользователю сообщение о заполнении профиля.
            $message = TRUE;
        }
        // TODO: со временем показ сообщения о необходимости заполнить профиль лучше сделать более детальным, например: не вся информация о профиле заполнена.


        // Если форма была отправлена
        if ($r->isMethod('post')) {

            // dd($r->all());

            // Получение модели для получения из нее данных и внесения изменений
            $profile = Profile::firstWhere('user_id', $id);

            // $validated = $r->validate([
            //     'avatar'                => 'mimes:jpeg,png',                            // должно быть в формате jpeg или png
            //     'city'                  => 'alpha',                                     // должно состоять из букв
            //     'phone'                 => 'nullable|regex:/^(\+7)[0-9]{10}$/',         // должно соответствовать формату +79999999999
            //     'phone_checked'         => 'nullable|regex:/^1$/',                      // должно соответствовать формату 1
            //     'whatsapp'              => 'nullable|regex:/^(\+7)[0-9]{10}$/',         // должно соответствовать формату +79999999999
            //     'whatsapp_checked'      => 'nullable|regex:/^1$/',                      // должно соответствовать формату 1
            //     'telegram'              => 'nullable|regex:/^[a-zA-Z0-9._-]+$/',        // должно соответствовать формату userName99._-
            //     'telegram_checked'      => 'nullable|regex:/^1$/',                      // должно соответствовать формату 1
            //     'instagram'             => 'nullable|regex:/^[a-zA-Z0-9._-]+$/',        // должно соответствовать формату userName99._-
            //     'instagram_checked'     => 'nullable|regex:/^1$/',                      // должно соответствовать формату 1
            //     'facebook'              => 'nullable|regex:/^[a-zA-Z0-9._-]+$/',        // должно соответствовать формату userName99._-
            //     'facebook_checked'      => 'nullable|regex:/^1$/',                      // должно соответствовать формату 1
            //     'vk'                    => 'nullable|regex:/^[a-zA-Z0-9._-]+$/',        // должно соответствовать формату userName99._-
            //     'vk_checked'            => 'nullable|regex:/^1$/',                      // должно соответствовать формату 1
            //     // TODO: подумать над правилом валидации поля "О себе". Как вариант - использовать регулярное выражение.
            // ]);

            $validator = Validator::make($r->all(), [
                'avatar'                => 'mimes:jpeg,png',                            // должно быть в формате jpeg или png
                'city'                  => 'alpha',                                     // должно состоять из букв
                'phone'                 => 'nullable|regex:/^(\+7)[0-9]{10}$/',         // должно соответствовать формату +79999999999
                'phone_checked'         => 'nullable|regex:/^1$/',                      // должно соответствовать формату 1
                'whatsapp'              => 'nullable|regex:/^(\+7)[0-9]{10}$/',         // должно соответствовать формату +79999999999
                'whatsapp_checked'      => 'nullable|regex:/^1$/',                      // должно соответствовать формату 1
                'telegram'              => 'nullable|regex:/^[a-zA-Z0-9._-]+$/',        // должно соответствовать формату userName99._-
                'telegram_checked'      => 'nullable|regex:/^1$/',                      // должно соответствовать формату 1
                'instagram'             => 'nullable|regex:/^[a-zA-Z0-9._-]+$/',        // должно соответствовать формату userName99._-
                'instagram_checked'     => 'nullable|regex:/^1$/',                      // должно соответствовать формату 1
                'facebook'              => 'nullable|regex:/^[a-zA-Z0-9._-]+$/',        // должно соответствовать формату userName99._-
                'facebook_checked'      => 'nullable|regex:/^1$/',                      // должно соответствовать формату 1
                'vk'                    => 'nullable|regex:/^[a-zA-Z0-9._-]+$/',        // должно соответствовать формату userName99._-
                'vk_checked'            => 'nullable|regex:/^1$/',                      // должно соответствовать формату 1
                // TODO: подумать над правилом валидации поля "О себе". Как вариант - использовать регулярное выражение.
            ]);

            // Перезапись имени файла если оно есть
            if ($r->avatar) {
                $profile->avatar = Images::image(600, 600, 'avatar', '../public/img/avatars/');
            }

            $profile->about                     = $r->about;
            $profile->city                      = $r->city;

            $profile->phone                     = $r->phone;
            $profile->phone_checked             = NULL;
            if ($r->phone_checked) {
                $profile->phone_checked         = $r->phone_checked;
            }

            $profile->telegram                  = $r->telegram;
            $profile->telegram_checked          = NULL;
            if ($r->telegram_checked) {
                $profile->telegram_checked      = $r->telegram_checked;
            }

            $profile->whatsapp                  = $r->whatsapp;
            $profile->whatsapp_checked          = NULL;
            if ($r->whatsapp_checked) {
                $profile->whatsapp_checked      = $r->whatsapp_checked;
            }

            $profile->instagram                 = $r->instagram;
            $profile->instagram_checked         = NULL;
            if ($r->instagram_checked) {
                $profile->instagram_checked     = $r->instagram_checked;
            }

            $profile->facebook                  = $r->facebook;
            $profile->facebook_checked          = NULL;
            if ($r->facebook_checked) {
                $profile->facebook_checked      = $r->facebook_checked;
            }

            $profile->vk                        = $r->vk;
            $profile->vk_checked                = NULL;
            if ($r->vk_checked) {
                $profile->vk_checked            = $r->vk_checked;
            }


            if ($validator->fails()) {
                // если есть ошибки, то обратно на форму
                return redirect()
                    ->route('profile')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                // если ошибок нет, то сохранение
                if ($profile->save()) {
                    // если сохранено, то на страницу профиля
                    return redirect("/profile/$id");
                }
            }
        }

        // Отладка
        // dd($profile);
        // echo '<pre>';
        // print_r($r->all());
        // echo '</pre>';

        return view('project.formProfileEdit', ['profile' => $profile, 'message' => $message]);
    }
}
