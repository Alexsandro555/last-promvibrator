@foreach($elements as $element)
  <div class="content-left-menu"><a class="partition" href="/{{$element->url_key}}/">{{$element->title}}</a></div>
@endforeach
<div class="content-left-menu"></div>