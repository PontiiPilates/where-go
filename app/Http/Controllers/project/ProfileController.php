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
    public function get($user_id) {

            // Если id пользователя не указан, то подразумевается аутентифицированный пользователь
            // $user_id = Auth::id();


        // $profile = Profile::firstWhere('user_id', $user_id);

        $profiles = DB::table('profiles')->where('user_id', $user_id)->join('users', 'profiles.user_id', '=', 'users.id')->select('profiles.*', 'users.name')->get();
        // $user_name = Auth::user()->name;

        // $profile->all();
        foreach ($profiles as $profile) {
            $profile = $profile;
        }
        // dd($profile);
        
        // $data = $this->hasOne(Profile::class);
        // Получение информации о событиях пользователя
        // $events = Event::where('user_id', $user_id)->get();
        $events = DB::table('events')->where('user_id', $user_id)->join('users', 'events.user_id', '=', 'users.id')->select('events.*', 'users.name')->get();
        // $events = Event::find(1);
        
        // dd($events->all());


        return view('project.profile', ['profile' => $profile, 'events' => $events]);


    }
}

