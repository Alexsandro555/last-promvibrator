@extends('layouts.master')

@section('title', $page->title)

@section('sidebar')
  @include('sidebar_menu',['elements' => $productCategories])
  @include('sidebar',['articles' => $articles])
@stop

@section('content')
  <div id="content">
    {!! $page->content !!}
  </div>
@endsection