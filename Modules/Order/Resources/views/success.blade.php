@extends('layouts.root')

@section('content')
  <div class="container">
    <h1>Оформление заказа</h1><br>
    <strong>Вы успешно оформили заказ</strong><br><br>
    <span class="number_order">№ Вашего заказа - <strong>{{$number}}</strong></span><br><br>
    <strong>Важная информация!</strong><br><br>
    В течение нескольких часов наш оператор свяжется с Вами для личного подтверждения заказа.<br><br>
    В случае уточнения параметров заказа Вы можете использовать № присовенный заказу - {{$number}}<br><br>
    <strong>Благодарим Вас, за то что выбрали нашу компанию!</strong><br><br>
  </div>
@endsection