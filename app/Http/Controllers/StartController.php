<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;

use App\Models\Event;

use Illuminate\Support\Facades\Hash;

use App\Models\Order;
use App\Events\ActionCreate;

class StartController extends Controller
{
    public function models()
    {
        // $m = Event::find(1);
        // $m->city = 'Nsinsv,trcr';
        // $m->save();

        // Event::where('city', 'Красноярск')->update(['date_end' => 123]);

        // $m = Event::find(2);
        // $m->delete();

        $p = 123;
        $p = Hash::make($p);
        dd($p);
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

    public function store(Request $r, $id)
    {
        // dd($id);

        $order = Order::findOrFail($id);

        if ($id == 1) {
            ActionCreate::dispatch($order);
        } else {
            return 'nothink';
        }
    }

    public function filters(Request $r)
    {
        return view('project.dev');
    }
}
