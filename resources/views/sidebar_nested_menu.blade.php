@foreach($productCategory->typeProducts as $typeProduct)
  <div class="content-left-menu">
    <a href="/{{$typeProduct->url_key}}" class="partition">{{$typeProduct->title}}</a>
    @foreach($typeProduct->lineProducts as $lineProduct)
      <a href="/{{$lineProduct->url_key}}">
        {{$lineProduct->title}}
        <img src="{{asset('css/images/hover-menu.png')}}" alt="arrow"/>
      </a>
    @endforeach
  </div>
@endforeach