<?php

namespace App\Http\Controllers;

use App\Services\TelegramService;
use Illuminate\Http\Request;


class TelegramController extends Controller
{
    // сервис-контейнер
    private $telegram_service;

    /**
     * Внедрение зависимости через конструктор класса
     * Чтобы не внедрять зависимость в каждый метод отдельно
     */
    public function __construct(TelegramService $telegram_service)
    {
        $this->telegram_service = $telegram_service;
    }

    /**
     ** Установка вебхука
     */
    public function setWebhook()
    {
        $this->telegram_service->setWebhook('https://where-go.ru/tgwebhook');
    }

    /**
     ** Получение информации о вебхуке
     */
    public function infoWebhook()
    {
        $this->telegram_service->infoWebhook();
    }

    /**
     ** Обработка ответов вебхуком
     */
    public function tgWebhook(Request $r)
    {
        // запись в log-файл данных, принятых вебхуком
        // $this->telegram_service->tgWebhook($r);

        $calback_query = $r->input('callback_query')['data'];
        $message_id = $r->input('callback_query')['message']['message_id'];
        $message_body = $r->input('callback_query')['message']['text'];
        $chat_id = $r->input('callback_query')['message']['chat']['id'];

        if ($calback_query == 1) {
            $this->telegram_service->editButtons($chat_id, $message_body, $this->telegram_service->kitAcceptedReplace(), $message_id);
        }

        if ($calback_query == 0) {
            $this->telegram_service->editButtons($chat_id, $message_body, $this->telegram_service->kitRejectedReplace(), $message_id);
        }
    }

    /**
     ** Отправка сообщения
     */
    public function sendMessage($chat_id, $message_body)
    {
        $this->telegram_service->sendMessage($chat_id, $message_body);
    }

    /**
     ** Отправка сообщения с кнопками
     */
    public function sendButtons($chat_id, $message_body)
    {
        // принять/отклонить
        $this->telegram_service->sendButtons($chat_id, $message_body, $this->telegram_service->kitAcceptReject());
    }

    /**
     ** Редактирование сообщения с кнопками
     */
    public function editButtons($chat_id, $message_body, $message_id)
    {
        // принять/отклонить
        $this->telegram_service->editButtons($chat_id, $message_body, $this->telegram_service->kitAcceptRejectReplace(), $message_id);
    }
}
