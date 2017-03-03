<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = ['id', 'user_id', 'address_id', 'delivery_id', 'state'];
}
