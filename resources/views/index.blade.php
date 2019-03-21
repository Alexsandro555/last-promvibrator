@extends('layouts.master')

@section('title', "ПРОМВИБРАТОР.РУ. Площадочные вибраторы, глубинные вибраторы и пневматические вибраторы")

@section('sidebar')
  @include('sidebar_menu',['elements' => $productCategories])
  @include('sidebar',['articles' => $articles])
@stop

@section('content')
  <div id="content">
    @include('products',['products' => $products])
  </div>
@endsection