@foreach($productCategory->typeProducts as $typeProduct)
  <div class="content-left-menu">
    @if($typeProduct->active)
      <a href="/{{$typeProduct->url_key}}" class="partition">{{$typeProduct->title}}</a>
      @foreach($typeProduct->lineProducts as $lineProduct)
        @if($lineProduct->active)
          <a href="/{{$lineProduct->url_key}}">
            {{$lineProduct->title}}
            <img src="{{asset('css/images/hover-menu.png')}}" alt="arrow"/>
          </a>
        @endif
      @endforeach
    @endif
  </div>
@endforeach