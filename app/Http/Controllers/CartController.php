<?php

namespace App\Http\Controllers;

use App;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repositories\CartRepository;
use Auth;
use DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
  private $cartRepo;
  public function __construct(CartRepository $repo) {
    $this->cartRepo = $repo;
  }

  public function index()
  {
    $lang = App::getLocale();
    $records = $this->cartRepo->index(Auth::id(), $lang);
    $records = $records->toJson();
    return view('cart', compact('records'));
  }

  public function passCommand(Request $request)
  {
    //取得购物车中的物品及数量
    $ids = $request->get('records_id');
    $records = Cart::with('product')->where('user_id', Auth::id())->whereIn('id', explode(',', $ids))->get();

    //验证所有订单的数量都是可行的
    $valid = true;
    foreach ($records as $record) {
      if ($record->quantity > $record->product->stock) {
        $record->update(['quantity' => $record->product->stock]);
        $record->error = 'stock_changed';
        $valid = false;
      }
    }

    if ($valid) {
      DB::transaction(function () use ($records) {
        //是否有 promo code ?

        //计算最终价格

        //创建orderItem和order
        Order::create([
          'user_id' => Auth::id(),
        ]);

        OrderItem::create([

        ]);
      });
    } else {

    }
  }

  public function update(Request $request)
  {
    $id = $request->get('id');
    $quantity = $request->get('quantity');

    $record = Cart::findOrFail($id);

    if ($record->quantity != $quantity) {
      DB::transaction(function () use ($quantity, $record) {
        $product = Product::findOrFail($record->product_id);
        if ($product->stock >= $quantity) {
          $record->update(['quantity' => $quantity]);
        } else {
          $record->update(['quantity' => $product->stock]);
          return response()->json(['error' => 'MaxQuantity'], 409);
        }
      });
    }

    return response()->json();
  }
}

