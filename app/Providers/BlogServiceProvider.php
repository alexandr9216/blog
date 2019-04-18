<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->topMenu();
    }

    //Top Menu
    public function topMenu()
    {
        View::composer('layouts.header',//1) composer - при каждом отображение шаблона "layouts.header",
            function ($view){
                $view->with(
                    'categories',//2) в него будет передавться преременная (в данном случае "categories")
                    \App\Category::where('parent_id', 0)->where('published', 1)->get()//3) c указаннами данными
                );
            }
        );
    }

}
