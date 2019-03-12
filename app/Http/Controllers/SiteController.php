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
    $typeProducts = TypeProduct::all();
    $products = Product::with(['files','attributes','type_product'])->where('active',1)->where('special',1)->get();
    $articles = Article::all();
    return view('index',compact('products','typeProducts', 'articles'));
  }

  public function catalogTypes($slug, Request $request) {
    $articles = Article::all();
    $breadcrumbs = new Collection();
    // Получение детальной карточки товара
    $id = $request->id;
    if($id) {
      $slug = str_replace('.php','',$slug);
      $product = Product::with(['files','attributes','lineProduct', 'typeProduct'])->whereHas('typeProduct',function($query) use ($slug) {
        $query->where('url_key',$slug);
      })->where('old_id',$id)->firstOrFail();
      $productId = $product->id;
      /*$groups = Group::with('attributeValues')->whereHas('attributeValues', function($query) use ($productId ) {
        $query->where('product_id',$productId);
      })->get();*/

      $typeProduct = TypeProduct::with('lineProducts')->find($product->type_product_id);
      $lineProducts = LineProduct::where('type_product_id',$product->type_product_id)->get();
      $breadcrumbs->push(new Breadcrumb("Главная страница", "/"));
      $breadcrumbs->push(new Breadcrumb($product->typeProduct->title, $product->typeProduct->url_key));
      if($product->line_product)
      {
        $breadcrumbs->push(new Breadcrumb($product->lineProduct->title, $product->lineProduct->url_key));
      }
      $breadcrumbs->push(new Breadcrumb($product->title, $product->url_key));
      return view('detail', compact('product','lineProducts', 'typeProduct' ,'breadcrumbs', 'articles'));
    }
    // конец получения детальной карточки товара

    // получение продуктов заданной категории типа продукта
    $products = Product::with(['files','attributes','typeProduct'])->whereHas('typeProduct',function($query) use ($slug) {
      $query->where('url_key',$slug);
    })->where('active',1)->paginate(10);

    // получение продуктов заданной категории для линейки продукции если тип продукции с таким slug не был найден
    if($products->count() === 0) {
      $products = Product::with(['files','attributes','lineProduct'])->whereHas('lineProduct', function($query) use ($slug) {
        $query->where('url_key',$slug);
      })->where('active',1)->paginate(10);
      // Получение продуктов с заданным атрибутов - еще потребуется добавить с заданной линейкой продукции
      if($products->count() === 0) {
        $products = Product::with('attributes')->whereHas('attributes', function($query) use ($slug) {
          $query->where('url_key',$slug);
        })->where('active',1)->get();
        if($products->count() === 0) {
          abort(404);
        }
        // линейки имеющие заданный атрибут
        $lineProduct = LineProduct::with(['attributes'])->whereHas('attributes', function($query) use ($slug) {
          $query->where('alias',$slug);
        })->firstOrFail();
        // если линеек с заданным атрибутом нет - то проверяем тип продукции
        if($lineProduct->count() === 0) {
          $typeProduct = TypeProduct::with(['attributes','lineProducts'])->whereHas('attributes', function($query) use ($slug) {
            $query->where('alias',$slug);
          })->FirsOrFail();
        }
        else {
          $typeProduct = TypeProduct::with(['attributes','lineProducts'])->find($lineProduct->type_product_id);
        }
        $attribute = Attribute::where('alias',$slug)->FirsOrFail();
        $breadcrumbs->push(new Breadcrumb("Главная страница", "/"));
        $breadcrumbs->push(new Breadcrumb($typeProduct->title, $typeProduct->url_key));
        $breadcrumbs->push(new Breadcrumb($attribute->title, $attribute->alias));
        return view('catalog', compact('products','typeProduct','breadcrumbs', 'articles'));
      }
      $lineProduct = LineProduct::where('url_key',$slug)->first();
      $idTypeProduct = $lineProduct->type_product_id;
      $typeProduct =  TypeProduct::with('lineProducts')->whereHas('lineProducts',function($query) use($slug) {
        $query->where('url_key',$slug);
      })->first();
      $breadcrumbs->push(new Breadcrumb("Главная страница", "/"));
      $breadcrumbs->push(new Breadcrumb($typeProduct->title, $typeProduct->url_key));
      $breadcrumbs->push(new Breadcrumb($lineProduct->title, $slug));
    }
    else {
      // получение информации для заданной категории типа продукции
      $typeProduct = TypeProduct::with('lineProducts')->where('url_key',$slug)->first();
      $breadcrumbs->push(new Breadcrumb("Главная страница", "/"));
      $breadcrumbs->push(new Breadcrumb($typeProduct->title, $slug));
    }
    return view('catalog', compact('products','typeProduct','breadcrumbs', 'articles'));
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
