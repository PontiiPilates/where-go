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
            'name' => 'zloileshii',
            'email' => 'zloileshii@gmail.com',
            'password' => '$2y$10$GrolbZQd1R532/wh5XGitOZb5Ov8GVRIR440/mv2/THldJwI.WqGy',
        ]);
        DB::table('users')->insert([
            'name' => 'igor',
            'email' => 'igor@gmail.com',
            'password' => '$2y$10$GrolbZQd1R532/wh5XGitOZb5Ov8GVRIR440/mv2/THldJwI.WqGy',
        ]);
        DB::table('users')->insert([
            'name' => 'anna',
            'email' => 'anna@gmail.com',
            'password' => '$2y$10$GrolbZQd1R532/wh5XGitOZb5Ov8GVRIR440/mv2/THldJwI.WqGy',
        ]);
        DB::table('users')->insert([
            'name' => 'max',
            'email' => 'max@gmail.com',
            'password' => '$2y$10$GrolbZQd1R532/wh5XGitOZb5Ov8GVRIR440/mv2/THldJwI.WqGy',
        ]);
    }
}
