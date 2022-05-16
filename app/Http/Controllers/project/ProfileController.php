<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


// подключение фассада аутентификации
use Illuminate\Support\Facades\Auth;

use App\Models\Event;


use App\Models\Profile;
// use App\Models\User;

use Illuminate\Support\Facades\DB;



class ProfileController extends Controller
{
    public function get(Request $r, $user_id = null)
    {
        // если $user_id == null, то подразумевается, что авторизованному пользователю должна вернуться его страница
        // это просто красиво, ввести адрес без идентификатора и получить свою страницу
        if ($user_id == null) {
            if (Auth::id()) {
                // продолжаем подразумевать, что пользователь авторизован и сами берем идентификатор
                $user_id = Auth::id();
            } else {
                // но если вдруг пользователь не авторизован, то отправляем его пока на временную страницу ошибки
                return redirect('/error');
            }
        }


        // здесь мы оказываемся в любом случае и сдентификатором, либо не оказываемся совсем, поскольку отправили пользователя на ошибку

        // !не нужно тут ничего создавать, этим занимается FormProfileController


        // // далее происходит запрос в базу данных просто проверить наличие такого пользователя, ведь если мы оказались тут, то user_id у нас уже есть
        // $profile = Profile::firstWhere('user_id', $user_id);
        // if (!$profile) {
        //     // и вот если мы оказались тут, то это означает, что строки пользователя в базе нет, а его идентификатор есть и это только что зарегистрированный человек
        //     // поэтому создаем ему запись в базе, где он может хранить данные профиля
        //     $profile = new Profile;
        //     $profile->user_id = $user_id;
        //     $profile->save();

        //     // и отправляем пользователя сразу же на страницу редактирования профиля, чтобы не смотреть на голый профиль
        //     return redirect('/edit/profile');
        // }

        // здесь мы берем данные из базы и возвращаем их пользователю, не важно, пустые они или полные, на это будет реагировать уже сам шаблон
        $profiles = DB::table('profiles')
            ->where('user_id', $user_id)
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->select('profiles.*', 'users.name')
            ->get();

        // так приходится распаковывать данные полученные из базы, поскольку запрос происходит не из модели
        // а не из модели происходит он потому, что нужен джоин, а как из модели сделать джоин я хз
        foreach ($profiles as $profile) {
            $profile = $profile;
        }

        // Получение массива закладок пользователя
        $bookmarks = unserialize($profile->bookmarks);

        // получение информации о событиях пользователя
        $current_date = date('Y-m-d');

        $events = DB::table('events')
            ->where('user_id', $user_id)
            ->where('status', 1)
            ->where('date_start', '>=', $current_date)
            ->join('users', 'events.user_id', '=', 'users.id')
            ->select('events.*', 'users.name')
            ->get();

        // dd($r->route()->named('profileView'));


        // Получение массива закладок пользователя

        if (Auth::id()) {

            // Получение массива закладок пользователя
            $bookmarks = unserialize($profile->bookmarks);

            return view('project.profile', ['profile' => $profile, 'events' => $events, 'user' => $user_id, 'bookmarks' => $bookmarks]);

        } else {

            return view('project.profile', ['profile' => $profile, 'events' => $events, 'user' => $user_id]);

        }
    }
}