@extends('layouts.master')

@section('title', 'ПРОМВИБРАТОР.РУ. Формирование заказа')

@section('sidebar')
  @foreach($productCategories as $productCategory)
    <div class="content-left-menu"><a class="partition" href="/{{$productCategory->url_key}}/">{{$productCategory->title}}</a></div>
  @endforeach
  <div class="content-left-menu"></div>
  @include('sidebar',['articles' => $articles])
@stop

@section('content')
  <div id="content">
    <form action="" method="post" enctype="multipart/form-data" name="zakaz_tovara">
      <h1>Корзина</h1>
      <div class="content-right-order">
        <table width="100%">
          <thead>
          <tr>
            <th></th>
            <th>Наименование товара</th>
            <th>Количество</th>
            <th>Стоимость</th>
            <th>Срок поставки</th>
          </tr>
          </thead>
          <tbody cellpadding="0" cellspacing="0">
          @foreach($cartItems as $cartItem)
            <tr>
              <td><img src="/storage/{{$cartItem->options->filename}}" height="40"></td>
              <td><span>{{$cartItem->options->type}}</span><br>{{$cartItem->name}}</td>
              <td>{{$cartItem->qty}}</td>
              <td>{{$cartItem->price}}</td>
              <td>{{$cartItem->options->onstock}}</td>
            </tr>
          @endforeach
          </tbody>
          <tfoot>
          <tr valign="middle">
            <td colspan="2"></td>
            <td colspan="2" align="right">Общая стоимость c НДС 18%: </td>
            <td align="center">{{$total}} ₽</td>
          </tr>
          </tfoot>
        </table>
      </div>
      <h1>Информация</h1>
      <div class="content-right-order">
        <table cellpadding=0 cellspacing=0 width=100%>
          <tbody valing=top>
          <tr valign=top>
            <td>
              <strong>
                Как Вас зовут? (Ф.И.О.)
                <span class='red'>*</span>:
              </strong><br />
              <input type='text' name='fio' value='' class='input' size=30>
            </td>
            <td rowspan=3>
              <strong>
                Примечание или реквизиты для выставления счета
              </strong><br />
              <textarea name='description' rows=4 style='width:100%;height:100px'></textarea>
            </td>
          </tr>
          <tr>
            <td>
              <strong>
                Название Вашей компании
                <span class='red'>*</span>:
              </strong><br />
              <input type='text' name='company' value='' class='input' size=30>
            </td>
          </tr>
          <tr>
            <td>
              <strong>
                Ваш телефон
                <span class='red'>*</span>:
              </strong><br />
              <input type='text' name='tel' value='' class='input' size=30>
            </td>
          </tr>
          <tr>
            <td>
              <strong>
                E-mail:
              </strong><br />
              <input type='text' name='email' value='' class='input' size=30>
            </td>
            <td>
              <strong>
                Файл для реквизитов:
              </strong><br />
              <input type='file' name='file' >
            </td>
          </tr>
          <tr>
            <td colspan=2 style='text-align:left'>
              <span class='red'>*</span> - поля обязательные для заполнения
            </td>
          </tr>
          <tr>
            <td colspan=2>
              <center><input  class='cart-submit' type='submit' class='input' value='ЗАКАЗАТЬ' /></center>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </form>
  </div>
  <a href=""><img src="{{asset('css/images/banner-sale.png')}}" alt="img" class="img-banner"></a>
@stop

