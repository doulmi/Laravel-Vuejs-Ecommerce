<?php

namespace App\Http\Controllers\API;

use App;
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
//      ->select(['products.*', DB::raw('(select count(id) from likes where product_id = products.id) as likesCount'), DB::raw('(select count(id) from collect_products where collect_products.product_id = products.id) as collectsCount')])
      ->paginate($limit, ['*'], 'page', $page);

    dd($products);
    return $products;
  }

  public function show($slug)
  {

  }
}
