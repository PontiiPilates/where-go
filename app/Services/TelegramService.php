<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 ** Реализует функционал Telegram-бота
 */
class TelegramService
{
    /**
     ** Конструктор метода отправки запроса
     */
    private function request($method, $param = null)
    {
        // получение токена из конфигурационного файла
        $token_wgbot = config('telegram.token_wgbot');

        // получение результата отправки запроса
        return Http::post("https://api.telegram.org/$token_wgbot/$method", $param);
    }

    /**
     ** Установка вебхука
     ** Реализация метода setWebhook
     ** Требуется однократная установка
     *
     ** $url* - маршрут, который должен быть зарегистрирован в качестве вебхука
     */
    public function setWebhook($url)
    {
        // получение токена из конфигурационного файла
        $token_wgbot = config('telegram.token_wgbot');

        // получение результата отправки запроса
        $request = Http::get("https://api.telegram.org/$token_wgbot/setWebhook?url=$url");

        // отладка
        dd(json_decode($request));
    }

    /**
     ** Получение информации о вебхуке
     ** Реализация метода getWebhookInfo
     */
    public function infoWebhook()
    {
        // получение токена из конфигурационного файла
        $token_wgbot = config('telegram.token_wgbot');

        // получение результата отправки запроса
        $request = Http::get("https://api.telegram.org/$token_wgbot/getWebhookInfo");

        // отладка
        dd(json_decode($request));
    }

    /**
     ** Запись в log-файл данных, принятых вебхуком
     */
    public function tgWebhook($r)
    {
        // отладка: получение всех данных, принятых вебхуком
        Log::debug($r->all());

        // отладка: получение данных отправленной кнопки
        Log::debug($r->input('callback_query')['data']);
        // отладка: получение данных идентификатора отправленного сообщения
        Log::debug($r->input('callback_query')['message']['message_id']);
        // отладка: получение данных текста изменяемого сообщения
        Log::debug($r->input('callback_query')['message']['text']);
        // отладка: получение данных отправителя
        Log::debug($r->input('callback_query')['message']['from']['id']);
        // отладка: получение данных чата
        Log::debug($r->input('callback_query')['message']['chat']['id']);
    }

    /**
     ** Отправка сообщения
     ** Реализация метода sendMessage
     ** В случае успеха возвращается отправленное сообщение
     ** Doc: https://core.telegram.org/bots/api#sendmessage
     * 
     ** $chat_id* - идентификатор пользователя, с которым происходит чат
     ** $message_body* - тело сообщения
     */
    public function sendMessage($chat_id, $message_body)
    {
        // подготовка данных
        $param = [
            'chat_id' => $chat_id,
            'text' => '<b>' . $message_body . '</b>',
            'parse_mode' => 'html',
        ];

        // получение результата отправки запроса
        $request = self::request('sendMessage', $param);

        // для отладки
        dd(json_decode($request));
    }

    /**
     ** Отправка сообщения с кнопками
     ** Релизация метода "sendMessage"
     ** В случае успеха возвращается отправленное сообщение
     ** Doc: https://core.telegram.org/bots/api#sendmessage
     *
     ** $chat_id* - идентификатор пользователя, с которым происходит чат
     ** $message_body* - тело сообщения
     ** $buttons* - кнопки
     */
    public function sendButtons($chat_id, $message_body, $buttons)
    {
        // подготовка данных
        $param = [
            'chat_id' => $chat_id,
            'text' => '<b>' . $message_body . '</b>',
            'parse_mode' => 'html',
            'reply_markup' => json_encode($buttons),
        ];

        // получение результата отправки запроса
        $request = self::request('sendMessage', $param);

        // для отладки
        dd(json_decode($request));
    }

    /**
     ** Редактирование сообщения с кнопками
     ** Релизация метода "editMessageText"
     ** В случае успеха возвращается отправленное сообщение
     ** Doc: https://core.telegram.org/bots/api#sendmessage
     *
     ** $chat_id* - идентификатор пользователя, с которым происходит чат
     ** $message_body* - тело сообщения
     ** $buttons* - кнопки
     ** $message_id* - идентификатор сообщения с кнопками
     */
    public function editButtons($chat_id, $message_body, $buttons, $message_id)
    {
        // подготовка данных
        $param = [
            'chat_id' => $chat_id,
            'text' => '<b>' . $message_body . '</b>',
            'parse_mode' => 'html',
            'reply_markup' => json_encode($buttons),
            'message_id' => $message_id,
        ];

        // получение результата отправки запроса
        $request = self::request('editMessageText', $param);

        // для отладки
        dd(json_decode($request));
    }

    /**
     ** Набор кнопок
     ** Принять/Отклонить 
     */
    public function kitAcceptReject()
    {
        return [
            'inline_keyboard' => [
                [
                    [
                        'text' => 'Принять',
                        'callback_data' => '1',
                    ],
                    [
                        'text' => 'Отклонить',
                        'callback_data' => '0',
                    ]
                ],
            ],
        ];
    }

    /**
     ** Набор измененных кнопок для "Принято"
     */
    public function kitAcceptedReplace()
    {
        return [
            'inline_keyboard' => [
                [
                    [
                        'text' => '✅ Принято',
                        'callback_data' => '1',
                    ],
                    [
                        'text' => 'Отклонить',
                        'callback_data' => '0',
                    ]
                ],
            ],
        ];
    }

    /**
     ** Набор измененных кнопок для "Отклонено"
     */
    public function kitRejectedReplace()
    {
        return [
            'inline_keyboard' => [
                [
                    [
                        'text' => 'Принять',
                        'callback_data' => '1',
                    ],
                    [
                        'text' => '❎ Отклонено',
                        'callback_data' => '0',
                    ]
                ],
            ],
        ];
    }
}
