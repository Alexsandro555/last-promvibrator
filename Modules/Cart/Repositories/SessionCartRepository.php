<?php
namespace Modules\Cart\Repositories;

use Cart;

class SessionCartRepository implements CartRepository
{
  /**
   * SessionCartRepository constructor.
   */
  public function __construct() {
  }

  public function getAll()
  {
    return  [
      'products' =>  Cart::content(),
      'count' => Cart::count(),
      'total' => Cart::subtotal()
    ];
  }

  public function deleteAll()
  {
    Cart::destroy();
  }
}