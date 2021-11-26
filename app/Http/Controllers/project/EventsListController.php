<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Подключение модели таблицы базы данных, с которой предстоит взаимодействовать
// use App\Models\Event;
use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Facades\Auth;

class EventsListController extends Controller
{
    public function getGeneral(Request $r)
    {

        $date_start = $r->date_start;
        $date_end = $r->date_end;

        // $auth = Auth::id();
        // echo '<pre>';
        // print_r($_POST);
        // print_r($r->date_start);
        // var_dump($date_start);
        // var_dump($date_end);
        // echo '</pre>';

        if ($date_start and $date_end) {
            // print 'Сейчас битвин выполняется';
            $events = DB::table('events')
                ->where('status', 1)
                ->whereBetween('date_start', [$date_start, $date_end])
                ->join('users', 'events.user_id', '=', 'users.id')
                ->select('events.*', 'users.name')
                ->get();
        } elseif ($date_start) {
            // print 'Сейчас вэре выполняется';
            $events = DB::table('events')
                ->where('status', 1)
                ->where('date_start', '>=', $date_start)
                ->join('users', 'events.user_id', '=', 'users.id')
                ->select('events.*', 'users.name')
                ->get();
        } else {
            // print 'Сейчас всё выполняется';
            $events = DB::table('events')
                ->where('status', 1)
                ->join('users', 'events.user_id', '=', 'users.id')
                ->select('events.*', 'users.name')
                ->get();
        }




        // dd($auth);

        // Так было в первый вариант
        // $events = Event::all();

        // А так стало во сторой версии




        // $d = Event::find(2);

        // dd($d);


        // foreach (Event::all() as $item) {
        //     print $item->title . '<br>';
        // }



        return view('project.general', ['events' => $events]);
    }
}
