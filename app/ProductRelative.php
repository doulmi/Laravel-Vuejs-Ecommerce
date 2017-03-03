<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRelative extends Model
{
  protected $fillable = ['id', 'product_id', 'relative_product_id'];
}
