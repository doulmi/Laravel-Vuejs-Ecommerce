<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Order extends Model
{
  use CrudTrait;

  /*
|--------------------------------------------------------------------------
| GLOBAL VARIABLES
|--------------------------------------------------------------------------
*/
  protected $fillable = ['id', 'user_id', 'address_id', 'state'];
  //protected $table = 'orders';
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
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function address()
  {
    return $this->belongsTo(Address::class, 'address_id', 'id');
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
