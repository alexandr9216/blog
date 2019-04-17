<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');

            //заголовок записи
            $table->string('title');

            //Слаг для url. unique() - только уникальные
            $table->string('slug')->unique();

            //Короткое описание. nullable() - Разрешает вставлять значения NULL в столбец
            $table->text('description_short')->nullable();

            //Полное описание. nullable() - Разрешает вставлять значения NULL в столбец
            $table->text('description')->nullable();

            //Изображение
            $table->string('image')->nullable();
            //Показывать ли изображение
            $table->boolean('image_show')->nullable();

            //meta данные
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();

            //Кол-во просмотров
            $table->integer('viewed')->nullable();

            //статус опубликована запись или нет
            $table->tinyInteger('published')->nullable();

            //кто создал запись
            $table->integer('created_by')->nullable();

            //кто модифицировал запись
            $table->integer('modified_by')->nullable();

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
        Schema::dropIfExists('articles');
    }
}
