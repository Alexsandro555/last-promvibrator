<?php

namespace App\Http\Controllers;

use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\TypeProduct;
use Modules\Product\Entities\LineProduct;
use Modules\Article\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Breadcrumb;

class SiteController extends Controller
{
  public function index()
  {
    $productCategories = ProductCategory::all();
    $products = Product::with(['files','attributes','productCategory'])->where('active',1)->where('special',1)->get();
    $articles = Article::all();
    return view('index',compact('products','productCategories', 'articles'));
  }

  public function catalogTypes($slug, Request $request) {
    $articles = Article::all();
    $breadcrumbs = new Collection();

    if($request->has('id')) {
      $slug = str_replace('.php','',$slug);
      $product = Product::with(['files','attributes','productCategory','lineProduct', 'typeProduct'])->whereHas('productCategory',function($query) use ($slug) {
        $query->where('url_key',$slug);
      })->where('old_id',$request->id)->firstOrFail();
      $typeProduct = TypeProduct::with('lineProducts')->find($product->type_product_id);
      $lineProducts = LineProduct::where('type_product_id',$product->type_product_id)->get();
      $breadcrumbs->push(new Breadcrumb("Главная страница", "/"));
      $breadcrumbs->push(new Breadcrumb($product->productCategory->title, $product->productCategory->url_key));
      if($product->type_product_id) $breadcrumbs->push(new Breadcrumb($product->typeProduct->title, $product->typeProduct->url_key));
      if($product->line_product_id) $breadcrumbs->push(new Breadcrumb($product->lineProduct->title, $product->lineProduct->url_key));
      $breadcrumbs->push(new Breadcrumb($product->title, $product->url_key));
      return view('detail', compact('product','lineProducts', 'typeProduct' ,'breadcrumbs', 'articles'));
    }

    $productCategory = ProductCategory::where('url_key', $slug)->first();
    if($productCategory) {
      $products = Product::with(['files','attributes','productCategory'])->whereHas('productCategory',function($query) use ($slug) {
        $query->where('url_key',$slug);
      })->where('active',1)->paginate(10);
      $breadcrumbs->push(new Breadcrumb("Главная страница", "/"));
      $breadcrumbs->push(new Breadcrumb($productCategory->title, $slug));
      return view('catalog', compact('products','productCategory','breadcrumbs', 'articles'));
    }

    $productCategory = ProductCategory::with(['typeProducts'])->whereHas('typeProducts', function($query) use ($slug) {
      $query->where('url_key',$slug);
    })->first();
    if($productCategory) {
      $products = Product::with(['files','attributes','typeProduct'])->whereHas('typeProduct', function($query) use ($slug) {
        $query->where('url_key',$slug);
      })->where('active',1)->paginate(10);
      $breadcrumbs->push(new Breadcrumb("Главная страница", "/"));
      $breadcrumbs->push(new Breadcrumb($productCategory->title, $productCategory->url_key));
      $breadcrumbs->push(new Breadcrumb($productCategory->typeProducts[0]->title, $slug));
      return view('catalog', compact('products','productCategory','breadcrumbs', 'articles'));
    }

    $productCategory = ProductCategory::with(['typeProducts.lineProducts'])->whereHas('typeProducts.lineProducts', function($query) use ($slug) {
      $query->where('url_key',$slug);
    })->first();
    if($productCategory) {
      $products = Product::with(['files','attributes','lineProduct'])->whereHas('lineProduct', function($query) use ($slug) {
        $query->where('url_key',$slug);
      })->where('active',1)->paginate(10);
      $breadcrumbs->push(new Breadcrumb("Главная страница", "/"));
      $breadcrumbs->push(new Breadcrumb($productCategory->title, $productCategory->url_key));
      $breadcrumbs->push(new Breadcrumb($productCategory->typeProducts[0]->title, $productCategory->typeProducts[0]->url_key));
      $breadcrumbs->push(new Breadcrumb($productCategory->typeProducts[0]->lineProducts[0]->title, $productCategory->typeProducts[0]->lineProducts[0]->url_key));
      return view('catalog', compact('products', 'productCategory','breadcrumbs', 'articles'));
    }
  }

  public function lineProduct($slugTypeProduct, $slugLineProduct) {
    $lineProduct = LineProduct::with('products.files','type_product')->where('url_key', $slugLineProduct)->first();
    return view('lineProduct', compact('lineProduct'));
  }

  public function detail($slug) {
    $product = Product::with('files')->where('url_key',$slug)->first();
    return view('detail', compact('product'));
  }
}
