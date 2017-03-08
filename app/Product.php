<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['id', 'name_fr', 'name_en', 'active', 'slug', 'price', 'sale_price', 'on_sale', 'stock', 'view', 'lastMonthView', 'category_id', 'avatar', 'images'];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function relativeProducts()
  {
    return $this->hasMany(ProductRelative::class, 'product_id', 'id');
  }

  public function buyers() {
    return User::join('orders', 'orders.user_id', '=', 'users.id')
      ->join('order_items', 'order_items.order_id', '=', 'orders.id')
      ->join('products', 'products.id', '=', 'order_items.product_id')
      ->where('products.id', $this->id);
  }
}
