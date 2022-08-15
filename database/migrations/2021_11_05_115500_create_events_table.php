<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id()->comment('идентификатор строки');
            $table->integer('user_id')->comment('идентификатор пользователя, создавшего событие')->nullable();
            $table->text('user_name')->comment('имя пользователя')->nullable();
            $table->text('category')->comment('категория события')->nullable();
            $table->text('title')->comment('название события')->nullable();
            $table->text('description')->comment('описание события')->nullable();
            $table->text('city')->comment('город проведения события')->nullable();
            $table->text('adress')->comment('адрес проведения события')->nullable();
            $table->dateTime('date_start')->comment('дата начала события')->nullable();
            $table->dateTime('date_end')->comment('дата окончания события')->nullable();
            $table->time('time_start')->comment('время начала события')->nullable();
            $table->time('time_end')->comment('время окончания события')->nullable();
            $table->text('preview')->comment('имя превью события')->nullable();
            $table->text('price_type')->comment('форма участия в событии')->nullable();
            $table->text('free')->comment('селектор формы участия')->nullable();
            $table->text('donate')->comment('селектор формы участия')->nullable();
            $table->text('price')->comment('селектор формы участия')->nullable();
            $table->integer('cost')->comment('фактическая стоимость участия в событии')->nullable();
            $table->text('goes')->comment('содержит идентификаторы пользователей, которые зарегистрировались на событие')->nullable();
            $table->integer('witness')->comment('отметка о том, что создатель является свидетелем, а не автором события')->default(0);
            $table->text('source')->comment('ссылка на источник')->nullable();
            $table->integer('status')->comment('статус публикации события')->default(1);
            $table->integer('counter')->comment('счетчик просмотров')->default(1);
            // cоздает created_at и updated_at
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
        Schema::dropIfExists('events');
    }
}
