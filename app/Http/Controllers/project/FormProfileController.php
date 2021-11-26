<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Modules\Images\Images;



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

    // создание строки полььзователя с дополнительными данными о нем
    static function createRow()
    {
        // создание экземпляра класса Profile
        $profile = new Profile;

        // получение и запись идентификатора пользователя
        $profile->user_id = Auth::id();

        // сохранение строки в базу данных, true или false
        return $profile->save();
    }



    public function edit(Request $r)
    {
        // если строки с дополнительными данными для пользователя еще нет
        if (self::checkRow() == 0) {
            self::createRow();
        }

        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        Images::a();


        // Получение идентификатора пользователя
        $id = Auth::id();

        // Получение модели для:
        // Использования в качестве данных
        // Внесения изменений
        $profile = Profile::firstWhere('user_id', $id);

        // Если форма была отправлена
        if ($r->isMethod('post')) {

            // Перезапись имени файла если оно есть
            if ($r->avatar) {
                $profile->avatar     = $r->avatar;
            }

            $profile->about = $r->about;

            $profile->city = $r->city;

            $profile->phone = $r->phone;

            $profile->wp = $r->wp;
            $profile->wb = $r->wb;
            $profile->tg = $r->tg;

            $profile->ig = $r->ig;
            $profile->fb = $r->fb;
            $profile->vk = $r->vk;
            $profile->ok = $r->ok;
            $profile->yt = $r->yt;

            // Если удалось внести изменения
            // if ($profile->save()) {
            //     return redirect()->route('profile');
            // }
        }

        // Отладка
        // dd($profile);
        // echo '<pre>';
        // print_r($r->all());
        // echo '</pre>';

        return view('project.formProfileEdit', ['profile' => $profile]);
    }
}
