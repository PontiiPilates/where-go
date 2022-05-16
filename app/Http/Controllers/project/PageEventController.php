<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Profile;
use App\Models\Event;

use Illuminate\Support\Facades\Auth;



class PageEventController extends Controller
{

    public function get(Request $r, $event_id)
    {


        // получение информации о событиях пользователя
        // может быть так, что пользователя может и не быть, поэтому лучше проверить
        $event = DB::table('events')
        ->where('events.id', $event_id)
        ->join('users', 'events.user_id', '=', 'users.id')
        ->select('events.*', 'users.name')
        ->get();
        
        // Получение идентификатора организатора события
        foreach ($event as $v) {
            $creator_id = $v->user_id;
        }

        // Вот как раз проверка на тот случай, если пользователя нет
        if (!isset($creator_id)) {
            return redirect('/error');
        }




        // Получение данных из модели создателя события
        $creator = Profile::firstWhere('user_id', $creator_id);





        // Если пользователь авторизован то:
        if (Auth::id()) {

            // Получение данных из модели данных авторизованного пользователя
            $profile = Profile::firstWhere('user_id', Auth::id());

            // Получение массива закладок пользователя
            $bookmarks = unserialize($profile->bookmarks);


            return view('project.pageEvent', ['event' => $event, 'bookmarks' => $bookmarks, 'creator' => $creator]);
        }

        return view('project.pageEvent', ['event' => $event, 'creator' => $creator]);
    }
}
