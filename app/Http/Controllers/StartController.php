<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;

class StartController extends Controller
{
    public function action()
    {
        $locale = App::currentLocale();

        // echo __('message.welcome', ['name' => 'xxx']);

        return $locale;
    }
}
