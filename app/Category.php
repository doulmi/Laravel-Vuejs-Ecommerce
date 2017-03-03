<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = ['id', 'name_fr', 'name_en', 'active', 'slug'];
}
