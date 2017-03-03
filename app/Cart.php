<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $fillable = ['id', 'product_id', 'user_id', 'quantity', 'quantity_available'];

  public function product() {
    return $this->belongsTo(Product::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }
}
