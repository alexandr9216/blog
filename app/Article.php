<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    //разрешенные поля для записи
    protected $fillable = ['title', 'slug', 'description_short', 'description', 'image', 'image_show', 'meta_title',
        'meta_description', 'meta_keyword', 'viewed', 'published', 'created_by', 'modified_by'];


    //Мутатор
    public function setSlugAttribute($value){

        $this->attributes['slug'] = Str::slug(
        //в качестве слага будет заголовок записи ограниченный до 40 символов и текущая дата, а пробелы будут заменены на '-'
            mb_substr($this->title,  0, 40) .'-'. \Carbon\Carbon::now()->format('dmyHi'), '-'
        );

    }


    //Связь с категориями "Многие ко многоим" (Полиморфная)
    public function categories() {
        return $this->morphToMany('App\Category', 'categoryable');
    }


    //Заготовка: возвращаем определенное (в $count) кол-во последних новостей
    public function scopeLastArticles($query, $count) {
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }


}
