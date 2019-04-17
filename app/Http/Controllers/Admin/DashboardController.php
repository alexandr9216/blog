<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //Dashboard
    public function dashboard(){
        return view('admin.dashboard', [
            'categories' => Category::LastCategories(5),
            'articles' => Article::LastArticles(5),
            'count_categories' => Category::count(),
            'count_articles' => Article::count(),
        ]);
    }

}
