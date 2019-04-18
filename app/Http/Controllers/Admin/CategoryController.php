<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Отображение списка записей
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view(
            'admin.categories.index',
                [ 'categories' => Category::paginate(10) ]//10 записей на страницу
        );

    }

    /**
     * Открытие формы для создания записи
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       return view(
            'admin.categories.create',
            [
                'category' => [],
                //[получим через модель "Category"] :: [и его метод связи "children"] -> [Получаем корневые категории у которых parent_id = 0 "where('parent_id')"]
                'categories' => Category::with('children')->where('parent_id', '0')->get(),
                'delimiter' => ''
            ]
        );

        //1) Получаем корневые элементы у которых parent_id = 0
        //$categories = Category::with('children')->where('parent_id', '0')->get();
        //dump($categories);
        //2)
        //$child = $categories[0]->children;//к примеру в элементе $categories[0] есть данные с id = 1,
        //dump($child);//значит с помощью свойства "->children" получим все элементы у которых parent_id = 1 (свойство "->children"  основан на методе children(), котоорый находиться в моделе "Category", котрый реализует связь "Один ко многим")
    }

    /**
     * Создание записи в БД
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Category::create($request->all());

        return redirect()->route('admin.category.index');
    }

    /**
     * Отображение записи
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Открытие формы для обновления записи
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view(
            'admin.categories.edit',
            [
                'category' => $category,
                //[получим через модель "Category"] :: [и его метод связи "children"] -> [Получаем корневые категории у которых parent_id = 0 "where('parent_id')"]
                'categories' => Category::with('children')->where('parent_id', '0')->get(),
                'delimiter' => ''
            ]
        );

    }

    /**
     * Обновление записи в БД
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $category->update( $request->except('slug') );

        return redirect()->route('admin.category.index');

    }

    /**
     * Удаление записи из БД
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();

        //Когда удаляешь родительскую категорию, у которой внутри есть еще дочерние,
        //у этих оставшихся дочерних категорий остаются несуществуюшие [parent_id] (которые теперь ссылаются на удаленного родителя).
        //Теперь им нужен опекун)). В данном случае при удаление им необходимо обновить "parent_id" на 0.
        $category->where('parent_id', $category->id)->update(['parent_id' => 0]);

        return redirect()->route('admin.category.index');
    }
}
