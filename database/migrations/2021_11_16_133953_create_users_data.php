<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_data', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('идентификатор пользователя')->nullable();

            $table->text('about')->comment('информация о себе')->nullable();

            $table->text('city')->comment('город пребывания пользователя')->nullable();

            $table->text('phone')->comment('номер телефона')->nullable();

            $table->text('wp')->comment('ссылка на whatsapp')->nullable();
            $table->text('wb')->comment('ссылка на viber')->nullable();
            $table->text('tg')->comment('ссылка на telegram')->nullable();

            $table->text('ig')->comment('ссылка на instagram')->nullable();
            $table->text('fb')->comment('ссылка на facebook')->nullable();
            $table->text('vk')->comment('ссылка на vkontakte')->nullable();
            $table->text('ok')->comment('ссылка на odnoklassniki')->nullable();
            $table->text('yt')->comment('ссылка на youtube')->nullable();

            $table->text('bookmarks')->comment('содержит идентификаторы избранных событий')->nullable();

            $table->text('likes')->comment('содержит идентификаторы понравившихся событий')->nullable();

            $table->text('goes')->comment('содержит идентификаторы событий, на которые произошла регистрация')->nullable();

            // Создает created_at и updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_data');
    }
}
