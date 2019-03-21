@extends('layouts.master')

@section('title', 'ПРОМВИБРАТОР.РУ.'.$productCategory->title.' cписок.')

@section('sidebar')
  @include('sidebar_nested_menu',['productCategory' => $productCategory])
  @include('sidebar',['articles' => $articles])
@stop

@section('content')
  <div>
    <div id="content">
      <div class="content-right-navtral">
        @foreach($breadcrumbs as $key => $breadcrumb)
          @if(!$loop->last)
            <a href="{{$breadcrumb->slug}}">{{$breadcrumb->title}}</a>
            <img src="{{asset('/css/images/arrow-right.png')}}" class="img-arrow"/>
          @else
            {{$breadcrumb->title}}
          @endif
        @endforeach
      </div>
      <br>
      @include('products',['products' => $products])
    </div>
  </div>
@stop