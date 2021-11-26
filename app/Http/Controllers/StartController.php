<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;

use App\Models\Event;

class StartController extends Controller
{
    public function models()
    {
        // $m = Event::find(1);
        // $m->city = 'Nsinsv,trcr';
        // $m->save();

        // Event::where('city', 'Красноярск')->update(['date_end' => 123]);

        $m = Event::find(2);
        $m->delete();




    }

    public function request(Request $r)
    {
        $locale = App::currentLocale();

        // echo '<pre>';
        $val = $r->input('name', 'sergey');
        // echo '</pre>';

        dd($val);

        // echo __('message.welcome', ['name' => 'xxx']);

        // return $val;
    }
}
