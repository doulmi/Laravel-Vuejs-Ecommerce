<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Like extends Model
{
  use CrudTrait;

  /*
|--------------------------------------------------------------------------
| GLOBAL VARIABLES
|--------------------------------------------------------------------------
*/
  protected $fillable = ['product_id', 'user_id'];


  //protected $table = 'likes';
  //protected $primaryKey = 'id';
  // public $timestamps = false;
  // protected $guarded = ['id'];
  // protected $fillable = [];
  // protected $hidden = [];
  // protected $dates = [];

  /*
|--------------------------------------------------------------------------
| FUNCTIONS
|--------------------------------------------------------------------------
*/
  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  /*
|--------------------------------------------------------------------------
| RELATIONS
|--------------------------------------------------------------------------
*/

  /*
|--------------------------------------------------------------------------
| SCOPES
|--------------------------------------------------------------------------
*/

  /*
|--------------------------------------------------------------------------
| ACCESORS
|--------------------------------------------------------------------------
*/

  /*
|--------------------------------------------------------------------------
| MUTATORS
|--------------------------------------------------------------------------
*/
}
