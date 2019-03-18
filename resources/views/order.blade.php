@extends('layouts.master')

@section('title', 'ПРОМВИБРАТОР.РУ. Формирование заказа')

@section('sidebar')
  @include('sidebar_menu',['elements' => $productCategories])
  @include('sidebar',['articles' => $articles])
@stop

@section('content')
  <div id="content">
    <form action="/order.php" method="post" enctype="multipart/form-data" name="zakaz_tovara">
      <cart-order>
        <template slot-scope="slotProps">
          <h1>Корзина</h1>
          <div class="content-right-order">
          <table width="100%">
            <thead>
            <tr>
              <th></th>
              <th>Наименование товара</th>
              <th>Количество</th>
              <th>Стоимость</th>
            </tr>
            </thead>
            <tbody cellpadding="0" cellspacing="0">
            <tr v-for="cartItem in slotProps.cart" :key="cartItem.rowId">
              <td><img :src="cartItem.options.filename" height="40"></td>
              <td><span>@{{cartItem.options.type}}</span><br>@{{cartItem.name}}</td>
              <td>@{{cartItem.qty}}</td>
              <td>@{{cartItem.price}}</td>
            </tr>
            </tbody>
            <tfoot>
            <tr valign="middle">
              <td colspan="1"></td>
              <td colspan="2" align="right">Общая стоимость c НДС 20%: </td>
              <td align="center">@{{slotProps.total}} ₽</td>
            </tr>
            </tfoot>
          </table>
        </div>
        </template>
      </cart-order>
      <h1>Информация</h1>
      <div class="content-right-order">
        @if($errors->has('emptyCart'))
          <span class="form-error">{!! $errors->first('emptyCart') !!}</span>
        @endif
        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
        <table cellpadding=0 cellspacing=0 width=100%>
          <tbody valing=top>
          <tr valign=top>
            <td>
              <strong>
                Как Вас зовут? (Ф.И.О.)
                <span class='red'>*</span>:
              </strong><br />
              <input type='text' name='fio' value='{{old('fio')}}' class='input' size=30>
              @if($errors->has('fio'))
                <br><span class="form-error">{!! $errors->first('fio') !!}</span>
              @endif
            </td>
            <td rowspan=3>
              <strong>
                Примечание или реквизиты для выставления счета
              </strong><br />
              <textarea name='description' value="{{old('description')}}" rows=4 style='width:100%;height:100px'></textarea>
            </td>
          </tr>
          <tr>
            <td>
              <strong>
                Название Вашей компании
                <span class='red'>*</span>:
              </strong><br />
              <input type='text' name='company' value='{{old('company')}}' class='input' size=30>
              @if($errors->has('company'))
                <br><span class="form-error">{!! $errors->first('company') !!}</span>
              @endif
            </td>
          </tr>
          <tr>
            <td>
              <strong>
                Ваш телефон
                <span class='red'>*</span>:
              </strong><br />
              <input type='text' name='tel' value='{{old('tel')}}' class='input' size=30>
              @if($errors->has('tel'))
                <br><span class="form-error">{!! $errors->first('tel') !!}</span>
              @endif
            </td>
          </tr>
          <tr>
            <td>
              <strong>
                E-mail:
              </strong><br />
              <input type='text' name='email' value='{{old('email')}}' class='input' size=30>
              @if($errors->has('email'))
                <br><span class="form-error">{!! $errors->first('email') !!}</span>
              @endif
            </td>
            <!--<td>
              <strong>
                Файл для реквизитов:
              </strong><br />
              <input type='file' name='file' >
            </td>-->
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

