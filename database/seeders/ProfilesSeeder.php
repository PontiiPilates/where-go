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
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'user_id' => '1',
            'avatar' => 'zloileshii.jpeg',
            'about' => 'В детстве просыпался под музыку из Санта-барбары. А сейчас думаю, что живешь именно так, как до этого хотел чувствовать свою жизнь.',
            'city' => 'Красноярск',

            'phone' => '+79233341635',
            'phone_checked' => 'checked',

            'facebook' => '100006706128842',
            'facebook_checked' => 'checked',

            'ok' => NULL,
            'ok_checked' => NULL,

            'telegram' => 'zloileshii',
            'telegram_checked' => 'checked',

            'twitter' => 'zloileshii',
            'twitter_checked' => 'checked',

            'instagram' => 'zloileshii',
            'instagram_checked' => 'checked',

            'viber' => NULL,
            'viber_checked' => NULL,

            'vk' => 'zloileshii',
            'vk_checked' => 'checked',

            'whatsapp' => '+79233341635',
            'whatsapp_checked' => 'checked',

            'youtube' => 'UCy1lFhLaelvhk1i51Mv8Ing',
            'youtube_checked' => 'checked',

            'bookmarks' => 'a:1:{i:0;s:1:"0";}',
            'likes' => '0',
            'going' => '0',
        ]);
        DB::table('profiles')->insert([
            'user_id' => '2',
            'avatar' => 'igor.jpeg',
            'about' => 'Люблю ездить на вахту, участвовать в политической жизни, есть плов и шурпу, ходить по спектаклям и свой мерседес.',
            'city' => 'Ачинск',

            'phone' => '+79069141150',
            'phone_checked' => 'checked',

            'facebook' => NULL,
            'facebook_checked' => NULL,

            'ok' => NULL,
            'ok_checked' => NULL,

            'telegram' => NULL,
            'telegram_checked' => NULL,

            'twitter' => NULL,
            'twitter_checked' => NULL,

            'instagram' => NULL,
            'instagram_checked' => NULL,

            'viber' => NULL,
            'viber_checked' => NULL,

            'vk' => 'wimkrsk',
            'vk_checked' => 'checked',

            'whatsapp' => '+79069141150',
            'whatsapp_checked' => 'checked',

            'youtube' => 'AsafievStas',
            'youtube_checked' => 'checked',

            'bookmarks' => 'a:1:{i:0;s:1:"0";}',
            'likes' => '0',
            'going' => '0',
        ]);
        DB::table('profiles')->insert([
            'user_id' => '3',
            'avatar' => 'anna.jpeg',
            'about' => 'Ненавижу девочек, которые рисуют круги вокруг свечей, устраивают танцы с бубнами и думают, что сатана - это сама милота, с которой не справедливо обошлись. А котов люблю.',
            'city' => 'Красноярск',

            'phone' => '+79130336006',
            'phone_checked' => 'checked',

            'facebook' => NULL,
            'facebook_checked' => NULL,

            'ok' => NULL,
            'ok_checked' => NULL,

            'telegram' => NULL,
            'telegram_checked' => NULL,

            'twitter' => NULL,
            'twitter_checked' => NULL,

            'instagram' => NULL,
            'instagram_checked' => NULL,

            'viber' => NULL,
            'viber_checked' => NULL,

            'vk' => NULL,
            'vk_checked' => NULL,

            'whatsapp' => '+79130336006',
            'whatsapp_checked' => 'checked',

            'youtube' => NULL,
            'youtube_checked' => NULL,

            'bookmarks' => 'a:1:{i:0;s:1:"0";}',
            'likes' => '0',
            'going' => '0',
        ]);
        DB::table('profiles')->insert([
            'user_id' => '4',
            'avatar' => 'max.jpeg',
            'about' => 'Однажды я попробовал дурман и долго сидел в тёмном корридоре, пока Серёга смотрел ведьмака.',
            'city' => 'Красноярск',

            'phone' => '+79639550149',
            'phone_checked' => 'checked',

            'facebook' => NULL,
            'facebook_checked' => NULL,

            'ok' => NULL,
            'ok_checked' => NULL,

            'telegram' => 'spacehere24',
            'telegram_checked' => 'checked',

            'twitter' => NULL,
            'twitter_checked' => NULL,

            'instagram' => 'spacehere24',
            'instagram_checked' => 'checked',

            'viber' => NULL,
            'viber_checked' => NULL,

            'vk' => 'spacemax24',
            'vk_checked' => 'checked',

            'whatsapp' => '+79639550149',
            'whatsapp_checked' => 'checked',

            'youtube' => NULL,
            'youtube_checked' => NULL,

            'bookmarks' => 'a:1:{i:0;s:1:"0";}',
            'likes' => '0',
            'going' => '0',
        ]);
    }
}
