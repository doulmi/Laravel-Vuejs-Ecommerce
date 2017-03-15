<?php

namespace App\Http\Controllers\API;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{

  private $cartRepo;

  public function __construct(CartRepository $cartRepo)
  {
    $this->cartRepo = $cartRepo;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  public function count($userId)
  {
    return Cart::where('user_id', $userId)->sum('quantity');
  }

  /**
   *
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $productId, $quantity, $userId)
  {
    if ($userId <= 0) {
      abort(403);
    }

    $cart = Cart::with('product')->where('product_id', $productId)->where('user_id', $userId)->first();
    if ($cart) {
      if ($cart->quantity + $quantity <= $cart->product->stock) {
        $cart = $cart->update([
          'quantity' => intval($cart->quantity) + intval($quantity)
        ]);
      } else {
        return response()->json(['error' => 'no_enough_stock'], 406);
      }
    } else {
      $cart = Cart::create([
        'product_id' => $productId,
        'user_id' => $userId,
        'quantity' => $quantity
      ]);
    }

    if ($cart) {
      return response()->json();
    } else {
      return response()->json(['error' => trans('database_error')], 304);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, $id)
  {
    $userId = $request->get('userId');
    $record = Cart::where('user_id', $userId)->where('id', $id)->first();
    if($record) {
      $success = $record->delete();
      if($success) {
        return response()->json();
      } else {
        return response()->json(['error' => 'database_error'], 412);
      }
    } else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
  }
}
