<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
  protected $fillable = ['id', 'name', 'user_id'];

  public function user() {
    $this->belongsTo(User::class);
  }
}
