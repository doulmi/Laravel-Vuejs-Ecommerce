<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = ['id', 'user_id', 'address_id', 'state'];

  public function user() {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function address() {
    return $this->belongsTo(Address::class, 'address_id', 'id');
  }
}
