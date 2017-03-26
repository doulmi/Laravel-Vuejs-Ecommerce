<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Collect extends Model
{
  use CrudTrait;

  /*
|--------------------------------------------------------------------------
| GLOBAL VARIABLES
|--------------------------------------------------------------------------
*/

  //protected $table = 'collects';
  //protected $primaryKey = 'id';
  // public $timestamps = false;
  // protected $guarded = ['id'];
  // protected $fillable = [];
  // protected $hidden = [];
  // protected $dates = [];
  protected $fillable = ['id', 'name', 'user_id'];

  /*
|--------------------------------------------------------------------------
| FUNCTIONS
|--------------------------------------------------------------------------
*/

  public function user()
  {
    $this->belongsTo(User::class);
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