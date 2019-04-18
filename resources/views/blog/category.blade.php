@extends('layouts.app')

{{-- @section('title', '1-спосооб. Теперь это значение переменной $title (в шаблоне layouts.app - @yield('title'))') --}}

@section('title')
    {{-- 2-спосооб (значение переменной $title) в шаблоне layouts.app - @yield('title') --}}
    {{$category->title}}
@endsection


@section('content')
    <div class="container">

        @forelse($articles as $article)
            <div class="row">
                <div class="col-sm-12">
                    <h2>
                        <a href="{{route('article', $article->slug)}}">
                            {{$article->title}}
                        </a>
                    </h2>

                    <p>{!! $article->description_short !!}</p>
                </div>
            </div>
        @empty
            <h2 class="text-center">Записи отсутствуют</h2>
        @endforelse

        {{ $articles->links() }}
    </div>
@endsection