<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Подключение DB
use Illuminate\Support\Facades\DB;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     * TODO: Засеять массивы "a:0:{}" вот так
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'user_id' => '1',
            'avatar' => '2022_07_16__06_55_44__nwxpk.jpeg',
            'about' => 'Путешествую по всему миру, радуюсь жизни и делюсь красотой.',
            'phone' => '+79082112043',
            'phone_checked' => 'checked',
            'vk' => 'Михаил Ергаков',
            'vk_checked' => 'checked',
            'whatsapp' => '+79082112043',
            'whatsapp_checked' => 'checked',
            'bookmarks' => 'a:0:{}',
            'favourites' => "a:0:{}",
            'follovers' => "a:0:{}",
            'going' => "a:0:{}",
        ]);
        DB::table('profiles')->insert([
            'user_id' => '7',
            'avatar' => '2022_07_09__02_54_13__ibpso.jpeg',
            'about' => 'Urban Nomad. Походовед 80 уровня.',
            'bookmarks' => 'a:0:{}',
            'favourites' => "a:0:{}",
            'follovers' => "a:0:{}",
            'going' => "a:0:{}",
            'witness' => "1",
        ]);
    }
}
