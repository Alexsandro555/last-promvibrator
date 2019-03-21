<?php

namespace App\Http\Controllers;

use Modules\Product\Entities\AttributeGroup;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\TypeProduct;
use Modules\Product\Entities\LineProduct;
use Modules\Article\Models\Article;
use Modules\Page\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Breadcrumb;
use Modules\Files\Entities\File;

class SiteController extends Controller
{

  public function index()
  {
    $products = Product::with(['files','attributes','productCategory'])->where('active',1)->where('special',1)->get();
    return view('index',compact('products'));
  }

  public function catalogTypes($slug, Request $request) {

    $article = Article::where('url_key',str_replace( '.html', '', $slug))->first();
    if($article) {
      return view('article', compact('article'));
    }

    $page = Page::where('url_key',str_replace( '.html', '', $slug))->first();
    if($page) {
      return view('page', compact('page'));
    }

    $breadcrumbs = new Collection();

    if($request->has('id')) {
      $slug = str_replace('.php','',$slug);
      // проверка на старые id
      $isRedirect = Product::with(['files','attributes.attribute_unit','productCategory','lineProduct', 'typeProduct'])->whereHas('productCategory',function($query) use ($slug) {
        $query->where('url_key',$slug);
      })->where('old_id',$request->id)->where('active',0)->first();
      if($isRedirect) {
        return redirect('/');
      }
      $product = Product::with(['files','attributes.attribute_unit','productCategory','lineProduct', 'typeProduct'])->whereHas('productCategory',function($query) use ($slug) {
        $query->where('url_key',$slug);
      })->where('old_id',$request->id)->where('active',1)->firstOrFail();
      $productCategory = ProductCategory::with(['typeProducts.lineProducts'])->find($product->product_category_id);
      $groups = AttributeGroup::all();
      $typeProduct = TypeProduct::with('lineProducts')->find($product->type_product_id);
      $lineProducts = LineProduct::where('type_product_id',$product->type_product_id)->get();
      $breadcrumbs->push(new Breadcrumb("Главная страница", "/"));
      $breadcrumbs->push(new Breadcrumb($product->productCategory->title, $product->productCategory->url_key));
      if($product->type_product_id) $breadcrumbs->push(new Breadcrumb($product->typeProduct->title, $product->typeProduct->url_key));
      if($product->line_product_id) $breadcrumbs->push(new Breadcrumb($product->lineProduct->title, $product->lineProduct->url_key));
      $breadcrumbs->push(new Breadcrumb($product->title, $product->url_key));
      return view('detail', compact('product','productCategory', 'lineProducts', 'typeProduct', 'groups','breadcrumbs'));
    }

    $isRedirect = ProductCategory::where('url_key', $slug)->where('active',0)->first();
    if($isRedirect) {
      return redirect('/');
    }

    $productCategory = ProductCategory::where('url_key', $slug)->where('active',1)->first();
    if($productCategory) {
      $products = Product::with(['files','attributes','productCategory', 'typeProduct' => function($query) {
        $query->orderBy('sort', 'asc');
      }, 'lineProduct' => function($query) {
        $query->orderBy('sort', 'asc');
      }])->whereHas('productCategory',function($query) use ($slug) {
        $query->where('url_key',$slug);
      })->where('active',1)->orderBy('sort', 'asc')->paginate(9);
      $breadcrumbs->push(new Breadcrumb("Главная страница", "/"));
      $breadcrumbs->push(new Breadcrumb($productCategory->title, $slug));
      return view('catalog', compact('products','productCategory','breadcrumbs'));
    }

    $isRedirect = ProductCategory::with(['typeProducts'])->whereHas('typeProducts', function($query) use ($slug) {
      $query->where('url_key',$slug)->where('active',0);
    })->first();
    if($isRedirect) {
      return redirect('/');
    }

    $productCategory = ProductCategory::with(['typeProducts'])->whereHas('typeProducts', function($query) use ($slug) {
      $query->where('url_key',$slug);
    })->first();
    if($productCategory) {
      $products = Product::with(['files','attributes','typeProduct','lineProduct' => function($query) {
        $query->orderBy('sort', 'asc');
      }])->whereHas('typeProduct', function($query) use ($slug) {
        $query->where('url_key',$slug);
      })->where('active',1)->orderBy('sort', 'asc')->paginate(9);
      $breadcrumbs->push(new Breadcrumb("Главная страница", "/"));
      $breadcrumbs->push(new Breadcrumb($productCategory->title, $productCategory->url_key));
      $breadcrumbs->push(new Breadcrumb($productCategory->typeProducts[0]->title, $slug));
      return view('catalog', compact('products','productCategory','breadcrumbs'));
    }

    $isRedirect = ProductCategory::with(['typeProducts.lineProducts'])->whereHas('typeProducts.lineProducts', function($query) use ($slug) {
      $query->where('url_key',$slug);
    })->where('active',0)->first();
    if($isRedirect) {
      return redirect('/');
    }

    $productCategory = ProductCategory::with(['typeProducts.lineProducts'])->whereHas('typeProducts.lineProducts', function($query) use ($slug) {
      $query->where('url_key',$slug);
    })->where('active',1)->first();
    if($productCategory) {
      $products = Product::with(['files','attributes','lineProduct'])->whereHas('lineProduct', function($query) use ($slug) {
        $query->where('url_key',$slug);
      })->where('active',1)->orderBy('sort', 'asc')->paginate(9);
      $breadcrumbs->push(new Breadcrumb("Главная страница", "/"));
      $breadcrumbs->push(new Breadcrumb($productCategory->title, $productCategory->url_key));
      $breadcrumbs->push(new Breadcrumb($productCategory->typeProducts[0]->title, $productCategory->typeProducts[0]->url_key));
      $breadcrumbs->push(new Breadcrumb($productCategory->typeProducts[0]->lineProducts[0]->title, $productCategory->typeProducts[0]->lineProducts[0]->url_key));
      return view('catalog', compact('products', 'productCategory','breadcrumbs'));
    }

    abort(404);
  }

  public function lineProduct($slugTypeProduct, $slugLineProduct) {
    $lineProduct = LineProduct::with('products.files','type_product')->where('url_key', $slugLineProduct)->first();
    return view('lineProduct', compact('lineProduct'));
  }

  public function detail($slug) {
    $product = Product::with('files')->where('url_key',$slug)->first();
    return view('detail', compact('product'));
  }

  public function akzia() {
      $products = Product::where('onsale', true)->get();
      return view('index',compact('products'));
  }

  public function images($id) {
    $imageProducts = File::with('typeFile')->where('fileable_id',$id)->where('fileable_type',Product::class)->get();
    return $imageProducts;
  }
}
