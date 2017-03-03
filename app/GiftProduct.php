<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftProduct extends Model
{
  protected $fillable = ['gift_id', 'product_id'];

  public function gift()
  {
    return $this->belongsTo(Gift::class);
  }

  public function product()
  {
    return $this->belongsTo(Product::class);
  }
}
