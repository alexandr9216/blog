@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Список новостей @endslot
            @slot('parent') Главная @endslot
            @slot('active') Новости @endslot
        @endcomponent


        <hr>

        <a href="{{route('admin.article.create')}}" class="btn btn-primary pull-right">
            <i class="fa fa-plus-square-o"></i> Создать новость</a>

        <table class="table table-striped">
            <thead>
                <th>Наименование</th>
                <th>Публикация</th>
                <th class="text-right">Действие</th>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr>
                        <td>{{$article->title}}</td>
                        <td>{{$article->published}}</td>
                        <td>
                            <form action="{{route('admin.article.destroy', $article)}}" onsubmit="if(confirm('Удалить?')){return true}else{return false}" method="POST" style="display:inline-block;">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{csrf_field()}}
                                <button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
                            </form>
                            <a href="{{route('admin.article.edit', $article)}}"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center"><h2>Данные отсутствуют!</h2></td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul  class="pagination pull-right">
                        {{$articles->links()}}
                    </ul>
                </td>
            </tr>
            </tfoot>

        </table>

    </div>

@endsection