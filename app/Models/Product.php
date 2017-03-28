<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Intervention\Image\Facades\Image;

class Product extends Model
{
  use CrudTrait, Sluggable;

  /*
|--------------------------------------------------------------------------
| GLOBAL VARIABLES
|--------------------------------------------------------------------------
*/
  protected $fillable = ['id', 'name_fr', 'name_en', 'active', 'slug', 'price', 'sale_price', 'on_sale', 'stock', 'view', 'lastMonthView', 'category_id', 'avatar', 'images'];

  protected $casts = [
    'photos' => 'array'
  ];
  //protected $table = 'products';
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

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function relativeProducts()
  {
    return $this->hasMany(ProductRelative::class, 'product_id', 'id');
  }

  public function buyers()
  {
    return User::join('orders', 'orders.user_id', '=', 'users.id')
      ->join('order_items', 'order_items.order_id', '=', 'orders.id')
      ->join('products', 'products.id', '=', 'order_items.product_id')
      ->where('products.id', $this->id);
  }

  public static function boot()
  {
    static::deleting(function ($obj) {
      \Storage::disk('products')->delete($obj->avatar);
      foreach (explode('|', $obj->images) as $image) {
        \Storage::disk('products')->delete($image);
      }
    });
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

  public function setImagesAttribute($value)
  {
    $attribute_name = "images";
    $disk = env('FILE_SYSTEM');
    $destination_path = "uploads/products";

    $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
  }

  /**
   * Return the sluggable configuration array for this model.
   *
   * @return array
   */
  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'name_fr'
      ]
    ];
  }
}
