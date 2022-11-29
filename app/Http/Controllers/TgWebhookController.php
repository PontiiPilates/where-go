<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Http;


class TgWebhookController extends Controller
{
    /*
     * Конструктор HTTP-запроса
     */
    protected function url($method)
    {
        return "https://api.telegram.org/bot5319356511:AAFkMf9OonFpyKyn7OzlnKrNKelKpm_b8Wk/$method";
    }

    /*
     * Реализация setWebhook
     * Регистрирует хост в качестве вебхука
     * Требуется единожды 
     */
    public function set()
    {
        // сборка запроса
        $url = self::url('setWebhook?url=https://where-go.ru/tgwebhook');

        // отправка запроса
        $http = \Illuminate\Support\Facades\Http::get($url);

        // получение ответа
        dd(json_decode($http->body()));
    }


    /*
     * Реализация getWebhookInfo
     * Получение информации о работе вебхука
     */
    public function info()
    {
        // сборка запроса
        $url = self::url('getWebhookInfo');

        // отправка запроса
        $http = \Illuminate\Support\Facades\Http::get($url);

        // получение ответа
        dd(json_decode($http->body()));
    }

    /*
     * Обработка ответов, принятых вебхуком
     */
    public function tgwebhook(Request $r)
    {
        // Отладка в логи

        // писать в логи всё сообщение, принятое вебхуком
        // Log::debug($r->all());

        // писать в логи только необходимое значение
        // Log::debug($r->input('callback_query')['data']);

        $btn = $r->input('callback_query')['data'];
        
        if($btn == 'y') {
            Http::post('https://api.telegram.org/bot5319356511:AAFkMf9OonFpyKyn7OzlnKrNKelKpm_b8Wk/sendMessage', ['chat_id' => 966228736, 'text' => 'Получен положительный ответ',]);
        }

        if($btn == 'n') {
            Http::post('https://api.telegram.org/bot5319356511:AAFkMf9OonFpyKyn7OzlnKrNKelKpm_b8Wk/sendMessage', ['chat_id' => 966228736, 'text' => 'Ну и ладно',]);
        }
    }
}
