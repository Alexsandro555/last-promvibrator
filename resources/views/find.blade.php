@extends('layouts.master')

@section('title', "ПРОМВИБРАТОР.РУ. Площадочные вибраторы, глубинные вибраторы и пневматические вибраторы - результаты поиска")

@section('sidebar')
  @include('sidebar_menu',['elements' => $productCategories])
  @include('sidebar',['articles' => $articles])
@stop

@section('content')
  <div id="content">
    @if($products->isNotEmpty())
      <h1>Результаты поиска</h1>
      @include('products',['products' => $products])
    @else
      <h1>По вашему запросу ничего не найдено</h1>
    @endif
  </div>
@endsection