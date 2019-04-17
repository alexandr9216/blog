<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    //разрешенные поля для записи
    protected $fillable = ['title', 'slug', 'parent_id', 'published', 'created_by', 'modified_by'];


    //Мутатор
    public function setSlugAttribute($value){

        $this->attributes['slug'] = Str::slug(
            //в качестве слага будет заголовок записи ограниченный до 40 символов и текущая дата, а пробелы будут заменены на '-'
            mb_substr($this->title,  0, 40) .'-'. \Carbon\Carbon::now()->format('dmyHi'), '-'
        );

    }

    //Получение дочерних категорий
    public function children() {
        //связываем таблицу текущей модели по кололнке parent_id с колонкой id этой же таблицы
        //связь один к многоим, так как внутри одной категории могут быть вложены не сколько категорий
        return $this->hasMany(self::class, 'parent_id');
    }


    //Обратная связь категорий с новостями "Многие ко многоим" (Полиморфная)
    public function articles() {
        return $this->morphedByMany('App\Article', 'categoryable');
    }


    //Заготовка: возвращаем определенное (в $count) кол-во последних категорий
    public function scopeLastCategories($query, $count) {
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }

}
