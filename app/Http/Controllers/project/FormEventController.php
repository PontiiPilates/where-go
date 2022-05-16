<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\library\Images;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;


use App\Models\Event;
use App\Models\Profile;
use App\Events\ActionCreate;

class FormEventController extends Controller
{
    // Метод предназначен для поодержки вывода информации о пользователе при двухколоночной верстке
    static function supportProfile()
    {

        $user_id = Auth::id();

        // здесь мы берем данные из базы и возвращаем их пользователю, не важно, пустые они или полные, на это будет реагировать уже сам шаблон
        $profiles = DB::table('profiles')->where('user_id', $user_id)->join('users', 'profiles.user_id', '=', 'users.id')->select('profiles.*', 'users.name')->get();

        // так приходится распаковывать данные полученные из базы, поскольку запрос происходит не из модели
        // а не из модели происходит он потому, что нужен джоин, а как из модели сделать джоин я хз
        foreach ($profiles as $profile) {
            $profile = $profile;
        }

        return $profile;
    }

    public function create(Request $r)
    {

        $validated = $r->validate([
            'title' => 'filled',
            'description' => 'filled',
            'adress' => 'filled',
            'date_start' => 'filled',
        ]);

        
        

        // 125<script>alert('atention')</script>
        
        // alpha_num - проверяет, является ли значение полностью буквенно-цифровым
        // filled - проверяет поле на заполненность
        // regex:* - проверяет отправленные данные на соответствие регулярному выражению
        
        
        // Если произошла отправка формы
        if ($r->isMethod('post')) {
            // dd('done');

            // Сохранение события
            $event = new Event;

            $event->user_id         = Auth::id();

            $event->title           = $r->title;
            $event->description     = $r->description;

            $event->category        = $r->category;


            $event->city            = $r->city;
            $event->adress          = $r->adress;

            $event->date_start      = $r->date_start;
            $event->date_end        = $r->date_end;

            $event->time_start      = $r->time_start;
            $event->time_end        = $r->time_end;

            $event->preview         = Images::image(575, 575, 'preview', '../public/img/previews/');

            $event->price_type      = $r->price_type;
            $event->cost            = $r->cost;

            if ($r->witness) {
                $event->witness     = 1;
            } else {
                $event->witness     = NULL;
            }

            $event->status          = 1;

            if ($event->save()) {
                // ActionCreate::dispatch($event);
                return redirect('/profile');
            }
        }

        // Это переменная которая позволяет пользователю иметь возможность быть свидетелем
        // Так пользователь сможет публиковать наряду со своими событиями, события без контактов, принимая роль не организатора а свидетеля
        $status = Profile::firstWhere('user_id', Auth::id());
        $status = $status->witness;
        // dd($status);


        return view('project.formEventEdit', ['status' => $status, 'event' => '', 'profile' => self::supportProfile()]);
    }

    public function edit(Request $r, $event_id)
    {
        // получение данных строки по ее id
        $event = Event::find($event_id);

        // Если произошла отправка формы
        if ($r->isMethod('post')) {

            $validator = Validator::make($r->all(), [
                'preview'           => 'mimes:jpeg,png',                                        // должно быть в формате jpeg или png
                'title'             => 'required|min:3',                                        // TODO: указать нежелательные символы
                'description'       => 'required|min:10',                                       // TODO: указать нежелательные символы
                'city'              => 'alpha',                                                 // должно состоять из букв
                'category'          => 'alpha',                                                 // должно состоять из букв
                'adress'            => 'required',                                              // должно состоять из букв
                'date_start'        => 'required',                                              // должно состоять из букв
                'time_start'        => 'nullable',                                              // должно состоять из букв
                'date_end'          => 'nullable',                                              // должно состоять из букв
                'time_end'          => 'nullable',                                              // должно состоять из букв
                'cost'              => 'required_if:price_type,==,price|regex:/^[0-9]+$/',      // обязательно если выбран радио + целое число
                'price_type'        => 'required',                                              // обязательно
                // TODO: price_type переделать на select
            ]);


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
                $event->preview     = Images::image(575, 575, 'preview', '../public/img/previews/');
            }

            $event->price_type      = $r->price_type;
            $event->cost            = $r->cost;

            if ($r->witness) {
                $event->witness     = 1;
            } else {
                $event->witness     = NULL;
            }

            $event->status          = 1;

            if ($validator->fails()) {
                // если есть ошибки, то обратно на форму
                return redirect("/edit/event/$event_id")
                    // ->route("/edit/event/$event_id")
                    ->withErrors($validator)
                    ->withInput();
            } else {
                // если ошибок нет, то сохранение
                if ($event->save()) {
                    // если сохранено, то на страницу профиля
                    return redirect("/profile");
                    // return redirect()->route('success');
                }
            }
        }

        // Это переменная которая позволяет пользователю иметь возможность быть свидетелем
        // Так пользователь сможет публиковать наряду со своими событиями, события без контактов, принимая роль не организатора а свидетеля
        $status = Profile::firstWhere('user_id', Auth::id());
        $status = $status->witness;
        // dd($status);

        return view('project.formEventEdit', ['status' => $status, 'event' => $event, 'profile' => self::supportProfile()]);
    }
}
