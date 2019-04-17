<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.articles.index', [
            'articles' => Article::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create', [
            'article'    => [],
            //[получим через модель "Category"] :: [и его метод связи "children"] -> [Получаем корневые категории у которых parent_id = 0 "where('parent_id')"]
            'categories' => Category::with('children')->where('parent_id', 0)->get(),
            'delimiter'  => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $article = Article::create($request->all());

        //Категории
        if($request->input('categories')) {//(с какмим категориями будем связывать новость)
            //метод attach() втавляет связь в промежуточную таблицу [categoryables] (связывает новость с указанными категориями)
            $article->categories()->attach($request->input('categories'));
        }


        return redirect()->route('admin.article.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
        return view('admin.articles.edit', [
            'article' => $article,
            //[получим через модель "Category"] :: [и его метод связи "children"] -> [Получаем корневые категории у которых parent_id = 0 "where('parent_id')"]
            'categories' => Category::with('children')->where('parent_id', '0')->get(),
            'delimiter' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
        $article->update( $request->except('slug') );

        //метод detach() удаляет связь в промежуточной таблице [categoryables] (отвязывает новость от категорий)
        $article->categories()->detach();

        //метод attach() втавляет связь в промежуточную таблицу [categoryables] (связывает новость с указанными категориями)
        $article->categories()->attach($request->input('categories'));

        return redirect()->route('admin.category.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //

        //метод detach() удаляет связи в промежуточной таблице [categoryables] (отвязывает новость от категорий)
        $article->categories()->detach();

        //удаляем новость
        $article->delete();

        return redirect()->route('admin.category.index');

    }
}
