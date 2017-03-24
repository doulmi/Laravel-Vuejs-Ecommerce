<?php

namespace App\Repositories;

use App\Models\Like;
use App\Models\Product;
use App\Models\ProductRelative;
use Illuminate\Http\Request;

class ProductRepository
{
  private $request;
  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function orderBy($query, $order) {
    //random by default
    if ($order == 'latest') { //latest
      $query->orderBy('products.created_at', 'DESC');
    } else if ($order == 'popular') {
      //TODO : order by commands number
    } else if ($order == 'expensive') { //most expensive
      $query->orderBy('price', 'DESC');
    } else if ($order == 'cheapest') { //cheapest
      $query->orderBy('price', 'ASC');
    } else {
      $query->inRandomOrder();
    }
    return $query;
  }

  public function paginate($order, $limit, $page) {
    $query = Product::query();

    $userId = $this->request->get('userId', 0);
    $catId = $this->request->get('catId', 0);
    $giftId = $this->request->get('giftId', 0);
    $collectId = $this->request->get('collectId', 0);

    if($catId > 0) {
      $query->where('category_id', $catId);
    }

    $query = $this->orderBy($query, $order);
    //with buyer, likes and collects
    $products = $query
      ->paginate($limit, ['*'], 'page', $page);

    foreach ($products as $product) {
      $product->likes = Like::where('product_id', $product->id)->count();

      if ($userId > 0) {
        $product->myLike = Like::where('product_id', $product->id)->where('user_id', $userId)->count() > 0 ? 1 : 0;
      } else {
        $product->myLike = 0;
      }
      $product->users = $product->buyers()->orderBy('orders.id')->limit(5)->get(['users.id', 'users.avatar']);
    }
    return $products;
  }

  /**
   * Find a product
   * @param $product
   * @param $lang
   * @param $userId
   * @return mixed
   */
  public function find($product, $lang, $userId)
  {
    if ($lang == 'fr') {
      $product->name = $product->name_fr;
    } else {
      $product->name = $product->name_en;
    }

    //get first 5 buyers of this products
    $product->buyers = $product->buyers()->orderBy('orders.id')->limit(5)->get(['users.id', 'users.avatar']);

    //get relative products
    $product->relativeProducts = ProductRelative::with('relativeProduct')->where('product_id', $product->id)->get();

    if ($userId > 0) {
      $product->like = Like::where('user_id', $userId)->where('product_id', $product->id)->first() ? 1 : 0;
    } else {
      $product->like = 0;
    }

    return $product;
  }

  /**
   * Find product by id given
   * @param $id
   * @param string $lang
   * @param int $userId
   * @return mixed
   */
  public function findById($id, $lang = 'fr', $userId = 0)
  {
    $product = Product::findOrFail($id)->first();
    return $this->find($product, $lang, $userId);
  }

  /**
   * Find product by slug given
   * @param $slug
   * @param string $lang
   * @param int $userId
   * @return mixed
   */
  public function findBySlug($slug, $lang = 'fr', $userId = 0)
  {
    $product = Product::where('slug', $slug)->first();
    if ($product) {
      return $this->find($product, $lang, $userId);
    } else {
      abort(404);
    }
  }
}