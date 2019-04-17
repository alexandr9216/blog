@extends('admin.layouts.app_admin')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="jumbotron">
                <p><span class="label label-primary">Категорий {{$count_categories}}</span></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="jumbotron">
                <p><span class="label label-primary">Метириалов {{$count_articles}}</span></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="jumbotron">
                <p><span class="label label-primary">Посетителей 0</span></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="jumbotron">
                <p><span class="label label-primary">Сегодня 0</span></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-block btn-default" href="{{route('admin.category.create')}}">Создать категорию</a>

            @foreach($categories as $category)
                <a class="list-group-item" href="{{route('admin.category.edit', $category)}}">
                    <h4 class="list-group-item-heading">{{$category->title}}</h4>
                    <p class="list-group-item-text">
                        <!-- Получаем кол-во новостей у данной категории -->
                        {{ $category->articles()->count() }}
                    </p>
                </a>
            @endforeach

        </div>

        <div class="col-md-6">
            <a class="btn btn-block btn-default" href="{{route('admin.article.create')}}">Создать материал</a>

            @foreach($articles as $article)
                <a class="list-group-item" href="{{route('admin.article.edit', $article)}}">
                    <h4 class="list-group-item-heading">{{$article->title}}</h4>
                    <p class="list-group-item-text">
                        {{ $article->categories()/*Получаем список категорий, к которым привязана данная новость*/
                            ->pluck('title')/*pluck - возвращаем только title из БД) -->*/
                                ->implode(', ')/*implode через запятую*/
                        }}
                    </p>
                </a>
            @endforeach

        </div>
    </div>

</div>
@endsection
