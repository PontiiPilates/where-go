<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->comment('идентификатор пользователя')->nullable();

            $table->text('avatar')->comment('имя файла фотографии пользователя')->nullable();
            
            $table->text('about')->comment('информация о себе')->nullable();

            $table->text('city')->comment('город пребывания пользователя')->nullable();

            $table->text('phone')->comment('номер телефона')->nullable();
            $table->text('phone_checked')->comment('номер телефона')->nullable();

            $table->text('facebook')->comment('ссылка на facebook')->nullable();
            $table->text('facebook_checked')->comment('отметка о выборе')->nullable();
            
            $table->text('ok')->comment('ссылка на odnoklassniki')->nullable();
            $table->text('ok_checked')->comment('отметка о выборе')->nullable();

            $table->text('telegram')->comment('ссылка на telegram')->nullable();
            $table->text('telegram_checked')->comment('отметка о выборе')->nullable();

            $table->text('twitter')->comment('ссылка на youtube')->nullable();
            $table->text('twitter_checked')->comment('отметка о выборе')->nullable();

            $table->text('instagram')->comment('ссылка на instagram')->nullable();
            $table->text('instagram_checked')->comment('отметка о выборе')->nullable();

            $table->text('viber')->comment('ссылка на viber')->nullable();
            $table->text('viber_checked')->comment('отметка о выборе')->nullable();
            
            $table->text('vk')->comment('ссылка на vkontakte')->nullable();
            $table->text('vk_checked')->comment('отметка о выборе')->nullable();
            
            $table->text('whatsapp')->comment('ссылка на whatsapp')->nullable();
            $table->text('whatsapp_checked')->comment('отметка о выборе')->nullable();

            $table->text('youtube')->comment('ссылка на youtube')->nullable();
            $table->text('youtube_checked')->comment('отметка о выборе')->nullable();           

            $table->text('bookmarks')->comment('содержит идентификаторы избранных событий')->nullable();

            $table->text('favourites')->comment('содержит идентификаторы любимых пользователей')->nullable();
            $table->text('follovers')->comment('содержит идентификаторы подписчиков')->nullable();

            $table->text('likes')->comment('содержит идентификаторы понравившихся событий')->nullable();

            $table->text('going')->comment('содержит идентификаторы событий, на которые произошла регистрация')->nullable();

            // $table->text('witness')->comment('позволяет избранным пользователям быть распространителями событий')->nullable();
            $table->integer('witness')->comment('позволяет избранным пользователям быть распространителями событий')->default(0);


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
        Schema::dropIfExists('users_data');
    }
}
