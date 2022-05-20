<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

// + Подключение модели Profile для взаимодействия с таблицей profiles
use App\Models\Profile;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // + Получение идентификатора авторизованного пользователя
        $user_id = Auth::id();

        // + Создание экземпляра класса Profile
        $profile = new Profile;

        // + Добавление идентификатора зарегистрировавшегося пользователя в экземпляр класса
        $profile->user_id = Auth::id();
        // + Стандартного аватара
        $profile->avatar = 'default.jpg';

        // + Сохранение модели в таблицу
        $profile->save();

        // - return redirect(RouteServiceProvider::HOME);

        // + Переход на страницу зарегистрировавшегося пользователя
        return redirect("/user/$user_id");
    }
}
