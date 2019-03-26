<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;

class FindController extends Controller
{
  public function index($text='')
  {
    $text = str_replace("_", "/", $text);
    $products = Product::with('files', 'productCategory', 'attributes')->where('active',1)->whereRaw("MATCH (title,description) AGAINST ('\"".$text."\"' IN BOOLEAN MODE) OR title LIKE '%".$text."%'")->paginate(21);
    return view('find', compact('products', 'text'));
  }
}
