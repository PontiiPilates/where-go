<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class TgBotController extends Controller
{

    // @DevTestWgBot_id: 5319356511
    // @pontiipilates_id: 966228736

    // getMe - возвращает данные владельца токена
    // sendMessage - отправляет сообщение в чат с пользователем_id, возвращает json

    /**
     * URL-конструктор
     *
     * @param $method
     * @return string
     */
    protected function url($method)
    {
        return "https://api.telegram.org/bot5319356511:AAFkMf9OonFpyKyn7OzlnKrNKelKpm_b8Wk/$method";
    }

    /**
     * Отправка сообщения
     *
     * @param $chat_id
     * @param $message
     * @return void
     */
    public function sendMessage($chat_id, $message)
    {
        $url = self::url('sendMessage');

        $request = Http::post($url, [
            'chat_id' => $chat_id,
            'text' => $message,
        ]);

        $response = json_decode($request);

        dd($response);
        return $response;

    }

    public function sendButton($chat_id, $message)
    {
        $url = self::url('sendMessage');

        $button = [
            'inline_keyboard' => [
                [
                    [
                        'text' => 'Yes',
                        'callback_data' => 'y',
                    ],
                    [
                        'text' => 'No',
                        'callback_data' => 'n',
                    ]
                ],
            ],
        ];

        $request = Http::post($url, [
            'chat_id' => $chat_id,
            'text' => $message,
            'reply_markup' => json_encode($button),
        ]);

        $response = json_decode($request);

        dd($response);
        return $response;


    }

}
