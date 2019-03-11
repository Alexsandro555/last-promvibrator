<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
//use Modules\Article\Entities\Article;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\TypeProduct;
use Modules\Product\Entities\LineProduct;
use Modules\News\Entities\News;

class SiteController extends Controller
{
  public function index()
  {
    $ourProducts = Product::with('files', 'typeProduct', 'lineProduct')->inRandomOrder()->take(4)->get();
    $specialProducts = Product::with('files', 'typeProduct', 'lineProduct')->where('special', 1)->inRandomOrder()->take(5)->get();
    $news = [];
    $news = News::inRandomOrder()->take(4)->get();
    return view('index', compact('ourProducts', 'specialProducts', 'news'));
  }

  public function catalog($slug)
  {
    $products = Product::with('typeProduct')->with('files')->whereHas('typeProduct', function ($query) use ($slug) {
      $query->where('url_key', $slug);
    })->whereNull('line_product_id')->get();
    $typeProduct = TypeProduct::where('url_key', $slug)->first();
    $id = $typeProduct->id;
    return view('catalog', compact('products', 'typeProduct', 'id'));
  }

  public function lineProduct($slugTypeProduct, $slugLineProduct) {
    $lineProduct = LineProduct::with('products.files','type_product')->where('url_key', $slugLineProduct)->first();
    return view('lineProduct', compact('lineProduct'));
  }

  public function menuLeft() {
    return ProductCategory::with(['typeProducts' => function($query) {
      $query->orderBy('sort');
    }, 'typeProducts.lineProducts'])->get();
  }

  public function detail($slug) {
    $product = Product::with('files')->where('url_key',$slug)->first();
    return view('detail', compact('product'));
  }
}
