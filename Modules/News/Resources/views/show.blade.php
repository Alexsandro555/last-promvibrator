@extends('layouts.master')

@section('title', $news->title)

@section('menu')
  <div class="menu-wrapper wrapper">
    <div class="abs-position">
      <left-menu></left-menu>
    </div>
  </div>
@endsection

@section('content')
  <div class="articles">
    <div class="wrapper top20">
      <v-layout row wrap>
        <v-flex xs12 class="text-xs-left">
          <p class="about__head text-md-left">
            <span>{{$news->title}}</span>
          </p>
          <div class="article__content">
            {!! $news->content !!}
          </div>
        </v-flex>
      </v-layout>
    </div>
  </div>
@endsection

