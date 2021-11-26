<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\Event;

class UserController extends Controller
{
    public function get($id) {

        $profile = Profile::firstWhere('user_id', $id);
        // dd($user);
        
        $events = Event::where('user_id', $id)->get();
        
        // dd($events);
        // print 'Hello Ololo';
        return view('project.user', ['profile' => $profile, 'events' => $events]);
    }
}
