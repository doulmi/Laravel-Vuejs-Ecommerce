<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {
  protected $fillable = ['id', 'order_id', 'product_id', 'user_id', 'quantity', 'unitPrice'];

  public function order() {
    return $this->belongsTo(Order::class, 'order_id', 'id');
  }

  public function product() {
    return $this->belongsTo(Product::class, 'product_id', 'id');
  }

  public function user() {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}
