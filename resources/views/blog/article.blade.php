@extends('layouts.app')

{{-- @section('title', '1-спосооб. Теперь это значение переменной $title (в шаблоне layouts.app - @yield('title'))') --}}


@section('title', $article->meta_title)
@section('meta_keyword', $article->meta_keyword)
@section('meta_description', $article->meta_description)

@section('title')
    {{-- 2-спосооб (значение переменной $title) в шаблоне layouts.app - @yield('title') --}}
    {{$article->title}}
@endsection


@section('content')
    <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{$article->title}}</h1>

                    <p>{!! $article->description !!}</p>
                </div>
            </div>
    </div>
@endsection