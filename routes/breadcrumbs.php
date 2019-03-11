<?php
use Modules\Product\Entities\Product;
use Modules\Product\Entities\TypeProduct;
use Modules\Product\Entities\LineProduct;

Breadcrumbs::for('main', function ($trail) {
  $trail->add('Главная', route('main'));
});

Breadcrumbs::for('catalog.type-product', function($trail, $urlKeyTypeProduct) {
  $typeProduct = TypeProduct::where('url_key', $urlKeyTypeProduct)->firstOrFail();
  $trail->parent('main');
  $trail->add($typeProduct->title, route('catalog.type-product',[$typeProduct->url_key]));
});

Breadcrumbs::for('catalog.line-product', function($trail, $urlKeyTypeProduct, $urlKeyLineProduct) {
  $lineProduct = LineProduct::with('type_product')->where('url_key', $urlKeyLineProduct)->firstOrFail();
  $trail->parent('main');
  $trail->add($lineProduct->type_product->title, route('catalog.type-product',[$lineProduct->type_product->url_key]));
  $trail->add($lineProduct->title, route('catalog.line-product',[$lineProduct->type_product->url_key, $lineProduct->url_key]));
});

Breadcrumbs::for('catalog.detail', function($trail, $urlKeyProduct) {
  $product = Product::with('typeProduct','lineProduct')->where('url_key',$urlKeyProduct)->firstOrFail();
  $trail->parent('main');
  $trail->add($product->typeProduct->title, route('catalog.type-product', $product->typeProduct->url_key));
  if($product->line_product) {
    $trail->add($product->lineProduct->title, route('catalog.line-product', [$product->typeProduct->url_key, $product->lineProduct->url_key]));
  }
  $trail->add($product->title, route('catalog.detail',[$product->url_key]));
});