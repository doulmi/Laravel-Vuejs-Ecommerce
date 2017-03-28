<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Intervention\Image\Facades\Image;

class Category extends Model
{
  use CrudTrait;

  /*
|--------------------------------------------------------------------------
| GLOBAL VARIABLES
|--------------------------------------------------------------------------
*/

//  protected $table = 'categories';
  protected $fillable = ['id', 'name_fr', 'name_en', 'active', 'slug', 'avatar'];
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

  public function setAvatarAttribute($value)
  {
    $attribute_name = "avatar";
    $disk = env('FILE_SYSTEM');
    $destination_path = "uploads/products";

    // if the image was erased
    if ($value == null) {
      // delete the image from disk
      \Storage::disk($disk)->delete($this->avatar);

      // set null in the database column
      $this->attributes[$attribute_name] = null;
    }

    // if a base64 was sent, store it in the db
    if (starts_with($value, 'data:image')) {
      // 0. Make the image
      $image = Image::make($value);
      // 1. Generate a filename.
      $filename = md5($value . time()) . '.jpg';
      // 2. Store the image on disk.
      \Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());
      // 3. Save the path to the database
      $this->attributes[$attribute_name] = $destination_path . '/' . $filename;
    }
  }
}
