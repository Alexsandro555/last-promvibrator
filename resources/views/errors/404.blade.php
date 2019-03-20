@extends('layouts.master')

@section('title', 'Страница не найдена')

@section('sidebar')
    @include('sidebar_menu',['elements' => $productCategories])
    @include('sidebar',['articles' => $articles])
@stop

@section('content')
    <div id="content">
        <section class="section">
            <div class="container catalog">
                <div class="product-catalog">
                    <h1>Страница не найдена</h1>
                    К сожалению, такой страницы не существует.
                </div>
            </div>
        </section>
    </div>
@endsection