<?php

namespace Modules\Cart\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Cart;
use Illuminate\Support\Facades\Config;


class CartController extends Controller
{

    /**
     * Get array elements in cart
     * @return array
     */
    private function getCart() {
      $cart = Cart::content()->toArray();
      $arr = [];
      foreach($cart as $key=>$elem) {
        $arr[] = $elem;
      }
      return $arr;
    }


    /**
     * Get current cart
    * @return array
    */
    public function index() {
      return  [
        'cart' => $this->getCart(),
        'count' => Cart::count(),
        'total' => Cart::subtotal()
      ];
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create() {
        return view('cart::create');
    }


    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function store(Request $request)
    {
      $product = Product::with('files')->with('typeProduct','lineProduct')->findOrFail($request->id);
      $filename = "";
      foreach($product->files as $file)
      {
        if(!$file->figure) {
          foreach ($file->config as $filesItem)
          {
            foreach ($filesItem as $key=>$fileItem)
            {
              if($key === "small")
              {
                $filename = $fileItem["filename"];
                break;
              }
            }
          }
        }
      }
      $typeProductUrl = $product->typeProduct->url_key;
      $lineProductUrl = $product->lineProduct?$product->lineProduct->url_key:'empty';
      $productUrl = $product->url_key;
      $slug = '/catalog/'.$typeProductUrl.'/'.$lineProductUrl.'/'.$productUrl;
      Cart::add($product->id, $product->title, $request->count, $product->price,
        [
          'article'=>$product->vendor,
          'type'=>$product->typeProduct->title,
          'slug'=> $slug,
          'filename'=>$filename!=""?'/storage/'.$filename:"/images/no-image-small.png"
        ]
      );
      $total = Cart::subtotal();
      $count = Cart::count();
      return $this->getCart();
    }

    public function setQty($id, $qty) {
      Cart::update($id,$qty);
      return [];
    }

    /**
     * @return array
     */
    public function current() {
      $total = Cart::subtotal();
      $count = Cart::count();
      return ["total"=>$total,"count"=>$count];
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
      return view('cart::index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('cart::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * @param $rowId
     * @return array
     */
    public function destroy($rowId)
    {
      if($rowId) {
        Cart::remove($rowId);
        return [];
      }
    }
}
