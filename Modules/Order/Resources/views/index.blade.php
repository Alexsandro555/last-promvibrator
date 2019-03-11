@extends('layouts.master')

@section('menu')
  <div class="menu-wrapper wrapper">
    <div class="abs-position">
      <left-menu :prop-toggle="false"></left-menu>
    </div>
  </div>
@endsection

@section('content')
  <v-container>
    <v-layout wrap row>
      <v-flex offset-xs2 xs8>
        <!--<div class="container order">-->
        <div>
          <div class="order-form">
            @if($errors->has('emptyCart'))
              <span class="form-error">{!! $errors->first('emptyCart') !!}</span>
            @endif

            {!! Form::open(['url' => 'order', 'method' => 'post']) !!}
            <p>
              {!! Form::text('surname', null, ['class' => 'form-input-text', 'placeholder' => 'Фамилия']) !!}
              @if($errors->has('surname'))
                <span class="form-error">{!! $errors->first('surname') !!}</span>
              @endif
            </p>
            <p>
              {!! Form::text('firstname', null, ['class' => 'form-input-text', 'placeholder' => '*Имя']) !!}
              @if($errors->has('firstname'))
                <span class="form-error">{!! $errors->first('firstname') !!}</span>
              @endif
            </p>
            <p>
              {!! Form::text('patronymiс', null, ['class' => 'form-input-text', 'placeholder' => 'Отчество']) !!}
              @if($errors->has('patronymiс'))
                <span class="form-error">{!! $errors->first('patronymiс') !!}</span>
              @endif
            </p>
            <p>
              {!! Form::text('company_name', null, ['class' => 'form-input-text', 'placeholder' => '*Название компании']) !!}
              @if($errors->has('company_name'))
                <span class="form-error">{!! $errors->first('company_name') !!}</span>
              @endif
            </p>
            <p>
              {!! Form::text('telephone', null, ['class' => 'form-input-text', 'placeholder' => '*Телефон']) !!}
              @if($errors->has('telephone'))
                <span class="form-error">{!! $errors->first('telephone') !!}</span>
              @endif
            </p>
            <p>
              {!! Form::email('email', null, ['class' => 'form-input-text', 'placeholder' => '*Email']) !!}
              @if($errors->has('email'))
                <span class="form-error">{!! $errors->first('email') !!}</span>
              @endif
            </p>
            <p>
              {!! Form::textarea('note', null, ['class' => 'form-input-textarea', 'placeholder' => 'Комментарий к заказу']) !!}
              @if($errors->has('note'))
                <span class="form-error">{!! $errors->first('note') !!}</span>
              @endif
            </p>
            <br>
            <p class="order-required order-center">
              *Поля обязательные для заполнениия
            </p>
            <p class="order-center">
              <button type="submit" class="sbmt-order">Оформить заказ</button>
            </p>
            {{ Form::close() }}
          </div>
          <div>
            <cart/>
          </div>
        </div>

        <!--</div>-->
      </v-flex>
    </v-layout>
  </v-container>
@stop
