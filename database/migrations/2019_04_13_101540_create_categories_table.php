<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {

            //id записи с автоинкрементном
            $table->bigIncrements('id');

            //заголовок записи
            $table->string('title');

            //Слаг для url. unique() - только уникальные
            $table->string('slug')->unique();

            //id для категорий. nullable() - Разрешает вставлять значения NULL в столбец
            $table->integer('parent_id')->nullable();

            //статус опубликована запись или нет
            $table->tinyInteger('published')->nullable();

            //кто создал запись
            $table->integer('created_by')->nullable();

            //кто модифицировал запись
            $table->integer('modified_by')->nullable();

            //дата создания и дата обновления записи
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
        Schema::dropIfExists('categories');
    }
}
