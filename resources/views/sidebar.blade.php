<div class="content-left-articles">
  <div class="content-left-articles-title">Статьи</div>
  @foreach($articles as $article)
    <div class="content-left-articles-block">
      @foreach($article->files as $fileItem)
        @foreach($fileItem->config as $files)
          @foreach($files as $key=>$file)
            @if($key === "small")
              <img src="{{asset('/storage/'.$file["filename"])}}" alt="img"><br>
              @break
            @endif
          @endforeach
          @break;
        @endforeach
      @endforeach
      <a class="content-left-articles-link-a" href="/{{$article->url_key}}.html">{{str_replace('ПРОМВИБРАТОР.РУ. ','',$article->title)}}</a>
      <div class="content-left-articles-block-time">{{Carbon\Carbon::parse($article->updated_at)->format('d.m.Y')}}</div>
    </div>
  @endforeach
  <!--<a class="content-left-articles-link" href="">Все статьи</a>-->
</div>