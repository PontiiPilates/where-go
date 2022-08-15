<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// подключение модели
use App\Models\Event;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function () {

            /**
             * * Фейковые просмотры
             */

            // установка временной зоны
            date_default_timezone_set('Asia/Krasnoyarsk');

            // диапазон значений
            $min = 1;
            $max = 3;

            // коэфициент активности
            $k = 1;

            // получение доступных к просмотру событий
            $events = Event::where('status', 1)
                ->where('date_start', '>=', date('Y-m-d'))
                ->orderBy('date_start')
                ->get();

            // echo 'Контроль различия времени, прошедшего с момента публикации по настоящее время:';
            // echo '<br>';

            // назначение просмотров событиям
            foreach ($events as $v) {

                // дата публикации
                $date_create = strtotime($v->created_at);
                // текущая дата
                $date_current = time();
                // количество полных дней, прошедших с момента публикации
                $days_last = ($date_current - $date_create) / 86400;
                // получение нужного значения
                $days_last = substr($days_last, 0, 1);

                // настройка коэфициента в зависимости от количества прошедших дней
                if ($days_last == 0) {
                    $kd = 5;
                }
                if ($days_last == 1) {
                    $kd = 3;
                }
                if ($days_last == 2 || $days_last == 3) {
                    $kd = 2;
                }
                if ($days_last >= 4) {
                    $kd = 1;
                }

                // изменение коефициента в зависимости от времени
                $time_active = array(10, 11, 12, 18, 19, 20);
                $time_normal = array(6, 7, 8, 9, 13, 14, 15, 16, 17, 21, 22);
                $time_empty = array(23, 0, 1, 2, 3, 4, 5);

                // настройка коэфициента в зависимости от типа времени
                if (in_array(date('H'), $time_active)) {
                    $kt = 0;
                    $k = $kd - $kt;
                }
                if (in_array(date('H'), $time_normal)) {
                    $kt = 1;
                    $k = $kd - $kt;
                }
                if (in_array(date('H'), $time_empty)) {
                    $kt = 3;
                    $k = $kd - $kt;
                }

                // предохранитель коефициента от нулевого значения
                if ($k == 0) {
                    $k = 1;
                }

                // изменение коефициента в зависимости от дня недели
                // $day_active = array();
                // $day_normal = array();
                // $day_empty = array();

                // добавление просмотров
                $fake = $v->counter_fake;
                $fake = $fake + rand($min * $k, $max * $k);
                $v->counter_fake = $fake;
                $v->save();

                // визуализация данных для отладки
                // print $v->id . ': ' . $days_last . ': ' . rand($min * $k, $max * $k);
                // echo '<br>';
            }

        // })->everyMinute();
        })->hourlyAt(53);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
