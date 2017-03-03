<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  protected $fillable = ['id', 'address', 'name', 'tel', 'user_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
