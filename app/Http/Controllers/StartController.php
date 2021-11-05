<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;

class StartController extends Controller
{
    public function action(Request $r)
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