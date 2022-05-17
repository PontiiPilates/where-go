<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Подключение DB
use Illuminate\Support\Facades\DB;

class UsersDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_data')->insert([
            'user_id' => '1',
            'avatar' => 'default.jpg',
            'about' => 'Родился и побрился, а затем покрестился в Северо-Байкальске. В 2002 году переехал в Красноярск. С тех пор организую походы, вездеходы, проходы, переходы. Короче, все организую, что связано с корнем "ходы".',
            'city' => 'Красноярск',
            'phone' => '+7(391) 246-98-60',
            'wp' => 'on',
            'wb' => 'on',
            'tg' => 'on',
            'ig' => 'https://www.instagram.com/p/CWWBBYfMyww/?utm_medium=copy_link',
            'fb' => 'https://www.facebook.com/daniilkhanin',
            'vk' => 'https://vk.com/zloileshii',
            'ok' => '0',
            'yt' => 'https://www.youtube.com/channel/UCr2EXJtFMunvG0CmYE3Tj8A',
            'bookmarks' => '0',
            'likes' => '0',
            'goes' => '0',
        ]);
        DB::table('users_data')->insert([
            'user_id' => '2',
            'avatar' => 'default.jpg',
            'about' => 'Во время разработки обнаружил решение, которое позволяет сократить количество форм. А именно - убрать форму создания ноды. Существует одна форма, в которую осуществляется вывод информации из базы данных. Эта форма лишь обновляет выгруженные в нее сведения. Но перед ее запуском, контроллер спрашивает базу данных, есть ли такая запист. Если ее нет, то создает. При первом запуске выводит в форму пустые данные.',
            'city' => 'Ачинск',
            'phone' => '+7(391) 246-22-22',
            'wp' => 'on',
            'wb' => 'on',
            'tg' => 'on',
            'ig' => 'https://www.instagram.com/p/CWWBBYfMyww/?utm_medium=copy_link',
            'fb' => 'https://www.facebook.com/daniilkhanin',
            'vk' => 'https://vk.com/zloileshii',
            'ok' => '0',
            'yt' => 'https://www.youtube.com/channel/UCr2EXJtFMunvG0CmYE3Tj8A',
            'bookmarks' => '0',
            'likes' => '0',
            'goes' => '0',
        ]);
    }
}
