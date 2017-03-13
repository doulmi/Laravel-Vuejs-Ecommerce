<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
  protected $fillable = ['id', 'code', 'reduction', 'count', 'expiration'];
  protected $dates = ['expiration'];
}
