<?php

namespace App\Http\Controllers\API;

use App;
use App\CollectProduct;
use App\Like;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;

class ProductController extends Controller
{
  public function index(Request $request, $order, $limit, $page)
  {
    $query = Product::query();

    /** order */
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

    //with buyer, likes and collects
    $products = $query
      ->paginate($limit, ['*'], 'page', $page);

    foreach($products as $product) {
      $product->likes = Like::where('product_id', $product->id)->count();
      $product->users = $product->buyers()->orderBy('orders.id')->limit(5)->get(['users.id', 'users.avatar']);
    }
    return $products;
  }

  public function show($slug)
  {

  }
}
