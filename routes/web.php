<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => ['auth']
    ],
    function () {
        Route::get('/', 'DashboardController@dashboard')->name('admin.index');

        //Категории
        Route::resource('/category', 'CategoryController',
            /* Роуты
            admin.category.index
            admin.category.create
            admin.category.destroy
            admin.category.update
            admin.category.show
            admin.category.edit
            */
            ['as' => 'admin']//это будет префикс к стандартным именам роутов ресурсов (к примеру вместо category.index = будет admin.category.index)
        );

        //Новости
        Route::resource('/article', 'ArticleController',
            /* Роуты
            admin.article.index
            admin.article.create
            admin.article.destroy
            admin.article.update
            admin.article.show
            admin.article.edit
            */
            ['as' => 'admin']//это будет префикс к стандартным именам роутов ресурсов (к примеру вместо category.index = будет admin.category.index)
        );

    }
);
