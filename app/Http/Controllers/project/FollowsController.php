<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;



class FollowsController extends Controller
{

    // проверка наличия пользователя в таблице
    static function checkRow($user_id)
    {
        // получение результата запроса по условию
        $count = Profile::where('user_id', $user_id)->count();

        // возврат полученного значения
        return $count;
    }

    // Подписка на пользователя
    public function followed(Request $r, $user_id)
    {
        if (!self::checkRow($user_id)) {
            return redirect('/error');
        }

        // Объявление переменных
        $self_id = Auth::id();
        $other_id = $user_id;

        // Приведение значения к int для уменьшения места хранения в базе данных
        settype($other_id, 'int');

        // Получение моделей
        $self_profile = Profile::firstWhere('user_id', $self_id);
        $other_profile = Profile::firstWhere('user_id', $other_id);

        // Извлечение массива с подписками
        $follows = $self_profile->follows;
        $follows = unserialize($follows);

        // Извлечение массива с подписчиками
        $followers = $other_profile->followers;
        $followers = unserialize($followers);

        // Добавление подписки
        $follows[] = $other_id;
        $follows = serialize($follows);

        // Добавление подписчика
        $followers[] = $self_id;
        $followers = serialize($followers);

        // Фиксация результата в модели
        $self_profile->follows = $follows;
        $other_profile->followers = $followers;

        // Сохранение в базу данных
        if ($self_profile->save() && $other_profile->save()) {
            return 1;
        } else {
            return 0;
        }
    }

    // Удаление подписки на пользователя
    public function unfollowed(Request $r, $user_id)
    {

        // Объявление переменных
        $self_id = Auth::id();
        $other_id = $user_id;

        // Получение моделей
        $self_profile = Profile::firstWhere('user_id', $self_id);
        $other_profile = Profile::firstWhere('user_id', $other_id);

        // Извлечение массива с подписками
        $follows = $self_profile->follows;
        $follows = unserialize($follows);

        // Извлечение массива с подписчиками
        $followers = $other_profile->followers;
        $followers = unserialize($followers);

        // Удаление подписки
        foreach ($follows as $key => $item) {
            if ($item == $user_id) {
                unset($follows[$key]);
            }
        }
        $follows = serialize($follows);


        // Удаление подписчика
        foreach ($followers as $key => $item) {
            if ($item == $self_id) {
                unset($followers[$key]);
            }
        }
        $followers = serialize($followers);

        // Фиксация результата в модели
        $self_profile->follows = $follows;
        $other_profile->followers = $followers;

        // Сохранение в базу данных
        if ($self_profile->save() && $other_profile->save()) {
            return 1;
        } else {
            return 0;
        }
    }

    // Просмотр списка подписок
    public function follow(Request $r)
    {
        // Объявление переменных
        $self_id = Auth::id();

        // Получение моделей
        $self_profile = Profile::firstWhere('user_id', $self_id);

        // Извлечение массива с подписками
        $follows = $self_profile->follows;
        $follows = unserialize($follows);

        // Получение данных о подписках
        $follows = DB::table('profiles')
            ->whereIn('user_id', $follows)
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->select('profiles.user_id', 'profiles.avatar', 'profiles.city', 'users.name')
            ->get();

        return view('project.follows', ['follows' => $follows, 'profile' => $self_profile, 'user' => $self_id]);
    }

    // Просмотр списка подписчиков пользователя
    public function followers(Request $r, $user_id)
    {
        
        // Объявление переменных
        $self_id = Auth::id();
        
        // Получение моделей
        $profile = Profile::firstWhere('user_id', $user_id);
        
        // Извлечение массива с подписками
        // TODO: если на меня никто не подписался
        $followers = $profile->followers;
        
        $followers = unserialize($followers);
        // dd($followers);
        
        if(!$followers) {
            return redirect('/error');
        }

        // Получение данных о подписках
        $followers = DB::table('profiles')
            ->whereIn('user_id', $followers)
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->select('profiles.user_id', 'profiles.avatar', 'profiles.city', 'users.name')
            ->get();

        return view('project.follows', ['follows' => $followers, 'profile' => $profile, 'user' => $self_id]);
    }
}
