<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Article\Models\Article;

class ArticleController extends Controller
{
  public function list() {
    $articles = Article::with('files')->get();
    return view('article::index', compact('articles'));
  }

  public function show($slug) {
    $article = Article::where('url_key', $slug)->firstOrFail();
    return view('article::show', compact('article'));
  }
}
