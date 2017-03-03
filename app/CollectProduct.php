<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectProduct extends Model
{
  protected $fillable = ['product_id', 'collect_id'];

  public function product() {
    return $this->belongsTo(Product::class);
  }

  public function collect() {
    return $this->belongsTo(Collect::class);
  }
}
