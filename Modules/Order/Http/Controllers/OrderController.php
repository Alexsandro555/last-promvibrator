<?php

namespace Modules\Order\Http\Controllers;

use Modules\Order\Http\Requests\OrderRequest;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Order\Repositories\OrderRepository;
use Modules\Cart\Repositories\CartRepository;
use Modules\Order\Entities\Order;

class OrderController extends Controller
{
  /**
   * @var OrderRepository
   */
  private $orderRepository;
  /**
   * @var CartRepository
   */
  private $cartRepository;

  /**
   * OrderController constructor.
   * @param OrderRepository $orderRepository
   * @param CartRepository $cartRepository
   */
  public function __construct(OrderRepository $orderRepository, CartRepository $cartRepository) {
    $this->orderRepository = $orderRepository;
    $this->cartRepository = $cartRepository;
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index() {
    return view('order');
  }

  public function items() {
    return Order::with('user','products')->get();
  }

  /**
   * Store a newly created resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function store(OrderRequest $request)
  {
    $productIds = [];
    $cartProducts = $this->cartRepository->getAll()['products'];
    foreach($cartProducts as $key => $cartProduct) {
      array_push($productIds, $cartProduct->id);
    }
    if(count($productIds)>0) {
      $order = $this->orderRepository->create($request->all());
      $order->products()->attach($productIds);
      $this->cartRepository->deleteAll();
      return view('order::success', ['number' => $order->number]);
    }
    else {
      return redirect()->back()->withInput()->withErrors(['emptyCart' => 'Корзина не должна быть пустой']);
    }
  }
}
