@extends('layouts.master')

@section('title', $article->title)

@section('sidebar')
  @include('sidebar_menu',['elements' => $productCategories])
  @include('sidebar',['articles' => $articles])
@stop

@section('content')
  <div id="content">
    {!! $article->content !!}
  </div>
@endsection