<?php

namespace App\Http\Controllers;

use App;
use App\Models\Cart;
use App\Models\Product;
use Auth;
use DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
  public function index() {
    $records = Cart::with('product')->where('user_id', Auth::id())->get();
    $lang = App::getLocale();
    foreach($records as $record) {
      if($lang == 'en') {
        $record->product->name = $record->product->name_en;
      } else {
        $record->product->name = $record->product->name_fr;
      }
    }
    $records = $records->toJson();
    return view('cart', compact('records'));
  }

  public function update(Request $request) {
    $records = $request->get('records');
    $productIds = [];
    foreach($records as $record) {
      $productIds[] = $record->product->id;
    }

//    DB::transaction(function() use ($records, $productIds) {
//      $products = Product::whereIn('id', $productIds);
//    });
  }
}

