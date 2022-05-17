<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Подключение DB
use Illuminate\Support\Facades\DB;

class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_data')->insert([
            'user_id' => '1',
            'about' => 'Родился и побрился, а затем покрестился в Северо-Байкальске. В 2002 году переехал в Красноярск. С тех пор организую походы, вездеходы, проходы, переходы. Короче, все организую, что связано с корнем "ходы".',
            'city' => 'Красноярск',
            'phone' => '+7(391) 246-98-60',
            'wp' => '1',
            'wb' => '1',
            'tg' => '1',
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
