<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRelative extends Model
{
  protected $fillable = ['id', 'product_id', 'relative_product_id'];

  public function product() {
    return $this->belongsTo(Product::class , 'product_id', 'id');
  }

  public function relativeProduct() {
    return $this->belongsTo(Product::class, 'relative_product_id', 'id');
  }
}
