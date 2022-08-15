<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// подключение библиотеки кастомных методов
use App\Models\library\Base;
// подключение помощника Auth
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    /**
     * Главная страница
     * @param $r object объект класса Request
     * @return mixed
     */
    public function getEvents(Request $r)
    {
        if (Auth::id()) {
            // если пользователь авторизован, то формирование сессии из его данных
            Base::sessionRefresh();
        }

        // обращение к временному хранилищу
        $localstorage = Base::getLocalstorage();

        // получение GET-параметров
        $selector = $r->selector;

        // селекторы событий событий
        if ($selector == 'Бесплатно или донат') {
            $events = Base::getFirstQuery('selector__бесплатно_или_донат');
        } elseif ($selector == 'Можно с детьми') {
            $events = Base::getFirstQuery('selector__можно_с_детьми');
        } elseif ($selector == 'В эти выходные') {
            $events = Base::getFirstQuery('selector__в_эти_выходные');
        } elseif ($selector == 'Активный отдых') {
            $events = Base::getFirstQuery('selector__активный_отдых');
        } elseif ($selector == 'Бизнес, карьера') {
            $events = Base::getFirstQuery('selector__бизнес_карьера');
        } elseif ($selector == 'Выставки, экскурсии') {
            $events = Base::getFirstQuery('selector__выставки_экскурсии');
        } elseif ($selector == 'Йога, медитации') {
            $events = Base::getFirstQuery('selector__йога_медитации');
        } elseif ($selector == 'Концерты, выступления') {
            $events = Base::getFirstQuery('selector__концерты_выступления');
        } elseif ($selector == 'Лекции, мастер-классы') {
            $events = Base::getFirstQuery('selector__лекции_мастерклассы');
        } elseif ($selector == 'Психология, саморазвитие') {
            $events = Base::getFirstQuery('selector__психология_саморазвитие');
        } elseif ($selector == 'Спорт, здоровье') {
            $events = Base::getFirstQuery('selector__спорт_здоровье');
        } elseif ($selector == 'Ярмарки, фестивали') {
            $events = Base::getFirstQuery('selector__ярмарки_фестивали');
        } elseif ($selector == 'Другое ...') {
            $events = Base::getFirstQuery('selector__другое');
        } else {
            $events = Base::getFirstQuery('unfiltrated');
        }

        // обработка выводимых событий
        $events = Base::eventsFinished($events);

        return view('listEvents', [
            'localstorage' => $localstorage,
            'events' => $events
        ]);
    }
}
