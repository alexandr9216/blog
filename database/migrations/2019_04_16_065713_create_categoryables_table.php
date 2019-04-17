<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoryables', function (Blueprint $table) {

            //id категорий из таблицы [categories] (для связи)
            $table->integer('category_id');

            //id категорий из других таблиц (например новости, товары и т.д.),
            //которые свзанных таблицей [categories] (для связи)
            $table->integer('categoryable_id');

            //здесь указыается связанная модель (новости, товары и т.д.)
            $table->string('categoryable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoryables');
    }
}
