<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository {
  public function index($userId, $lang) {
    $records = Cart::with('product')->where('user_id', $userId)->get();

    foreach ($records as $record) {
      if ($lang == 'en') {
        $record->product->name = $record->product->name_en;
      } else {
        $record->product->name = $record->product->name_fr;
      }
      if ($record->quantity > $record->product->stock) {
        $record->quantity = $record->product->stock;
        $record->error = 'stock_changed';
      }
    }
    return $records;
  }
}
