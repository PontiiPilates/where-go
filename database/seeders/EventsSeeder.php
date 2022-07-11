<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Подключение DB
use Illuminate\Support\Facades\DB;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'user_id' => '1',
            'title' => 'Поход на столбы',
            'description' => 'Будем пить чай.',
            'city' => 'Красноярск',
            'adress' => 'Ост. Турбаза',
            'date_start' => '2022-06-24',
            'preview' => 'stolby.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'goes' => "a:0:{}",
        ]);

        DB::table('events')->insert([
            'user_id' => '2',
            'title' => 'Спуск в пещеру',
            'description' => 'Пещера Караульная, погода будет солнечная.',
            'city' => 'Красноярск',
            'adress' => 'Ост. Пос. Удачный',
            'date_start' => '2022-06-25',
            'preview' => 'peschera.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'goes' => "a:0:{}",

        ]);

        DB::table('events')->insert([
            'user_id' => '2',
            'title' => 'Прогулка по Торгашинскому хребту',
            'description' => 'Ожидается метель, берите с собой удобные тапочки',
            'city' => 'Красноярск',
            'adress' => 'пер. Медицинский',
            'date_start' => '2022-06-26',
            'preview' => 'torgashinskii.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'goes' => "a:0:{}",

        ]);

        DB::table('events')->insert([
            'user_id' => '3',
            'title' => 'Урок плаванья в Бассейне',
            'description' => 'Бесплатно научу плавать за час',
            'city' => 'Красноярск',
            'adress' => 'ул. А. Киренского, 26',
            'date_start' => '2022-06-27',
            'preview' => 'bassein.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'goes' => "a:0:{}",

        ]);

        DB::table('events')->insert([
            'user_id' => '3',
            'title' => 'Мастер-класс по акварели',
            'description' => 'Проведу мастер-класс по рисованию акварелью. Научимся рисовать по мокрому.',
            'city' => 'Красноярск',
            'adress' => 'ул. Академгородок, 21, Детский центр: "Мондельброт"',
            'date_start' => '2022-06-28',
            'preview' => 'akvarel.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'goes' => "a:0:{}",

        ]);

        DB::table('events')->insert([
            'user_id' => '3',
            'title' => 'Расскажу как быть трансгендером',
            'description' => 'Берите с собой хачей, расскажу заодно и им (подпись: очень уверенный в себе человека)',
            'city' => 'Сахалин',
            'adress' => 'ул. Ардженикидзе 2ъ',
            'date_start' => '2022-06-29',
            'preview' => 'trans.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'goes' => "a:0:{}",

        ]);

        DB::table('events')->insert([
            'user_id' => '4',
            'title' => 'Инопланетные игрища',
            'description' => 'Обязательно при себе иметь вазилин и мирасмистин',
            'city' => 'МКС',
            'adress' => 'Шлюз № 3',
            'date_start' => '2022-06-30',
            'preview' => 'kosmos.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
            'goes' => "a:0:{}",

        ]);

        DB::table('events')->insert([
            'user_id' => '4',
            'title' => 'Противостояние с Гузеевой',
            'description' => 'Этот пидор не желае выйти замуж, но общественное мнение настроено иначе. Кто же прав кто виноват, рассудит царь',
            'city' => 'Магнитогорск',
            'adress' => 'Трц Шлюховице',
            'date_start' => '2022-07-01',
            'preview' => 'guzeeva.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'goes' => "a:0:{}",

        ]);

        DB::table('events')->insert([
            'user_id' => '4',
            'title' => 'Поход с котом',
            'description' => 'Кот - гид проведет вас вдоль заборов садов, вдоль саженцев валерьянки, хорошо проведем время, помурлыкаем на солнышке, поедим китикет, покакаем в вырытую ямку',
            'city' => 'Мяу',
            'adress' => 'Мяу',
            'date_start' => '2022-07-02',
            'preview' => 'cat.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'goes' => "a:0:{}",

        ]);

        DB::table('events')->insert([
            'user_id' => '4',
            'title' => 'Покупка БМВ',
            'description' => 'Покупка новой БМВ с салона. Просто, чтобы ездить с удовольствием.',
            'city' => 'Питербург',
            'adress' => 'ул. Пушкина 21',
            'date_start' => '2022-07-03',
            'preview' => 'bmw.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
            'goes' => "a:0:{}",
        ]);

        DB::table('events')->insert([
            'user_id' => '5',
            'title' => 'КЭФ. Енисейская Сибирь - окно в Азию',
            'description' => 'Енисейская Сибирь с участием Сибирского федерального университета проведут стратегическую сессию.
            Основные темы:
            реализация инвестиционных проектов и привлечение иностранных инвесторов;
            меры государственной поддержки российских компаний в условиях западных санкций;
            импортозамещение и поиск новых рынков сбыта продукции, производимой на территории трёх регионов Енисейской Сибири.
            Все желающие могут следить за дискуссией в онлайн-режиме.',
            'city' => 'Питербург',
            'adress' => 'ул. Пушкина 21',
            'date_start' => '2022-07-03',
            'preview' => 'bmw.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
            'goes' => "a:0:{}",
        ]);
    }
}
