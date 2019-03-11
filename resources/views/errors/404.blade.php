@extends('layouts.master')

@section('title', 'статьи')

@section('menu')
    <div class="menu-wrapper wrapper">
        <div class="abs-position">
            <left-menu></left-menu>
        </div>
    </div>
@endsection

@section('content')
    <section class="section">
        <div class="container catalog">
            <!--<left-menu></left-menu>-->
            <div class="product-catalog">
                <h1>Страница не найдена</h1>
                К сожалению, такой страницы не существует.
            </div>
        </div>
    </section>
@endsection