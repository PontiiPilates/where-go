<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Support\Facades\DB;


class BookmarksController extends Controller
{
    public function add(Request $r, $event_id)
    {

        // Объявление переменных
        $user_id = Auth::id();
        $event_id = $event_id;

        // Получение модели
        $profile = Profile::find($user_id);

        // Извлечение массива с закладками
        $bookmarks = $profile->bookmarks;
        $bookmarks = unserialize($bookmarks);

        // Добавление нового элемента в массив
        $bookmarks[] = $event_id;
        $bookmarks = serialize($bookmarks);
        $profile->bookmarks = $bookmarks;

        // Сохранение в базу данных
        if ($profile->save()) {
            print 'Ok';
        }
    }

    public function remove(Request $r, $event_id)
    {
        // Объявление переменных
        $user_id = Auth::id();
        $event_id = $event_id;

        // Получение модели
        $profile = Profile::find($user_id);

        // Извлечение массива с закладками
        $bookmarks = $profile->bookmarks;
        $bookmarks = unserialize($bookmarks);

        // Удаление элемента из массива
        foreach ($bookmarks as $key => $item) {
            if ($item == $event_id) {
                unset($bookmarks[$key]);
            }
        }

        $bookmarks = serialize($bookmarks);
        $profile->bookmarks = $bookmarks;

        // Сохранение в базу данных
        if ($profile->save()) {
            print 'Ok';
        }
    }

    public function get()
    {
        // Объявление переменных
        $user_id = Auth::id();


        // Получение модели профиля для извлечения закладок
        $profile = Profile::find($user_id);

        // Извлечение массива с закладками
        $bookmarks = $profile->bookmarks;
        $bookmarks = unserialize($bookmarks);


        // здесь мы берем данные из базы и возвращаем их пользователю, не важно, пустые они или полные, на это будет реагировать уже сам шаблон
        $profiles = DB::table('profiles')
            ->where('user_id', $user_id)
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->select('profiles.*', 'users.name')
            ->get();

        // так приходится распаковывать данные полученные из базы, поскольку запрос происходит не из модели
        // а не из модели происходит он потому, что нужен джоин, а как из модели сделать джоин я хз
        foreach ($profiles as $profile) {
            $profile = $profile;
        }

        // dd($profiles->avatar);

        // Если закладки существуют            

        // Получение выборки событий
        $events = DB::table('events')
            ->whereIn('events.id', $bookmarks)
            ->where('status', 1)
            ->join('users', 'events.user_id', '=', 'users.id')
            ->select('events.*', 'users.name')
            ->get();


        return view('project.bookmarks', ['events' => $events, 'profile' => $profile, 'user' => Auth::id(), 'bookmarks' => $bookmarks]);
    }
}
