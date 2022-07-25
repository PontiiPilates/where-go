<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Подключение DB
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Михаил Фото',
            'email' => 'mf@gmail.com',
            'password' => '$2y$10$GrolbZQd1R532/wh5XGitOZb5Ov8GVRIR440/mv2/THldJwI.WqGy',
        ]);
        DB::table('users')->insert([
            'name' => 'Siberianne',
            'email' => 'lizerenoiteze@gmail.com',
            'password' => '$2y$10$GrolbZQd1R532/wh5XGitOZb5Ov8GVRIR440/mv2/THldJwI.WqGy',
        ]);
    }
}
