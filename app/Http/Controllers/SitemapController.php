<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Получение модели таблицы событий
use App\Models\Event;


use Illuminate\Support\Facades\DB;


class SitemapController extends Controller
{
    public function getSitemap()
    {

        // Получение данных по событиям
        $events = Event::where('status', 1)->get();

        $event_freq = 'daily';
        $user_freq = 'daily';
        $priority_first = 1;
        $priority_secondary = 0.8;
        $path_event = 'https://where-go.ru/event/';
        $path_profile = 'https://where-go.ru/profile/';

        foreach ($events as $event) {

            // Получение идентификатора
            $id = $event->id;

            // Получение и преобразование даты
            $updated_at = $event->updated_at;   // Carbon
            $updated_at = collect($updated_at); // Collect
            $updated_at = $updated_at->all(); // All
            $updated_at = $updated_at[0]; // First
            $updated_at = substr($updated_at, 0, 10); // Сut

            // dd($updated_at);

            $data[] = array(
                'link' => $path_event . $id,
                'updated_at' => $updated_at,
                'freq' => $event_freq,
                'priority' => $priority_first,
            );
        }


        // Получение данных о пользователяx
        $profiles = DB::table('profiles')
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->select('profiles.*', 'users.name')
            ->get();


        foreach ($profiles as $profile) {

            $id = $profile->id;

            // Получение и преобразование даты
            $updated_at = $profile->updated_at;   // Carbon
            $updated_at = collect($updated_at); // Collect
            $updated_at = $updated_at->all(); // All
            $updated_at = $updated_at[0]; // First
            $updated_at = substr($updated_at, 0, 10); // Сut


            $data[] = array(
                'link' => $path_profile . $id,
                'updated_at' => $updated_at,
                'freq' => $user_freq,
                'priority' => $priority_secondary,
            );
        }
        // dd($data);




        return view('sitemap', ['data' => $data]);
    }
}
