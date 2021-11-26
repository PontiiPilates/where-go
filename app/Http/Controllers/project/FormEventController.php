<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;

// Подключение Request для обработки запросо
use Illuminate\Http\Request;
// Подключение модели Event для взаимодействия с таблицей базы данных
use App\Models\Event;
// Подключение Auth для работы с аутентификацией
use Illuminate\Support\Facades\Auth;

class FormEventController extends Controller
{
    public function create(Request $r)
    {
        // Отладка
        echo '<pre>';
        // print_r($r->all());
        // print $d;
        echo '</pre>';

        // Если произошла отправка формы
        if ($r->isMethod('post')) {

            // Сохранение события
            $event = new Event;

            $event->user_id         = Auth::id();

            $event->category        = $r->category;

            $event->title           = $r->title;
            $event->description     = $r->description;

            $event->city            = $r->city;
            $event->adress          = $r->adress;

            $event->date_start      = $r->date_start;
            $event->date_end        = $r->date_end;

            $event->time_start      = $r->time_start;
            $event->time_end        = $r->time_end;

            $event->preview         = $r->preview;

            $event->cost            = $r->cost;
            $event->free            = $r->free;

            if ($event->save()) {
                return redirect()->route('eventSuccess');
            }
        }

        return view('project.formEventCreate');
    }

    public function edit($id, Request $r)
    {
        // Получение данных события по его id
        $event = Event::find($id);

        // Если произошла отправка формы
        if ($r->isMethod('post')) {

            $event->category        = $r->category;

            $event->title           = $r->title;
            $event->description     = $r->description;

            $event->city            = $r->city;
            $event->adress          = $r->adress;

            $event->date_start      = $r->date_start;
            $event->date_end        = $r->date_end;

            $event->time_start      = $r->time_start;
            $event->time_end        = $r->time_end;

            // Перезапись имени файла если оно есть
            if ($r->preview) {
                $event->preview     = $r->preview;
            }

            $event->cost            = $r->cost;
            $event->free            = $r->free;

            if ($event->save()) {
                return redirect()->route('eventSuccess');
            }
        }

        // Отладка
        echo '<pre>';
        // print_r($r->all());
        // print $d;
        echo '</pre>';

        // dd($event);

        return view('project.formEventEdit', ['event' => $event]);
    }
}


// // TODO: получить id пользователя
// // TODO: затащить его в базу данных
// // TODO: переформировать таблицу в базе данных
// // TODO: различить сценарий создания и сценарий редактирования
// // TODO: после успешного создания перенаправить пользователя на страницу что событие успешно создано

// TODO: валидировать данные формы
// TODO: настроить прием, обработку и хранение файлов формы
// TODO: проверять на авторизованность, чтобы гарантировыанно в таблицу попал user id
// TODO: сверстать загрузку файла
// TODO: предоставлять доступ к созданию и редактированию форм если пользователь авторизирован @auth