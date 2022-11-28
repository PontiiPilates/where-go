<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TgWebhookController extends Controller
{
    /**
     * URL-конструктор
     */
    protected function url($method)
    {
        return "https://api.telegram.org/bot5319356511:AAFkMf9OonFpyKyn7OzlnKrNKelKpm_b8Wk/$method";
    }

    /**
     * Установка адреса в качестве вебхука
     * Осуществляется единожды.
     */
    public function setWebhook() {
        
        $url = self::url('setWebhook?url=https://where-go.ru/tgwebhook');

        $http = \Illuminate\Support\Facades\Http::get($url);

        dd(json_decode($http->body()));

    }


    /**
     * Управление вебхуком
     */
    public function index() {
        dd('Hello');
    }
}
