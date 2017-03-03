<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['id', 'name_fr', 'name_en', 'active', 'slug', 'price', 'sale_price', 'on_sale', 'stock', 'view', 'lastmonthView', 'category_id'];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function relativeProducts()
  {
    return $this->hasMany(ProductRelative::class, 'product_id', 'id');
  }
}
