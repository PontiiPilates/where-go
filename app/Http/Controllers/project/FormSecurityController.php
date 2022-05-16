<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;


class FormSecurityController extends Controller
{
    // Метод предназначен для поодержки вывода информации о пользователе при двухколоночной верстке
    static function supportProfile()
    {

        $user_id = Auth::id();

        // здесь мы берем данные из базы и возвращаем их пользователю, не важно, пустые они или полные, на это будет реагировать уже сам шаблон
        $profiles = DB::table('profiles')->where('user_id', $user_id)->join('users', 'profiles.user_id', '=', 'users.id')->select('profiles.*', 'users.name')->get();

        // так приходится распаковывать данные полученные из базы, поскольку запрос происходит не из модели
        // а не из модели происходит он потому, что нужен джоин, а как из модели сделать джоин я хз
        foreach ($profiles as $profile) {
            $profile = $profile;
        }

        return $profile;
    }

    public function edit(Request $r)
    {

        $validated = $r->validate([
            'email' => 'email:rfc,dns',
            'current_password' => 'current_password|min:3',
            'password_confirmation' => 'min:3',
            'password' => 'confirmed|min:3',
        ]);

        $user = User::find(Auth::id());




        // если произошла отправка формы
        if ($r->isMethod('post')) {

            // если отправленная форма отвечает за смену почты
            if ($r->has('set_email')) {

                // присваивание нового значения
                $user->email = $r->email;

                // сохранение
                if ($user->save()) {
                    return redirect()->route('success');
                }

                // если отправленная форма отвечает за смену пароля
            } elseif ($r->has('set_password')) {

                // присваиивание нового значения
                $user->password = Hash::make($r->password_confirmation);

                // сохранение
                if ($user->save()) {
                    return redirect()->route('success');
                }
            }
        }

        return view('project.formSecurityEdit', ['user' => $user, 'profile' => self::supportProfile()]);
    }
}
