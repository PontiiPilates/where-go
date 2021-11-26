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

            $table->integer('cost')->comment('стоимость события')->nullable();
            $table->text('free')->comment('бесплатность события')->nullable();

            $table->integer('status')->comment('статус публикации события')->default(1);

            $table->timestamp('created_at')->comment('дата и время создания записи');
            $table->timestamp('updated_at')->comment('дата и время обновления записи');
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
