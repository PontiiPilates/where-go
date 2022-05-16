<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class PastEventsController extends Controller
{
    public function get($user_id)
    {

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

        // получение информации о событиях пользователя

        $current_date = date('Y-m-d');
        // dd($current_date);
        $events = DB::table('events')
            ->where('user_id', $user_id)
            ->where('status', 1)
            ->where('date_start', '<', $current_date)
            ->join('users', 'events.user_id', '=', 'users.id')
            ->select('events.*', 'users.name')
            ->get();


        // return 'Redirect from user: ' . $user_id;

        // отправляем его на страницу профиля
        return view('project.pastEvents', ['profile' => $profile, 'events' => $events]);
    }
}
