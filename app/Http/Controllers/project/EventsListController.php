<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Подключение модели таблицы базы данных, с которой предстоит взаимодействовать
// use App\Models\Event;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;


// Подключение модели данных профиля для измлечения массива с идентификаторами закладок
use App\Models\Profile;

class EventsListController extends Controller
{
    public function getGeneral(Request $r)
    {

        $date_start = $r->date_start;
        $date_end = $r->date_end;
        $category = $r->category;
        $city = $r->city;
        $current_date = date('Y-m-d');

        // $auth = Auth::id();
        // echo '<pre>';
        // print_r($_POST);
        // print_r($r->date_start);
        // var_dump($date_start);
        // var_dump($date_end);
        // echo '</pre>';

        // Управление количеством записей при пагинации
        $limit = 30;

        if ($date_start and $date_end and !$category and !$city) {
            // print 'Ds + De';
            $events = DB::table('events')
                ->where('date_start', '>=', $current_date) // не показываем прошедшие события
                ->where('status', 1)
                ->whereBetween('date_start', [$date_start, $date_end])
                ->join('users', 'events.user_id', '=', 'users.id')
                ->select('events.*', 'users.name')
                ->orderBy('date_start')
                ->simplePaginate($limit);
            // ->get();
        } elseif ($date_start and $date_end and $category and !$city) {
            // print 'Ds + De + Cat';
            $events = DB::table('events')
                ->where('date_start', '>=', $current_date) // не показываем прошедшие события
                ->where('status', 1)
                ->where('category', $category)
                ->whereBetween('date_start', [$date_start, $date_end])
                ->join('users', 'events.user_id', '=', 'users.id')
                ->select('events.*', 'users.name')
                ->orderBy('date_start')
                ->simplePaginate($limit);
            // ->get();
        } elseif ($date_start and !$date_end and !$category and !$city) {
            // print 'Ds';
            $events = DB::table('events')
                ->where('date_start', '>=', $current_date) // не показываем прошедшие события
                ->where('status', 1)
                ->where('date_start', '>=', $date_start)
                ->join('users', 'events.user_id', '=', 'users.id')
                ->select('events.*', 'users.name')
                ->orderBy('date_start')
                ->simplePaginate($limit);
            // ->get();
        } elseif ($date_start and $category and !$date_end and !$city) {
            // print 'Ds + Cat';
            $events = DB::table('events')
                ->where('date_start', '>=', $current_date) // не показываем прошедшие события
                ->where('status', 1)
                ->where('category', $category)
                ->where('date_start', '>=', $date_start)
                ->join('users', 'events.user_id', '=', 'users.id')
                ->select('events.*', 'users.name')
                ->orderBy('date_start')
                ->simplePaginate($limit);
            // ->get();
        } elseif ($city and $date_start and !$date_end and !$category) {
            $events = DB::table('events')
                ->where('date_start', '>=', $current_date) // не показываем прошедшие события
                ->where('city', '=', $city)
                ->where('status', 1)
                ->join('users', 'events.user_id', '=', 'users.id')
                ->select('events.*', 'users.name')
                ->orderBy('date_start')
                ->simplePaginate($limit);
        } elseif ($city and $date_start and $date_end and !$category) {
            $events = DB::table('events')
                ->where('date_start', '>=', $current_date) // не показываем прошедшие события
                ->where('city', '=', $city)
                ->where('status', 1)
                ->whereBetween('date_start', [$date_start, $date_end])
                ->join('users', 'events.user_id', '=', 'users.id')
                ->select('events.*', 'users.name')
                ->orderBy('date_start')
                ->simplePaginate($limit);
        } elseif ($city and $date_start and $date_end and $category) {
            $events = DB::table('events')
                ->where('date_start', '>=', $current_date) // не показываем прошедшие события
                ->where('city', '=', $city)
                ->where('status', 1)
                ->where('category', $category)
                ->whereBetween('date_start', [$date_start, $date_end])
                ->join('users', 'events.user_id', '=', 'users.id')
                ->select('events.*', 'users.name')
                ->orderBy('date_start')
                ->simplePaginate($limit);
        } elseif ($city and $date_start and !$date_end and $category) {
            // print 'Ci + DS + Ca';
            $events = DB::table('events')
                ->where('date_start', '>=', $current_date) // не показываем прошедшие события
                ->where('city', '=', $city)
                ->where('status', 1)
                ->where('category', $category)
                // ->whereBetween('date_start', [$date_start, $date_end])
                ->join('users', 'events.user_id', '=', 'users.id')
                ->select('events.*', 'users.name')
                ->orderBy('date_start')
                ->simplePaginate($limit);
        } else {
            // print 'None';
            $events = DB::table('events')
                ->where('date_start', '>=', $current_date) // не показываем прошедшие события
                ->where('status', 1)
                ->join('users', 'events.user_id', '=', 'users.id')
                ->select('events.*', 'users.name')
                ->orderBy('date_start')
                ->simplePaginate($limit);
            // ->get();
        }



        // Если пользователь авторизован то:
        if (Auth::id()) {

            // Получение данных из модели данных авторизованного пользователя
            $profile = Profile::find(Auth::id());

            // Получение массива закладок пользователя
            $bookmarks = unserialize($profile->bookmarks);

            return view('project.general', ['events' => $events, 'bookmarks' => $bookmarks]);
        }

        return view('project.general', ['events' => $events]);
    }
}
