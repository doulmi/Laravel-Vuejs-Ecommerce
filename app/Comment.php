<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = ['id', 'user_id', 'product_id', 'content', 'note'];

  public function user() {
    return $this->belongsTo(User::class)->select(['id', 'avatar', 'name']);
  }

  public function product() {
    return $this->belongsTo(Product::class);
  }
}
